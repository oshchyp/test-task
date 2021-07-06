<?php declare(strict_types=1);

namespace App\EntityManager\User;

use App\EntityManager\SearchRequestInterface;

interface UserSearchRequestInterface extends SearchRequestInterface
{
    public function getUsername(): string;

    public function usernameIsNotEmpty(): bool;

    public function getEmail(): string;

    public function emailIsNotEmpty(): bool;
}
