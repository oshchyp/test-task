<?php declare(strict_types=1);

namespace App\Service\User;

interface UserCreateRequestInterface
{
    public function getEmail(): string;
    public function getUsername(): string;
}
