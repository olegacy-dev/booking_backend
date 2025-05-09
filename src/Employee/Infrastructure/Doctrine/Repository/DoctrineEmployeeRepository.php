<?php

namespace Employee\Infrastructure\Doctrine\Repository;

use Employee\Infrastructure\Doctrine\Mapper\EmployeeMapper;
use Doctrine\ORM\EntityManagerInterface;
use Employee\Domain\Model\Employee;
use Employee\Domain\Repository\EmployeeRepositoryInterface;
use Employee\Infrastructure\Doctrine\Entity\EmployeeEntity;
use Employee\Infrastructure\Doctrine\Entity\EmployeeServiceAssignmentEntity;

final readonly class DoctrineEmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function findByCategoryId(string $categoryId): array
    {
        $repo = $this->em->getRepository(EmployeeEntity::class);
        $employees = $repo->findBy(['categoryId' => $categoryId]);

        return array_map(fn (EmployeeEntity $employeeEntity) => EmployeeMapper::toDomain($employeeEntity), $employees);
    }

    public function findById(string $id): ?Employee
    {
        $employee = $this->em->getRepository(EmployeeEntity::class)->find($id);

        return $employee ? EmployeeMapper::toDomain($employee) : null;
    }

    /**
     * @param array $serviceIds
     *
     * @return Employee[]
     */
    public function findEmployeesProvidingAllServices(array $serviceIds): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb
            ->select('e')
            ->from(EmployeeEntity::class, 'e')
            ->innerJoin(EmployeeServiceAssignmentEntity::class, 'esa', 'WITH', 'e.id=esa.employeeId')
            ->andWhere('esa.serviceId IN (:servicesIds)')
            ->setParameter('servicesIds', $serviceIds);

        $employees = $qb->getQuery()->getResult();

        return array_map(fn (EmployeeEntity $entity) => EmployeeMapper::toDomain($entity), $employees);
    }
}
