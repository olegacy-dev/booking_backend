<?php

namespace Booking\Application\UseCase;

use Booking\Application\Service\SlotAvailabilityCheckerInterface;
use Carbon\Carbon;

final readonly class GetAvailableSlotsGroupedByDay
{
    public function __construct(
        private SlotAvailabilityCheckerInterface $slotChecker
    ) {}

    public function __invoke(Carbon $month, string $employeeId, array $serviceIds): array
    {
        $startOfMonth = $month->copy()->startOfMonth();
        $endOfMonth = $month->copy()->endOfMonth();

        $availableMonthSlots = [];

        for ($day = $startOfMonth->copy(); $day->lte($endOfMonth); $day->addDay()) {
            $availableSaySlots = $this->getAvailableSlotsForDay($employeeId, $day, $serviceIds);

            if ($availableSaySlots) {
                $availableMonthSlots[] = [
                    'date' => $day->toDateString(),
                    'slots' => $availableSaySlots,
                ];
            }
        }

        return $availableMonthSlots;
    }

    private function getAvailableSlotsForDay(string $employeeId, Carbon $startOfDay, array $serviceIds): array
    {
        $now = Carbon::now();

        $endOfDay = $startOfDay->copy()->endOfDay();

        $availableSlots = [];

        for ($slot = $startOfDay->copy(); $slot->lte($endOfDay); $slot->addMinutes(15)) {
            if ($slot->lt($now)) {
                continue;
            }

            if ($this->slotChecker->isSlotAvailable($slot, $serviceIds, $employeeId)) {
                $availableSlots[] = $slot->format('H:i');
            }
        }

        return $availableSlots;
    }
}
