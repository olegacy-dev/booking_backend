<?php

namespace Employee\Infrastructure\Doctrine\Mapper;

use Employee\Domain\Model\Employee;
use Employee\Infrastructure\Doctrine\Entity\EmployeeEntity;
use Shared\Domain\ValueObject\Uuid;

final readonly class EmployeeMapper
{
    public static function toDomain(EmployeeEntity $employeeEntity): Employee
    {
        return Employee::create(
            Uuid::fromString($employeeEntity->getId()),
            $employeeEntity->getName(),
            Uuid::fromString($employeeEntity->getCategoryId())
        );
    }

    public static function toEntity(Employee $employee): EmployeeEntity
    {
        return new EmployeeEntity(
            $employee->getId()->toString(),
            $employee->getName(),
            $employee->getCategoryId()->toString(),
        );
    }
}
