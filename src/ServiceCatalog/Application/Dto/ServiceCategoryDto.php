<?php

namespace ServiceCatalog\Application\Dto;

final readonly class ServiceCategoryDto
{
    /**
     * @param ServiceDto[] $services
     */
    public function __construct(
        public string $id,
        public string $name,
        public array $services
    ) {}
}
