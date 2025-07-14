<?php

namespace User\Infrastructure\Doctrine\Mapper;


use Shared\Domain\ValueObject\Uuid;
use User\Domain\Model\User;
use User\Infrastructure\Doctrine\Entity\UserEntity;

class UserMapper
{
    public static function toDomain(UserEntity $entity): User
    {
        return User::register(
            Uuid::fromString($entity->id),
            $entity->name,
            $entity->phoneCode,
            $entity->phoneNumber,
            $entity->createdAt,
            $entity->getRoles(),
        );
    }

    public static function toEntity(User $domain): UserEntity
    {
        return new UserEntity(
            $domain->getId()->toString(),
            $domain->getName(),
            $domain->getPhoneCode(),
            $domain->getPhoneNumber(),
            $domain->getCreatedAt(),
            $domain->getRoles(),
        );
    }
}
