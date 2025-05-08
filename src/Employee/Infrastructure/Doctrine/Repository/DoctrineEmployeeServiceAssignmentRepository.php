<?php

namespace Employee\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Employee\Domain\Model\EmployeeServiceAssignment;
use Employee\Domain\Repository\EmployeeServiceAssignmentRepositoryInterface;
use Employee\Infrastructure\Doctrine\Entity\EmployeeServiceAssignmentEntity;
use Employee\Infrastructure\Doctrine\Mapper\EmployeeServiceAssignmentMapper;

final readonly class DoctrineEmployeeServiceAssignmentRepository implements EmployeeServiceAssignmentRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    /**
     * @return EmployeeServiceAssignment[]
     */
    public function findServicesByEmployeeId(string $employeeId): array
    {
        $repo = $this->em->getRepository(EmployeeServiceAssignmentEntity::class);
        $entities = $repo->findBy(['employeeId' => $employeeId]);

        return array_map(fn (EmployeeServiceAssignmentEntity $entity) => EmployeeServiceAssignmentMapper::toDomain($entity), $entities);
    }

    /**
     * @return EmployeeServiceAssignment[]
     */
    public function findEmployeesByServiceId(string $serviceId): array
    {
        $repo = $this->em->getRepository(EmployeeServiceAssignmentEntity::class);
        $entities = $repo->findBy(['serviceId' => $serviceId]);

        return array_map(fn (EmployeeServiceAssignmentEntity $entity) => EmployeeServiceAssignmentMapper::toDomain($entity), $entities);
    }

    public function save(EmployeeServiceAssignment $assignment): void
    {
        $entity = EmployeeServiceAssignmentMapper::toEntity($assignment);

        $this->em->persist($entity);
        $this->em->flush();
    }
}
