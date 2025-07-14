<?php

namespace User\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use User\Domain\Model\User;
use User\Domain\Repository\UserRepositoryInterface;
use User\Infrastructure\Doctrine\Entity\UserEntity;
use User\Infrastructure\Doctrine\Mapper\UserMapper;

final readonly class DoctrineUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function findByPhone(string $phoneCode, string $phoneNumber): ?User
    {
        $repo = $this->em->getRepository(UserEntity::class);

        $entity = $repo->findOneBy(['phoneCode' => $phoneCode, 'phoneNumber' => $phoneNumber]);

        return $entity ? UserMapper::toDomain($entity) : null;
    }

    public function existsByPhone(string $phoneCode, string $phoneNumber): bool
    {
        $repo = $this->em->getRepository(UserEntity::class);

        return $repo->count(['phoneCode' => $phoneCode, 'phoneNumber' => $phoneNumber]) > 0;
    }

    public function save(User $user): void
    {
        $entity = UserMapper::toEntity($user);

        $this->em->persist($entity);
        $this->em->flush();
    }

    public function findById(string $id): ?User
    {
        $entity = $this->em->getRepository(UserEntity::class)->find($id);

        return $entity ? UserMapper::toDomain($entity) : null;
    }
}
