<?php

namespace ServiceCatalog\Domain\Model;

use Shared\Domain\ValueObject\Uuid;

final readonly class ServiceCategory
{
    public function __construct(
        private Uuid $id,
        private string $name
    ) {}

    public static function create(Uuid $id, string $name): self
    {
        return new self($id, $name);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
