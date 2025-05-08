<?php

namespace Employee\Domain\Model;

use Shared\Domain\ValueObject\Uuid;

final readonly class EmployeeServiceAssignment
{
    public function __construct(
        private Uuid $employeeId,
        private Uuid $serviceId,
    ) {}

    public static function create(Uuid $employeeId, Uuid $serviceId): self
    {
        return new self($employeeId, $serviceId);
    }

    public function getEmployeeId(): Uuid
    {
        return $this->employeeId;
    }

    public function getServiceId(): Uuid
    {
        return $this->serviceId;
    }
}
