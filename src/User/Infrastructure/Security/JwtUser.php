<?php

namespace User\Infrastructure\Security;

use Symfony\Component\Security\Core\User\UserInterface;

readonly class JwtUser implements UserInterface
{
    public function __construct(
        private string $id,
        private array $roles = ['ROLE_USER']
    ) {}

    public function getUserIdentifier(): string
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials(): void {}
}
