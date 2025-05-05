<?php

namespace Shared\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

final readonly class Uuid
{
    private function __construct(private readonly string $value) {}

    public static function generate(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public static function fromString(string $value): self
    {
        if (!RamseyUuid::isValid($value)) {
            throw new InvalidArgumentException("Invalid UUID string: $value");
        }

        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function equals(Uuid $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
