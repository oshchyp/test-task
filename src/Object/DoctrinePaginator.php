<?php declare(strict_types=1);

namespace App\Object;

use App\EntityManager\SearchRequestInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class DoctrinePaginator
{
    public function __construct(
        private QueryBuilder $queryBuilder,
        private bool $fetchJoinCollection = true
    ){}

    /**
     * @param SearchRequestInterface $request
     * @return int
     */
    private function getFirstResult(SearchRequestInterface $request): int
    {
        return ($request->getPage() - 1) * $request->getLimit();
    }

    /**
     * @param SearchRequestInterface $query
     * @return Paginator
     */
    public function paginate(SearchRequestInterface $query): Paginator
    {
        $this->queryBuilder->setFirstResult($this->getFirstResult($query));

        if (null !== $query->getLimit()){
            $this->queryBuilder->setMaxResults($query->getLimit());
        }

        return new Paginator($this->queryBuilder, $this->fetchJoinCollection);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param bool $fetchJoinCollection
     * @return static
     */
    public static function create(QueryBuilder $queryBuilder, bool $fetchJoinCollection = true): self
    {
        return new self($queryBuilder, $fetchJoinCollection);
    }
}
