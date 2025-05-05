<?php

namespace ServiceCatalog\Application\Dto;

final readonly class ServiceDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public int $durationInMinutes
    ) {}
}
