<?php

namespace ServiceCatalog\Infrastructure\Doctrine\Mapper;

use ServiceCatalog\Domain\Model\Service;
use ServiceCatalog\Infrastructure\Doctrine\Entity\ServiceEntity;
use Shared\Domain\ValueObject\Uuid;

class ServiceMapper
{
    public static function toDomain(ServiceEntity $serviceEntity): Service
    {
        $id = Uuid::fromString($serviceEntity->getId());
        $categoryId = Uuid::fromString($serviceEntity->getCategoryId());

        return Service::create(
            $id,
            $categoryId,
            $serviceEntity->getName(),
            $serviceEntity->getDescription(),
            $serviceEntity->getDurationInMinutes(),
            $serviceEntity->isActive(),
        );
    }

    public static function toEntity(Service $service): ServiceEntity
    {
        return new ServiceEntity(
            $service->getId()->toString(),
            $service->getCategoryId()->toString(),
            $service->getName(),
            $service->getDescription(),
            $service->getDurationInMinutes(),
            $service->isActive(),
        );
    }
}
