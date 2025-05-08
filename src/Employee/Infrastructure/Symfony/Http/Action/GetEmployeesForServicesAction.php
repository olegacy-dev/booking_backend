<?php

namespace Employee\Infrastructure\Symfony\Http\Action;

use Employee\Application\UseCase\GetEmployeesForServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employees', name: 'get_employees_for_services', methods: ['GET'])]
final class GetEmployeesForServicesAction extends AbstractController
{
    public function __construct(
        private readonly GetEmployeesForServices $getEmployeesForServices
    ) {}

    public function __invoke(Request $request): Response
    {
        $serviceIds = $request->query->all('serviceIds');

        if (empty($serviceIds)) {
            return $this->json(['error' => 'Missing serviceIds'], Response::HTTP_BAD_REQUEST);
        }

        $employees = ($this->getEmployeesForServices)($serviceIds);

        return $this->json($employees);
    }
}
