<?php

namespace Booking\Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Carbon\Carbon;

#[ORM\Entity]
#[ORM\Table(name: 'bookings')]
final class BookingEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'guid', nullable: false)]
    private string $id;

    #[ORM\Column(name: 'employee_id', type: 'guid', nullable: false)]
    private string $employeeId;

    #[ORM\Column(name: 'start_at', type: 'datetime', nullable: false)]
    private Carbon $startAt;

    #[ORM\Column(name: 'end_at', type: 'datetime', nullable: false)]
    private Carbon $endAt;

    #[ORM\Column(name: 'service_ids', type: 'json', nullable: false)]
    private array $serviceIds = [];

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    private Carbon $createdAt;

    public function __construct(
        string $id,
        string $employeeId,
        Carbon $startAt,
        Carbon $endAt,
        array $serviceIds,
    ) {
        $this->id = $id;
        $this->employeeId = $employeeId;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->serviceIds = $serviceIds;

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

    public function setEmployeeId(string $employeeId): void
    {
        $this->employeeId = $employeeId;
    }

    public function getStartAt(): Carbon
    {
        return $this->startAt;
    }

    public function setStartAt(Carbon $startAt): void
    {
        $this->startAt = $startAt;
    }

    public function getEndAt(): Carbon
    {
        return $this->endAt;
    }

    public function setEndAt(Carbon $endAt): void
    {
        $this->endAt = $endAt;
    }

    public function getServiceIds(): array
    {
        return $this->serviceIds;
    }

    public function setServiceIds(array $serviceIds): void
    {
        $this->serviceIds = $serviceIds;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
