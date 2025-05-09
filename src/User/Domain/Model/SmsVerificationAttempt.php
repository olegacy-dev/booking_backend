<?php

namespace User\Domain\Model;

use Carbon\Carbon;
use Shared\Domain\ValueObject\Uuid;

final readonly class SmsVerificationAttempt
{
    public function __construct(
        private Uuid $id,
        private ?string $name,
        private string $phoneCode,
        private string $phoneNumber,
        private string $code,
        private Carbon $expiresAt,
        private int $attempts,
        private Carbon $createdAt,
    ) {}

    public function isExpired(): bool
    {
        return $this->expiresAt->isPast();
    }

    public function withNewCode(string $newCode, Carbon $newExpiresAt): self
    {
        return new self(
            $this->id,
            $this->name,
            $this->phoneCode,
            $this->phoneNumber,
            $newCode,
            $newExpiresAt,
            $this->attempts + 1,
            $this->createdAt
        );
    }

    public static function create(
        Uuid $id,
        ?string $name,
        string $phoneCode,
        string $phoneNumber,
        string $code,
        Carbon $expiresAt,
        int $attempts,
        Carbon $createdAt
    ): self {
        return new self($id, $name, $phoneCode, $phoneNumber, $code, $expiresAt, $attempts, $createdAt);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
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

    public function getCode(): string
    {
        return $this->code;
    }

    public function getExpiresAt(): Carbon
    {
        return $this->expiresAt;
    }

    public function getAttempts(): int
    {
        return $this->attempts;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
