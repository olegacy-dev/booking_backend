<?php

namespace WorkingHours\Application\UseCase;

use WorkingHours\Application\Dto\WorkingHourDto;
use WorkingHours\Domain\Model\WorkingHour;
use WorkingHours\Domain\Repository\WorkingHoursRepositoryInterface;

final readonly class GetWorkingHoursByWeekday
{
    public function __construct(
        private WorkingHoursRepositoryInterface $repository
    ) {}

    public function __invoke(int $weekday): array
    {
        $workingHours = $this->repository->findByWeekday($weekday);

        return array_map(fn (WorkingHour $workingHour) => new WorkingHourDto(
            $workingHour->getId()->toString(),
            $workingHour->getWeekday(),
            $workingHour->getStartTime(),
            $workingHour->getEndTime(),
        ), $workingHours);
    }
}
