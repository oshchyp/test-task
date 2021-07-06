<?php declare(strict_types=1);

namespace App\Object\Request;

use App\EntityManager\User\UserSearchRequestInterface;
use Symfony\Component\HttpFoundation\Request;

final class UserSearchRequest extends SearchRequestAbstract implements UserSearchRequestInterface
{
    private string $username = '';
    private string $email = '';

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $username = $request->query->get('username');
        if (is_string($username)){
            $this->username = $username;
        }

        $email = $request->query->get('email');
        if (is_string($email)){
            $this->email = $email;
        }
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function usernameIsNotEmpty(): bool
    {
        return !empty($this->username);
    }

    public function getEmail(): string
    {
       return $this->email;
    }

    public function emailIsNotEmpty(): bool
    {
        return !empty($this->email);
    }
}
