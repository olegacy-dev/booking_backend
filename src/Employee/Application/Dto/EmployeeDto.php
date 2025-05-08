<?php

namespace Employee\Application\Dto;

final readonly class EmployeeDto
{
    public function __construct(
        public string $id,
        public string $name
    ) {}
}
