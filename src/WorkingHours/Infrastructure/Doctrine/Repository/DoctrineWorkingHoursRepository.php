<?php

namespace WorkingHours\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use WorkingHours\Domain\Repository\WorkingHoursRepositoryInterface;
use WorkingHours\Infrastructure\Doctrine\Entity\WorkingHourEntity;
use WorkingHours\Infrastructure\Doctrine\Mapper\WorkingHourMapper;

final readonly class DoctrineWorkingHoursRepository implements WorkingHoursRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function findByEmployeeAndWeekday(string $employeeId, int $weekday): array
    {
        $repository = $this->em->getRepository(WorkingHourEntity::class);

        $entities = $repository->findBy(['employeeId' => $employeeId,'weekday' => $weekday]);

        return array_map(fn (WorkingHourEntity $entity) => WorkingHourMapper::toDomain($entity), $entities);
    }
}
