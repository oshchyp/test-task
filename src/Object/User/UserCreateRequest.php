<?php declare(strict_types=1);

namespace App\Object\User;

use App\Service\User\UserCreateRequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class UserCreateRequest implements UserCreateRequestInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     *
     * @var string|null
     */
    private string|null $email;

    /**
     * @Assert\NotBlank()
     *
     * @var string|null
     */
    private string|null  $username;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email ?? '';
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username ?? '';
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }
}
