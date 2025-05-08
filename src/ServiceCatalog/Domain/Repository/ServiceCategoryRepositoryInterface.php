<?php

namespace ServiceCatalog\Domain\Repository;

use ServiceCatalog\Domain\Model\ServiceCategory;

interface ServiceCategoryRepositoryInterface
{
    /**
     * @return ServiceCategory[]
     */
    public function findAllWithActiveServices(): array;
}
