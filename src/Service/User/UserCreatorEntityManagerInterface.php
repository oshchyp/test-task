<?php declare(strict_types=1);

namespace App\Service\User;

interface UserCreatorEntityManagerInterface
{
    public function exist(UserCreateRequestInterface $userCreateRequest): bool;
    public function create(UserCreateDataInterface $data): void;
}
