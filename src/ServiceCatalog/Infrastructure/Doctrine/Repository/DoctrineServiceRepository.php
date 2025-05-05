<?php

namespace ServiceCatalog\Infrastructure\Doctrine\Repository;

use ServiceCatalog\Domain\Model\Service;
use Doctrine\ORM\EntityManagerInterface;
use ServiceCatalog\Domain\Repository\ServiceRepositoryInterface;
use ServiceCatalog\Infrastructure\Doctrine\Entity\ServiceEntity;
use ServiceCatalog\Infrastructure\Doctrine\Mapper\ServiceMapper;

final readonly class DoctrineServiceRepository implements ServiceRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function findAllActive(): array
    {
        $repository = $this->em->getRepository(ServiceEntity::class);

        $entities = $repository->findBy(['isActive' => true]);

        return array_map(fn (ServiceEntity $entity) => ServiceMapper::toDomain($entity), $entities);
    }

    public function findById(string $id): ?Service
    {
        $entity = $this->em->getRepository(ServiceEntity::class)->find($id);

        return $entity ? ServiceMapper::toDomain($entity) : null;
    }

    public function save(Service $service): void
    {
        $entity = ServiceMapper::toEntity($service);

        $this->em->persist($entity);
        $this->em->flush();
    }
}
