<?php

namespace ServiceCatalog\Infrastructure\Symfony\Http\Action;

use ServiceCatalog\Application\UseCase\GetServiceCategoriesWithActiveServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/service-categories', name: 'get_service_categories', methods: ['GET'])]
final class GetServiceCategoriesAction extends AbstractController
{
    public function __construct(
        private readonly GetServiceCategoriesWithActiveServices $useCase
    ) {}

    public function __invoke(): Response
    {
        $categories = ($this->useCase)();

        return $this->json($categories);
    }
}
