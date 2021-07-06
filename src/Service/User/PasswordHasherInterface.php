<?php declare(strict_types=1);

namespace App\Service\User;

interface PasswordHasherInterface
{
    public function hash(string $password): string;
}
