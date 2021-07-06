<?php declare(strict_types=1);

namespace App\Object\User;

use App\Service\User\UserCreateDataInterface;
use App\Service\User\UserCreateRequestInterface;

final class UserCreateData implements UserCreateDataInterface
{
    public function __construct(
        private string $email,
        private string $username,
        private string $password
    )
    {
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public static function makeFromRequest(string $password, UserCreateRequestInterface $request): self
    {
        return new self(
            email: $request->getEmail(),
            username: $request->getUsername(),
            password: $password
        );
    }
}
