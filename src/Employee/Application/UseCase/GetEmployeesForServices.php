<?php

namespace Employee\Application\UseCase;

use Employee\Application\Dto\EmployeeDto;
use Employee\Domain\Model\Employee;
use Employee\Domain\Repository\EmployeeRepositoryInterface;

final readonly class GetEmployeesForServices
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository
    ) {}

    public function __invoke(array $serviceIds): array
    {
        $employees = $this->employeeRepository->findEmployeesProvidingAllServices($serviceIds);

        return array_map(fn (Employee $employee) => new EmployeeDto(
            $employee->getId()->toString(),
            $employee->getName(),
        ), $employees);
    }
}
