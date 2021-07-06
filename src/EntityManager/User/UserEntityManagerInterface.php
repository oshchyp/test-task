<?php declare(strict_types=1);

namespace App\EntityManager\User;

use App\Entity\User;
use Doctrine\ORM\Tools\Pagination\Paginator;

interface UserEntityManagerInterface
{
    /**
     * @param User $user
     */
    public function save(User $user): void;

    /**
     * @param UserSearchRequestInterface $userSearchRequest
     * @return Paginator
     */
    public function search(UserSearchRequestInterface $userSearchRequest): Paginator;

    /**
     * @param User $user
     */
    public function delete(User $user): void;
}
