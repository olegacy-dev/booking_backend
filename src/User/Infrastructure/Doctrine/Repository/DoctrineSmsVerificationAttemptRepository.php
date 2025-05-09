<?php

namespace User\Infrastructure\Doctrine\Repository;

use User\Infrastructure\Doctrine\Entity\SmsVerificationAttemptEntity;
use Doctrine\ORM\EntityManagerInterface;
use User\Domain\Model\SmsVerificationAttempt;
use User\Domain\Repository\SmsVerificationAttemptRepositoryInterface;
use User\Infrastructure\Doctrine\Mapper\SmsVerificationAttemptMapper;

final readonly class DoctrineSmsVerificationAttemptRepository implements SmsVerificationAttemptRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function findByPhone(string $phoneCode, string $phoneNumber): ?SmsVerificationAttempt
    {
        $repo = $this->em->getRepository(SmsVerificationAttemptEntity::class);

        $entity = $repo->findOneBy(['phoneCode' => $phoneCode, 'phoneNumber' => $phoneNumber]);

        return $entity ? SmsVerificationAttemptMapper::toDomain($entity) : null;
    }

    public function findValidByCode(string $code, string $phoneCode, string $phoneNumber): ?SmsVerificationAttempt
    {
        $repo = $this->em->getRepository(SmsVerificationAttemptEntity::class);

        $entity = $repo->findOneBy(['phoneCode' => $phoneCode, 'phoneNumber' => $phoneNumber, 'code' => $code]);

        if (!$entity) {
            return null;
        }

        $domain = SmsVerificationAttemptMapper::toDomain($entity);

        return $domain->isExpired() ? null : $domain;
    }

    public function save(SmsVerificationAttempt $attempt): void
    {
        $existing = $this->em->getRepository(SmsVerificationAttemptEntity::class)->find($attempt->getId()->toString());

        if ($existing) {
            $existing
                ->setCode($attempt->getCode())
                ->setAttempts($attempt->getAttempts())
                ->setExpiresAt($attempt->getExpiresAt())
                ->setName($attempt->getName())
                ->setPhoneCode($attempt->getPhoneCode())
                ->setPhoneNumber($attempt->getPhoneNumber());
        } else {
            $entity = SmsVerificationAttemptMapper::toEntity($attempt);

            $this->em->persist($entity);
        }

        $this->em->flush();
    }

    public function delete(SmsVerificationAttempt $attempt): void
    {
        $repo = $this->em->getRepository(SmsVerificationAttemptEntity::class);

        $entity = $repo->find($attempt->getId()->toString());

        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
        }
    }
}
