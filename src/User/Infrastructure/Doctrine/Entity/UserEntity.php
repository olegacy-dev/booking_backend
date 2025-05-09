<?php

namespace User\Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Carbon\Carbon;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[ORM\UniqueConstraint(columns: ['phone_code', 'phone_number'])]
class UserEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'string', length: 36, nullable: false)]
    public string $id;

    #[ORM\Column(name: 'name', type: 'string', length: 100, nullable: false)]
    public string $name;

    #[ORM\Column(name: 'phone_code', type: 'string', length: 8, nullable: false)]
    public string $phoneCode;

    #[ORM\Column(name: 'phone_number', type: 'string', length: 32, nullable: false)]
    public string $phoneNumber;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    public Carbon $createdAt;

    public function __construct(string $id, string $name, string $phoneCode, string $phoneNumber, Carbon $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phoneCode = $phoneCode;
        $this->phoneNumber = $phoneNumber;
        $this->createdAt =  $createdAt;
    }

    public function getId(): string
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

