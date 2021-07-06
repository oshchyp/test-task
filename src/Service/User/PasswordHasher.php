<?php declare(strict_types=1);

namespace App\Service\User;

final class PasswordHasher implements PasswordHasherInterface
{
    public function hash(string $password): string
    {
        // TODO: Implement hash() method.
        return $password;
    }
}
