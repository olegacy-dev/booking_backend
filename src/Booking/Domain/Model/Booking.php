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
    ) {}

    public static function create(Uuid $id, Uuid $employeeId, Carbon $start, Carbon $end, array $serviceIds): self
    {
        return new self($id, $employeeId, $start, $end, $serviceIds);
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
}
