<?php

namespace Booking\Domain\Model;

use Carbon\Carbon;
use Shared\Domain\ValueObject\Uuid;

final readonly class Booking
{
    public function __construct(
        private Uuid $id,
        private Uuid $employeeId,
        private Carbon $start,
        private Carbon $end,
        private array $serviceIds,
        private Carbon $createdAt
    ) {}

    public static function create(Uuid $id, Uuid $employeeId, Carbon $start, Carbon $end, array $serviceIds, Carbon $createdAt): self
    {
        return new self($id, $employeeId, $start, $end, $serviceIds, $createdAt);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getEmployeeId(): Uuid
    {
        return $this->employeeId;
    }

    public function getStart(): Carbon
    {
        return $this->start;
    }

    public function getEnd(): Carbon
    {
        return $this->end;
    }

    public function getServiceIds(): array
    {
        return $this->serviceIds;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
