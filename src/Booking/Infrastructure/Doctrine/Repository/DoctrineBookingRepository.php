<?php

namespace Booking\Infrastructure\Doctrine\Repository;

use Booking\Domain\Model\Booking;
use Booking\Domain\Repository\BookingRepositoryInterface;
use Booking\Infrastructure\Doctrine\Entity\BookingEntity;
use Booking\Infrastructure\Doctrine\Mapper\BookingMapper;
use Carbon\Carbon;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineBookingRepository implements BookingRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    /**
     * @return Booking[]
     */
    public function findBookingsForEmployeeOnDate(string $employeeId, Carbon $date): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb
            ->select('b')
            ->from(BookingEntity::class, 'b')
            ->andWhere('b.employeeId = :employeeId')
            ->andWhere('b.startAt BETWEEN :start AND :end')
            ->setParameter('employeeId', $employeeId)
            ->setParameter('start', $date->copy()->startOfDay())
            ->setParameter('end', $date->copy()->endOfDay());

        $entities = $qb->getQuery()->getResult();

        return array_map(fn (BookingEntity $entity) => BookingMapper::toDomain($entity), $entities);
    }

    public function save(Booking $booking): void
    {
        $entity = BookingMapper::toEntity($booking);

        $this->em->persist($entity);
        $this->em->flush();
    }
}
