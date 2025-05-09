<?php

namespace User\Application\Service;

use Carbon\Carbon;
use RuntimeException;
use Shared\Domain\ValueObject\Uuid;
use User\Domain\Model\User;
use User\Domain\Repository\SmsVerificationAttemptRepositoryInterface;
use User\Domain\Repository\UserRepositoryInterface;

final readonly class AuthCodeVerificationService
{
    public function __construct(
        private SmsVerificationAttemptRepositoryInterface $smsAttemptRepository,
        private UserRepositoryInterface $userRepository
    ) {}

    public function verify(string $phoneCode, string $phoneNumber, string $code): User
    {
        $attempt = $this->smsAttemptRepository->findValidByCode($code, $phoneCode, $phoneNumber);

        if (!$attempt) {
            throw new RuntimeException('Invalid or expired verification code.');
        }

        $user = $this->userRepository->findByPhone($phoneCode, $phoneNumber);

        if (!$user) {
            $user = User::register(Uuid::generate(), $attempt->getName(), $phoneCode, $phoneNumber, Carbon::now());

            $this->userRepository->save($user);
        }

        $this->smsAttemptRepository->delete($attempt);

        return $user;
    }
}
