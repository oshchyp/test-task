<?php declare(strict_types=1);

namespace App\Object\Request;

use App\ArgumentResolver\AppRequestInterface;
use App\EntityManager\SearchRequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

abstract class SearchRequestAbstract implements SearchRequestInterface, AppRequestInterface
{
    private const DEFAULT_LIMIT = 10;
    private const DEFAULT_PAGE = 1;

    /**
     * @Assert\LessThan(100)
     * @Assert\GreaterThan(0)
     */
    private int $limit;

    /**
     * @Assert\GreaterThan(0)
     */
    protected int $page;

    public function __construct(Request $request)
    {
        $this->limit = $request->query->getInt('limit', self::DEFAULT_LIMIT);
        $this->page = $request->query->getInt('page', self::DEFAULT_PAGE);
    }

    /**
     * @return int
     */
    final public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    final public function getPage(): int
    {
        return $this->page;
    }
}
