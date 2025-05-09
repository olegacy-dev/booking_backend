<?php

namespace User\Infrastructure\Doctrine\Mapper;

use User\Infrastructure\Doctrine\Entity\SmsVerificationAttemptEntity;
use Carbon\Carbon;
use Shared\Domain\ValueObject\Uuid;
use User\Domain\Model\SmsVerificationAttempt;

class SmsVerificationAttemptMapper
{
    public static function toDomain(SmsVerificationAttemptEntity $entity): SmsVerificationAttempt
    {
        return SmsVerificationAttempt::create(
            Uuid::fromString($entity->id),
            $entity->name,
            $entity->phoneCode,
            $entity->phoneNumber,
            $entity->code,
            Carbon::instance($entity->expiresAt),
            $entity->attempts,
            Carbon::instance($entity->createdAt)
        );
    }

    public static function toEntity(SmsVerificationAttempt $domain): SmsVerificationAttemptEntity
    {
        return new SmsVerificationAttemptEntity(
            $domain->getId()->toString(),
            $domain->getName(),
            $domain->getPhoneCode(),
            $domain->getPhoneNumber(),
            $domain->getCode(),
            $domain->getExpiresAt(),
            $domain->getAttempts(),
            $domain->getCreatedAt(),
        );
    }
}
