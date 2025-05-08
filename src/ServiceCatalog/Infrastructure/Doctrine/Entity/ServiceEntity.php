<?php

namespace ServiceCatalog\Infrastructure\Doctrine\Entity;

use Carbon\CarbonImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'services')]
class ServiceEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'guid', nullable: false)]
    private string $id;

    #[ORM\Column(name: 'category_id', type: 'guid', nullable: false)]
    private string $categoryId;

    #[ORM\Column(name: 'name', type: 'string', length: 100, nullable: false)]
    private string $name;

    #[ORM\Column(name: 'description', type: 'text', nullable: false)]
    private string $description;

    #[ORM\Column(name: 'duration_in_minutes', type: 'integer', nullable: false)]
    private int $durationInMinutes;

    #[ORM\Column(name: 'is_active', type: 'boolean', nullable: false)]
    private bool $isActive;

    #[ORM\Column(name: 'created_at', type: 'datetime_immutable', nullable: false)]
    private CarbonImmutable $createdAt;

    public function __construct(
        string $id,
        string $categoryId,
        string $name,
        string $description,
        int $durationInMinutes,
        bool $isActive
    ) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->description = $description;
        $this->durationInMinutes = $durationInMinutes;
        $this->isActive = $isActive;

        $this->createdAt = new CarbonImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function setCategoryId(string $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDurationInMinutes(): int
    {
        return $this->durationInMinutes;
    }

    public function setDurationInMinutes(int $durationInMinutes): void
    {
        $this->durationInMinutes = $durationInMinutes;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getCreatedAt(): CarbonImmutable
    {
        return $this->createdAt;
    }
}
