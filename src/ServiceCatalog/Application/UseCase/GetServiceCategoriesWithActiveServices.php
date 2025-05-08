<?php

namespace ServiceCatalog\Application\UseCase;

use ServiceCatalog\Application\Dto\ServiceCategoryDto;
use ServiceCatalog\Application\Dto\ServiceDto;
use ServiceCatalog\Domain\Repository\ServiceCategoryRepositoryInterface;
use ServiceCatalog\Domain\Repository\ServiceRepositoryInterface;

final readonly class GetServiceCategoriesWithActiveServices
{
    public function __construct(
        private ServiceCategoryRepositoryInterface $categoryRepository,
        private ServiceRepositoryInterface $serviceRepository
    ) {}

    /**
     * @return ServiceCategoryDto[]
     */
    public function __invoke(): array
    {
        $categories = $this->categoryRepository->findAllWithActiveServices();
        $services = $this->serviceRepository->findAllActive();

        $servicesByCategory = [];

        foreach ($services as $service) {
            $categoryId = $service->getCategoryId()->toString();

            $servicesByCategory[$categoryId][] = new ServiceDto(
                $service->getId()->toString(),
                $service->getName(),
                $service->getDescription(),
                $service->getDurationInMinutes()
            );
        }

        $result = [];

        foreach ($categories as $category) {
            $categoryId = $category->getId()->toString();

            if (!isset($servicesByCategory[$categoryId])) {
                continue;
            }

            $result[] = new ServiceCategoryDto(
                $categoryId,
                $category->getName(),
                $servicesByCategory[$categoryId]
            );
        }

        return $result;
    }
}
