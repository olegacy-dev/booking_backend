<?php

namespace WorkingHours\Domain\Model;

use Carbon\Carbon;
use Shared\Domain\ValueObject\Uuid;

final readonly class WorkingHour
{
    public function __construct(
        private Uuid $id,
        private Uuid $employeeId,
        private int $weekday,
        private string $startTime,
        private string $endTime,
        private Carbon $createdAt
    ) {}

    public static function create(Uuid $id,  Uuid $employeeId, int $weekday, string $startTime, string $endTime, Carbon $createdAt): self
    {
        return new self($id, $employeeId, $weekday, $startTime, $endTime, $createdAt);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getEmployeeId(): Uuid
    {
        return $this->employeeId;
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

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
