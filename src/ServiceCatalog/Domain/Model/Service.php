<?php

namespace ServiceCatalog\Domain\Model;

use Shared\Domain\ValueObject\Uuid;

final readonly class Service
{
    public function __construct(
        private Uuid $id,
        private string $name,
        private string $description,
        private int $durationInMinutes,
        private bool $isActive
    ) {}

    public static function create(Uuid $id, string $name, string $description, int $durationMinutes, bool $isActive): self
    {
        return new self($id, $name, $description, $durationMinutes, $isActive);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDurationInMinutes(): int
    {
        return $this->durationInMinutes;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }
}
