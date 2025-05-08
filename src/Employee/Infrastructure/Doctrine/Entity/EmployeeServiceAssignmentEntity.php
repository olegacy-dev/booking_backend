<?php

namespace Employee\Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'employee_service_assignments')]
final class EmployeeServiceAssignmentEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'employee_id', type: 'guid', nullable: false)]
    private string $employeeId;

    #[ORM\Id]
    #[ORM\Column(name: 'service_id', type: 'guid', nullable: false)]
    private string $serviceId;

    public function __construct(string $employeeId, string $serviceId)
    {
        $this->employeeId = $employeeId;
        $this->serviceId = $serviceId;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeId;
    }

    public function getServiceId(): string
    {
        return $this->serviceId;
    }
}
