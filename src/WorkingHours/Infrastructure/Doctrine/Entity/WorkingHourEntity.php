<?php

namespace WorkingHours\Infrastructure\Doctrine\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'working_hours')]
final class WorkingHourEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'guid', nullable: false)]
    private string $id;

    #[ORM\Column(name: 'employee_id', type: 'guid', nullable: false)]
    private string $employeeId;

    #[ORM\Column(name: 'weekday', type: 'integer', nullable: false)]
    private int $weekday;

    #[ORM\Column(name: 'start_time', type: 'string', length: 5, nullable: false)]
    private string $startTime;

    #[ORM\Column(name: 'end_time', type: 'string', length: 5, nullable: false)]
    private string $endTime;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    private Carbon $createdAt;

    public function __construct(
        string $id,
        string $employeeId,
        int $weekday,
        string $startTime,
        string $endTime
    ) {
        $this->id = $id;
        $this->employeeId = $employeeId;
        $this->weekday = $weekday;
        $this->startTime = $startTime;
        $this->endTime = $endTime;

        $this->createdAt = new Carbon();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeId;
    }

    public function getWeekday(): int
    {
        return $this->weekday;
    }

    public function setWeekday(int $weekday): void
    {
        $this->weekday = $weekday;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function setStartTime(string $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }

    public function setEndTime(string $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
