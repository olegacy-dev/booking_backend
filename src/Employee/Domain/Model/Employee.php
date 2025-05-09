<?php

namespace Employee\Domain\Model;

use Carbon\Carbon;
use Shared\Domain\ValueObject\Uuid;

final readonly class Employee
{
    public function __construct(
        private Uuid $id,
        private string $name,
        private Uuid $categoryId,
        private Carbon $createdAt
    ) {}

    public static function create(Uuid $id, string $name, Uuid $categoryId, Carbon $createdAt): self
    {
        return new self($id, $name, $categoryId, $createdAt);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategoryId(): Uuid
    {
        return $this->categoryId;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
