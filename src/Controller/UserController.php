<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Model\UserCRUDModelInterface;
use App\Object\Request\UserSearchRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Route("/users")
 */
final class UserController extends ApiControllerAbstract
{
    public function __construct(
        private UserCRUDModelInterface $model
    )
    {
    }

    /**
     * @Route("", methods={"GET"})
     *
     * @param UserSearchRequest $userSearchRequest
     * @return JsonResponse
     */
    public function index(UserSearchRequest $userSearchRequest): JsonResponse
    {
        return $this->apiResponse(
            $this->model->search($userSearchRequest)
        );
    }

    /**
     * @Route("", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $this->model->create($request);

        return $this->noContentResponse();
    }

    /**
     * @Route("/{id<\d+>}", methods={"POST"})
     *
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function update(User $user, Request $request): Response
    {
        $this->model->update($user, $request);

        return $this->noContentResponse();
    }

    /**
     * @Route("/{id<\d+>}", methods={"DELETE"})
     *
     * @param User $user
     * @return Response
     */
    public function delete(User $user): Response
    {
        $this->model->delete($user);

        return $this->noContentResponse();
    }
}
