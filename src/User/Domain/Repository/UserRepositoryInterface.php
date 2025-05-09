<?php

namespace User\Domain\Repository;

use User\Domain\Model\User;

interface UserRepositoryInterface
{
    public function findByPhone(string $phoneCode, string $phoneNumber): ?User;

    public function existsByPhone(string $phoneCode, string $phoneNumber): bool;

    public function save(User $user): void;
}
