<?php

namespace Booking\Application\Service;

use Booking\Domain\Repository\BookingRepositoryInterface;
use Carbon\Carbon;
use ServiceCatalog\Domain\Model\Service;
use ServiceCatalog\Domain\Repository\ServiceRepositoryInterface;
use WorkingHours\Domain\Repository\WorkingHoursRepositoryInterface;

final readonly class SlotAvailabilityChecker implements SlotAvailabilityCheckerInterface
{
    public function __construct(
        private BookingRepositoryInterface $bookingRepository,
        private WorkingHoursRepositoryInterface $workingHoursRepository,
        private ServiceRepositoryInterface $serviceRepository,
    ) {}

    public function isSlotAvailable(Carbon $slot, array $serviceIds, string $employeeId): bool
    {
        $services = array_map(fn (string $id) => $this->serviceRepository->findById($id), $serviceIds);

        if (in_array(null, $services, true)) {
            return false;
        }

        $totalDuration = array_sum(array_map(fn (Service $service) => $service->getDurationInMinutes(), $services));

        $slotEnd = $slot->copy()->addMinutes($totalDuration);

        if (!$this->isEmployeeWorking($employeeId, $slot, $slotEnd)) {
            return false;
        }
        
        $bookings = $this->bookingRepository->findBookingsForEmployeeOnDate($employeeId, $slot);

        foreach ($bookings as $booking) {
            if ($slot->lessThan($booking->getEnd()) && $slotEnd->greaterThan($booking->getStart())) {
                return false;
            }
        }

        return true;
    }

    private function isEmployeeWorking(string $employeeId, Carbon $slotStart, Carbon $slotEnd): bool
    {
        $workingHours = $this->workingHoursRepository->findByEmployeeAndWeekday($employeeId, $slotStart->dayOfWeekIso);
        
        if (!$workingHours) {
            return false;
        }

        foreach ($workingHours as $interval) {
            $intervalStart = Carbon::parse("{$slotStart->toDateString()} {$interval->getStartTime()}");
            $intervalEnd = Carbon::parse("{$slotStart->toDateString()}  {$interval->getEndTime()}");

            if ($slotStart->greaterThanOrEqualTo($intervalStart) && $slotEnd->lessThanOrEqualTo($intervalEnd)) {
                return true;
            }
        }

        return false;
    }
}
