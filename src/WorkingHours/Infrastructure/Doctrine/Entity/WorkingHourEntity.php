<?php

namespace WorkingHours\Infrastructure\Doctrine\Entity;

use Carbon\CarbonImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'working_hours')]
final class WorkingHourEntity
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid')]
    private string $id;

    #[ORM\Column(name: 'weekday', type: 'integer', nullable: false)]
    private int $weekday;

    #[ORM\Column(name: 'start_time', type: 'string', length: 5, nullable: false)]
    private string $startTime;

    #[ORM\Column(name: 'end_time', type: 'string', length: 5, nullable: false)]
    private string $endTime;

    #[ORM\Column(name: 'created_at', type: 'datetime_immutable', nullable: false)]
    private CarbonImmutable $createdAt;

    public function __construct(
        string $id,
        int $weekday,
        string $startTime,
        string $endTime
    ) {
        $this->id = $id;
        $this->weekday = $weekday;
        $this->startTime = $startTime;
        $this->endTime = $endTime;

        $this->createdAt = new CarbonImmutable();
    }

    public function getId(): string
    {
        return $this->id;
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

    public function getCreatedAt(): CarbonImmutable
    {
        return $this->createdAt;
    }
}
