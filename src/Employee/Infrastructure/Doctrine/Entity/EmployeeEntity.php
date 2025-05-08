<?php

namespace Employee\Infrastructure\Doctrine\Entity;

use Carbon\CarbonImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'employees')]
final class EmployeeEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'guid', nullable: false)]
    private string $id;

    #[ORM\Column(name: 'name', type: 'string', length: 100, nullable: false)]
    private string $name;

    #[ORM\Column(name: 'category_id', type: 'guid', nullable: false)]
    private string $categoryId;

    #[ORM\Column(name: 'created_at', type: 'datetime_immutable', nullable: false)]
    private CarbonImmutable $createdAt;

    public function __construct(string $id, string $name, string $categoryId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->categoryId = $categoryId;

        $this->createdAt = new CarbonImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function setCategoryId(string $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getCreatedAt(): CarbonImmutable
    {
        return $this->createdAt;
    }
}
