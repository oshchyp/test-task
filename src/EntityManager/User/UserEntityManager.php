<?php declare(strict_types=1);

namespace App\EntityManager\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\User\UserCreateDataInterface;
use App\Service\User\UserCreateRequestInterface;
use App\Service\User\UserCreatorEntityManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class UserEntityManager implements UserEntityManagerInterface, UserCreatorEntityManagerInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository
    )
    {
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function search(UserSearchRequestInterface $userSearchRequest): Paginator
    {
        return $this->userRepository->search($userSearchRequest);
    }

    public function exist(UserCreateRequestInterface $userCreateRequest): bool
    {
        return !empty(
            $this->userRepository->findOneBy([
                'email' => $userCreateRequest->getEmail(),
                'username' => $userCreateRequest->getUsername()
            ])
        );
    }

    public function create(UserCreateDataInterface $data): void
    {
        $this->save(
            User::makeFromCreateData($data)
        );
    }

    public function delete(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
