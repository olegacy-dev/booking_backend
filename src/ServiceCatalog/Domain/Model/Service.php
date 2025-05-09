<?php

namespace ServiceCatalog\Domain\Model;

use Carbon\Carbon;
use Shared\Domain\ValueObject\Uuid;

final readonly class Service
{
    public function __construct(
        private Uuid $id,
        private Uuid $categoryId,
        private string $name,
        private string $description,
        private int $durationInMinutes,
        private bool $isActive,
        private Carbon $createdAt
    ) {}

    public static function create(Uuid $id, Uuid $categoryId, string $name, string $description, int $durationMinutes, bool $isActive, Carbon $createdAt): self
    {
        return new self($id, $categoryId,$name, $description, $durationMinutes, $isActive, $createdAt);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCategoryId(): Uuid
    {
        return $this->categoryId;
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

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
