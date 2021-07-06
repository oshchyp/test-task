<?php declare(strict_types=1);

namespace App\Model;

use App\Entity\User;
use App\EntityManager\User\UserSearchRequestInterface;
use App\Exception\Http\FormValidationFailedException;
use App\Object\ElementsResponse;
use Symfony\Component\HttpFoundation\Request;

interface UserCRUDModelInterface
{
    public function search(UserSearchRequestInterface $request): ElementsResponse;

    /**
     * @param Request $request
     * @throws FormValidationFailedException
     */
    public function create(Request $request): void;

    /**
     * @param User $user
     * @param Request $request
     * @throws FormValidationFailedException
     */
    public function update(User $user, Request $request): void;

    /**
     * @param User $user
     */
    public function delete(User $user): void;
}
