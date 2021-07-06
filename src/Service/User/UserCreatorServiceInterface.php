<?php declare(strict_types=1);

namespace App\Service\User;

use App\Exception\UserExistsException;

interface UserCreatorServiceInterface
{
    /**
     * @param UserCreateRequestInterface $userCreateRequest
     * @throws UserExistsException
     */
    public function create(UserCreateRequestInterface $userCreateRequest): void;
}
