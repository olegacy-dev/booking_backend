<?php

namespace User\Domain\Repository;

use User\Domain\Model\SmsVerificationAttempt;

interface SmsVerificationAttemptRepositoryInterface
{
    public function findByPhone(string $phoneCode, string $phoneNumber): ?SmsVerificationAttempt;

    public function findValidByCode(string $code, string $phoneCode, string $phoneNumber): ?SmsVerificationAttempt;

    public function save(SmsVerificationAttempt $attempt): void;

    public function delete(SmsVerificationAttempt $attempt): void;
}
