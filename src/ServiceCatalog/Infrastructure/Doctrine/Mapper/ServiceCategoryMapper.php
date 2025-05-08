<?php

namespace ServiceCatalog\Infrastructure\Doctrine\Mapper;

use ServiceCatalog\Domain\Model\ServiceCategory;
use ServiceCatalog\Infrastructure\Doctrine\Entity\ServiceCategoryEntity;
use Shared\Domain\ValueObject\Uuid;

final class ServiceCategoryMapper
{
    public static function toDomain(ServiceCategoryEntity $entity): ServiceCategory
    {
        return new ServiceCategory(
            Uuid::fromString($entity->getId()),
            $entity->getName()
        );
    }

    public static function toEntity(ServiceCategory $category): ServiceCategoryEntity
    {
        return new ServiceCategoryEntity(
            $category->getId()->toString(),
            $category->getName()
        );
    }
}
