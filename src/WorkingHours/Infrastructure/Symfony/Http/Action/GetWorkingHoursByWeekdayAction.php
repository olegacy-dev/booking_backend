<?php

namespace WorkingHours\Infrastructure\Symfony\Http\Action;

use WorkingHours\Application\UseCase\GetWorkingHoursByWeekday;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/working-hours/{weekday}', name: 'working_hours_by_day', methods: ['GET'])]
final class GetWorkingHoursByWeekdayAction extends AbstractController
{
    public function __construct(
        private readonly GetWorkingHoursByWeekday $getWorkingHours
    ) {}

    public function __invoke(int $weekday): JsonResponse
    {
        if ($weekday < 0 || $weekday > 6) {
            return $this->json(['error' => 'Invalid weekday'], Response::HTTP_BAD_REQUEST);
        }

        $result = ($this->getWorkingHours)($weekday);

        return $this->json($result);
    }
}
