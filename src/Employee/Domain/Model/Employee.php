<?php

namespace Employee\Domain\Model;

use Shared\Domain\ValueObject\Uuid;

final readonly class Employee
{
    public function __construct(
        private Uuid $id,
        private string $name,
        private Uuid $categoryId,
    ) {}

    public static function create(Uuid $id, string $name, Uuid $categoryId): self
    {
        return new self($id, $name, $categoryId);
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
}
