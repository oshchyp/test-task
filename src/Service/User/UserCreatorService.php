<?php declare(strict_types=1);

namespace App\Service\User;

use App\Exception\UserExistsException;
use App\Object\User\UserCreateData;

final class UserCreatorService implements UserCreatorServiceInterface
{
    private const PASSWORD_LENGTH = 5;

    public function __construct(
        private ChangedPasswordSenderInterface $changedPasswordSender,
        private UserCreatorEntityManagerInterface $entityManager,
        private PasswordHasherInterface $passwordHasher
    )
    {
    }

    /**
     * @param UserCreateRequestInterface $userCreateRequest
     * @throws UserExistsException
     */
    public function create(UserCreateRequestInterface $userCreateRequest): void
    {
        if ($this->entityManager->exist($userCreateRequest)) {
            throw new UserExistsException();
        }

        $password = $this->generatePassword();

        $this->createUser($password, $userCreateRequest);
        $this->sendPassword($password, $userCreateRequest);
    }

    private function generatePassword(): string
    {
        return bin2hex(random_bytes(
            self::PASSWORD_LENGTH
        ));
    }

    private function createUser(string $password, UserCreateRequestInterface $request): void
    {
        $this->entityManager->create(
            UserCreateData::makeFromRequest(
                password: $this->passwordHasher->hash($password),
                request: $request
            )
        );
    }

    private function sendPassword(string $password, UserCreateRequestInterface $request): void
    {
        $this->changedPasswordSender->send(
            email: $request->getEmail(),
            password: $password
        );
    }
}
