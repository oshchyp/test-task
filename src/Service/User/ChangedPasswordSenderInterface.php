<?php declare(strict_types=1);

namespace App\Service\User;

interface ChangedPasswordSenderInterface
{
    public function send(string $email, string $password): void;
}
