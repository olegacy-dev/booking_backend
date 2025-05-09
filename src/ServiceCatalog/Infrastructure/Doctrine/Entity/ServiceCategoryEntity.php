<?php

namespace ServiceCatalog\Infrastructure\Doctrine\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'service_categories')]
class ServiceCategoryEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'guid', nullable: false)]
    private string $id;

    #[ORM\Column(name: 'name', type: 'string', nullable: false)]
    private string $name;

    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false)]
    private Carbon $createdAt;

    public function __construct(string $id, string $name, Carbon $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
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

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }
}
