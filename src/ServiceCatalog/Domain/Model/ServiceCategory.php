<?php

namespace ServiceCatalog\Domain\Model;

use Carbon\Carbon;
use Shared\Domain\ValueObject\Uuid;

final readonly class ServiceCategory
{
    public function __construct(
        private Uuid $id,
        private string $name,
        private Carbon $createdAt
    ) {}

    public static function create(Uuid $id, string $name, Carbon $createdAt): self
    {
        return new self($id, $name, $createdAt);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
