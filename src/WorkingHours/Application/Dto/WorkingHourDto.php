<?php

namespace WorkingHours\Application\Dto;

final readonly class WorkingHourDto
{
    public function __construct(
        public string $id,
        public int $weekday,
        public string $startTime,
        public string $endTime
    ) {}
}
