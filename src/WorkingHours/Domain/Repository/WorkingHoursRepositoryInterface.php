<?php

namespace WorkingHours\Domain\Repository;

use WorkingHours\Domain\Model\WorkingHour;

interface WorkingHoursRepositoryInterface
{
    /**
     * @return WorkingHour[]
     */
    public function findByWeekday(string $employeeId, int $weekday): array;
}
