<?php declare(strict_types=1);

namespace App\Service\User;

interface UserCreateDataInterface extends UserCreateRequestInterface
{
    public function getPassword(): string;
}
