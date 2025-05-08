<?php

namespace WorkingHours\Infrastructure\Doctrine\Mapper;

use Shared\Domain\ValueObject\Uuid;
use WorkingHours\Domain\Model\WorkingHour;
use WorkingHours\Infrastructure\Doctrine\Entity\WorkingHourEntity;

final class WorkingHourMapper
{
    public static function toDomain(WorkingHourEntity $workingHourEntity): WorkingHour
    {
        return WorkingHour::create(
            Uuid::fromString($workingHourEntity->getId()),
            Uuid::fromString($workingHourEntity->getEmployeeId()),
            $workingHourEntity->getWeekday(),
            $workingHourEntity->getStartTime(),
            $workingHourEntity->getEndTime(),
        );
    }

    public static function toEntity(WorkingHour $workingHour): WorkingHourEntity
    {
        return new WorkingHourEntity(
            $workingHour->getId()->toString(),
            $workingHour->getEmployeeId()->toString(),
            $workingHour->getWeekday(),
            $workingHour->getStartTime(),
            $workingHour->getEndTime(),
        );
    }
}
