<?php

namespace ServiceCatalog\Domain\Repository;

use ServiceCatalog\Domain\Model\Service;

interface ServiceRepositoryInterface
{
    /**
     * @return Service[]
     */
    public function findAllActive(): array;

    public function findById(string $id): ?Service;

    public function save(Service $service): void;
}
