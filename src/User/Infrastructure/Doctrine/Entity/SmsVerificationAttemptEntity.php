<?php

namespace User\Infrastructure\Doctrine\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'sms_verification_attempts')]
#[ORM\UniqueConstraint(columns: ['phone_code', 'phone_number'])]
class SmsVerificationAttemptEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'string', length: 36, nullable: false)]
    public string $id;

    #[ORM\Column(name: 'name', type: 'string', length: 100, nullable: true)]
    public ?string $name;

    #[ORM\Column(name: 'phone_code', type: 'string', length: 8, nullable: false)]
    public string $phoneCode;

    #[ORM\Column(name: 'phone_number', type: 'string', length: 32, nullable: false)]
    public string $phoneNumber;

    #[ORM\Column(name: 'code', type: 'string', length: 6, nullable: false)]
    public string $code;

    #[ORM\Column(name: 'expires_at', type: 'datetime', nullable: false)]
    public Carbon $expiresAt;

    #[ORM\Column(name: 'attempts', type: 'integer', nullable: false)]
    public int $attempts = 0;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    public Carbon $createdAt;

    public function __construct(
        string $id,
        ?string $name,
        string $phoneCode,
        string $phoneNumber,
        string $code,
        Carbon $expiresAt,
        int $attempts,
        Carbon $createdAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->phoneCode = $phoneCode;
        $this->phoneNumber = $phoneNumber;
        $this->code = $code;
        $this->expiresAt = $expiresAt;
        $this->attempts = $attempts;
        $this->createdAt = $createdAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoneCode(): string
    {
        return $this->phoneCode;
    }

    public function setPhoneCode(string $phoneCode): self
    {
        $this->phoneCode = $phoneCode;

        return $this;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getExpiresAt(): Carbon
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(Carbon $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getAttempts(): int
    {
        return $this->attempts;
    }

    public function setAttempts(int $attempts): self
    {
        $this->attempts = $attempts;

        return $this;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
