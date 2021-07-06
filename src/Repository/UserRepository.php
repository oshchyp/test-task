<?php

namespace App\Repository;

use App\Entity\User;
use App\EntityManager\User\UserSearchRequestInterface;
use App\Object\DoctrinePaginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function search(UserSearchRequestInterface $request): Paginator
    {
        $qb = $this->createQueryBuilder('u');

        if ($request->emailIsNotEmpty()) {
            $qb
                ->andWhere($qb->expr()->like('u.email', ':email'))
                ->setParameter('email', sprintf('%%%s%%', $request->getEmail()));
        }

        if ($request->usernameIsNotEmpty()) {
            $qb
                ->andWhere($qb->expr()->like('u.username', ':username'))
                ->setParameter('username', sprintf('%%%s%%', $request->getUsername()));
        }

        return DoctrinePaginator::create($qb)->paginate($request);
    }
}
