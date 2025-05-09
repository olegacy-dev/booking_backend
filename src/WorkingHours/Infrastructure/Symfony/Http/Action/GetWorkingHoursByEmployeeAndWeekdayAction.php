<?php

namespace WorkingHours\Infrastructure\Symfony\Http\Action;

use WorkingHours\Application\UseCase\GetWorkingHoursByEmployeeAndWeekday;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employees/{employeeId}/working-hours/{weekday}', name: 'working_hours_by_day', methods: ['GET'])]
final class GetWorkingHoursByEmployeeAndWeekdayAction extends AbstractController
{
    public function __construct(
        private readonly GetWorkingHoursByEmployeeAndWeekday $getWorkingHours
    ) {}

    public function __invoke(string $employeeId, int $weekday): JsonResponse
    {
        if ($weekday < 0 || $weekday > 6) {
            return $this->json(['error' => 'Invalid weekday'], Response::HTTP_BAD_REQUEST);
        }

        $result = ($this->getWorkingHours)($employeeId, $weekday);

        return $this->json($result);
    }
}
