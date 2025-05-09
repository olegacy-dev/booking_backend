<?php

namespace Booking\Infrastructure\Doctrine\Mapper;

use Booking\Domain\Model\Booking;
use Booking\Infrastructure\Doctrine\Entity\BookingEntity;
use Shared\Domain\ValueObject\Uuid;

final class BookingMapper
{
    public static function toDomain(BookingEntity $entity): Booking
    {
        return Booking::create(
            Uuid::fromString($entity->getId()),
            Uuid::fromString($entity->getEmployeeId()),
            $entity->getStartAt(),
            $entity->getEndAt(),
            array_map(Uuid::fromString(...), $entity->getServiceIds())
        );
    }

    public static function toEntity(Booking $booking): BookingEntity
    {
        $servicesIds = array_map(fn($id) => $id->toString(), $booking->getServiceIds());

        return new BookingEntity(
            $booking->getId()->toString(),
            $booking->getEmployeeId()->toString(),
            $booking->getStart(),
            $booking->getEnd(),
            $servicesIds
        );
    }
}
