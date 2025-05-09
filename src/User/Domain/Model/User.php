<?php

namespace User\Domain\Model;

use Carbon\Carbon;
use Shared\Domain\ValueObject\Uuid;

final readonly class User
{
    private function __construct(
        private Uuid $id,
        private string $name,
        private string $phoneCode,
        private string $phoneNumber,
        private Carbon $createdAt
    ) {}

    public static function register(
        Uuid $id,
        string $name,
        string $phoneCode,
        string $phoneNumber,
        Carbon $createdAt
    ): self {
        return new self($id, $name, $phoneCode, $phoneNumber, $createdAt);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhoneCode(): string
    {
        return $this->phoneCode;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
