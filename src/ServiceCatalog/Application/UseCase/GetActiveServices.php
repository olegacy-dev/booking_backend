<?php

namespace ServiceCatalog\Application\UseCase;

use ServiceCatalog\Application\Dto\ServiceDto;
use ServiceCatalog\Domain\Model\Service;
use ServiceCatalog\Domain\Repository\ServiceRepositoryInterface;

final readonly class GetActiveServices
{
    public function __construct(
        private ServiceRepositoryInterface $serviceRepository
    ) {}

    /**
     * @return ServiceDto[]
     */
    public function __invoke(): array
    {
        $services = $this->serviceRepository->findAllActive();

        return array_map(fn (Service $service) => new ServiceDto(
            (string) $service->getId(),
            $service->getName(),
            $service->getDescription(),
            $service->getDurationInMinutes(),
        ), $services);
    }
}
