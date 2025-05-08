<?php

namespace Employee\Domain\Repository;

use Employee\Domain\Model\Employee;

interface EmployeeRepositoryInterface
{
    /**
     * @return Employee[]
     */
    public function findByCategoryId(string $categoryId): array;

    public function findById(string $id): ?Employee;

    /**
     * @param string[] $serviceIds
     *
     * @return Employee[]
     */
    public function findEmployeesProvidingAllServices(array $serviceIds): array;
}
