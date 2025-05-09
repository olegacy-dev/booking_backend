<?php

namespace Booking\Domain\Repository;

use Booking\Domain\Model\Booking;
use Carbon\Carbon;

interface BookingRepositoryInterface
{
    /**
     * @return Booking[]
     */
    public function findBookingsForEmployeeOnDate(string $employeeId, Carbon $date): array;

    public function save(Booking $booking): void;
}
