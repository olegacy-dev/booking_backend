<?php

namespace Booking\Application\Service;

use Carbon\Carbon;

interface SlotAvailabilityCheckerInterface
{
    public function isSlotAvailable(Carbon $slot, array $serviceIds, string $employeeId): bool;
}
