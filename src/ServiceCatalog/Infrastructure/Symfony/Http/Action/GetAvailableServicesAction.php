<?php

namespace ServiceCatalog\Infrastructure\Symfony\Http\Action;

use ServiceCatalog\Application\UseCase\GetActiveServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/services', name: 'service_list', methods: ['GET'])]
class GetAvailableServicesAction extends AbstractController
{
    public function __construct(
        private readonly GetActiveServices $getActiveServices
    ) {}

    public function __invoke(): JsonResponse
    {
        $services = ($this->getActiveServices)();

        return $this->json($services);
    }
}
