<?php

namespace WorkingHours\Domain\Model;

use Shared\Domain\ValueObject\Uuid;

final readonly class WorkingHour
{
    public function __construct(
        private Uuid $id,
        private int $weekday,
        private string $startTime,
        private string $endTime
    ) {}

    public static function create(Uuid $id, int $weekday, string $startTime, string $endTime): self
    {
        return new self($id, $weekday, $startTime, $endTime);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getWeekday(): int
    {
        return $this->weekday;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }
}
