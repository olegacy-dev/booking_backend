<?php

namespace Booking\Infrastructure\Symfony\Http\Action;

use Booking\Application\UseCase\GetAvailableSlotsGroupedByDay;
use Carbon\Carbon;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/available-slots', name: 'get_available_slots_grouped_by_day', methods: ['GET'])]
final class GetAvailableSlotsGroupedByDayAction extends AbstractController
{
    public function __construct(
        private readonly GetAvailableSlotsGroupedByDay $useCase
    ) {}

    public function __invoke(Request $request): Response
    {
        $employeeId = $request->query->get('employeeId');
        $serviceIds = $request->query->all('serviceIds');
        $monthParam = $request->query->get('month');

        if (!$employeeId || empty($serviceIds) || !$monthParam) {
            return $this->json(['error' => 'Missing parameters'], 400);
        }

        try {
            $month = Carbon::parse("$monthParam-01");
        } catch (Exception) {
            return $this->json(['error' => 'Invalid month format'], Response::HTTP_BAD_REQUEST);
        }

        $slots = ($this->useCase)($month, $employeeId, $serviceIds);

        return $this->json($slots);
    }
}
