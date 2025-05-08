<?php

namespace Employee\Infrastructure\Doctrine\Mapper;

use Employee\Domain\Model\EmployeeServiceAssignment;
use Employee\Infrastructure\Doctrine\Entity\EmployeeServiceAssignmentEntity;
use Shared\Domain\ValueObject\Uuid;

class EmployeeServiceAssignmentMapper
{
    public static function toDomain(EmployeeServiceAssignmentEntity $entity): EmployeeServiceAssignment
    {
        return EmployeeServiceAssignment::create(
            Uuid::fromString($entity->getEmployeeId()),
            Uuid::fromString($entity->getServiceId()),
        );
    }

    public static function toEntity(EmployeeServiceAssignment $employeeServiceAssignment): EmployeeServiceAssignmentEntity
    {
        return new EmployeeServiceAssignmentEntity(
            $employeeServiceAssignment->getEmployeeId()->toString(),
            $employeeServiceAssignment->getServiceId()->toString(),
        );
    }
}
