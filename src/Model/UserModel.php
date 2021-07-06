<?php declare(strict_types=1);

namespace App\Model;

use App\Entity\User;
use App\EntityManager\User\UserEntityManagerInterface;
use App\EntityManager\User\UserSearchRequestInterface;
use App\Exception\UserExistsException;
use App\Form\ProcessFormInterface;
use App\Form\UserCreateType;
use App\Form\UserUpdateType;
use App\Object\ElementsResponse;
use App\Object\User\UserCreateRequest;
use App\Service\User\UserCreatorServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class UserModel implements UserCRUDModelInterface
{
    public function __construct(
        private UserEntityManagerInterface $userEntityManager,
        private ProcessFormInterface $processForm,
        private UserCreatorServiceInterface $userCreatorService
    )
    {
    }

    public function search(UserSearchRequestInterface $request): ElementsResponse
    {
        return ElementsResponse::makeFromPaginator(
            $this->userEntityManager->search($request)
        );
    }

    public function create(Request $request): void
    {
        $createRequest = new UserCreateRequest();
        $this->processForm->process($request, UserCreateType::class, $createRequest);

        try {
            $this->userCreatorService->create($createRequest);
        } catch (UserExistsException $userExistsException) {
            throw new BadRequestHttpException('User already exists');
        }
    }

    public function update(User $user, Request $request): void
    {
        $this->processForm->process($request, UserUpdateType::class, $user);

        $this->userEntityManager->save($user);
    }

    public function delete(User $user): void
    {
        $this->userEntityManager->delete($user);
    }
}
