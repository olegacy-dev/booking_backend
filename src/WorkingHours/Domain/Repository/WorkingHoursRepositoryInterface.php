<?php

namespace WorkingHours\Domain\Repository;

use WorkingHours\Domain\Model\WorkingHour;

interface WorkingHoursRepositoryInterface
{
    /**
     * @return WorkingHour[]
     */
    public function findByEmployeeAndWeekday(string $employeeId, int $weekday): array;
}
