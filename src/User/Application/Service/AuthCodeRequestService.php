<?php

namespace User\Application\Service;

use Carbon\Carbon;
use Random\RandomException;
use Shared\Domain\ValueObject\Uuid;
use User\Domain\Model\SmsVerificationAttempt;
use User\Domain\Repository\SmsVerificationAttemptRepositoryInterface;
use User\Domain\Service\SmsSenderInterface;

final readonly class AuthCodeRequestService
{
    public function __construct(
        private SmsVerificationAttemptRepositoryInterface $smsAttemptRepository,
        private SmsSenderInterface $smsSender
    ) {}

    public function request(string $name, string $phoneCode, string $phoneNumber): void
    {
        $attempt = $this->smsAttemptRepository->findByPhone($phoneCode, $phoneNumber);

        try {
            $code = (string) random_int(100000, 999999);
        } catch (RandomException) {
            return;
        }

        $expiresAt = Carbon::now()->addMinutes(5);

        if ($attempt) {
            $attempt->withNewCode($code, $expiresAt);
        } else {
            $attempt = SmsVerificationAttempt::create(Uuid::generate(), $name, $phoneCode, $phoneNumber, $code, $expiresAt, 0, Carbon::now());
        }

        $this->smsAttemptRepository->save($attempt);

        $this->smsSender->send($phoneCode, $phoneNumber, "Your verification code is: $code}");
    }
}
