<?php

namespace Employee\Domain\Repository;

use Employee\Domain\Model\EmployeeServiceAssignment;

interface EmployeeServiceAssignmentRepositoryInterface
{
    /**
     * @return EmployeeServiceAssignment[]
     */
    public function findServicesByEmployeeId(string $employeeId): array;

    /**
     * @return EmployeeServiceAssignment[]
     */
    public function findEmployeesByServiceId(string $serviceId): array;

    public function save(EmployeeServiceAssignment $assignment): void;
}
