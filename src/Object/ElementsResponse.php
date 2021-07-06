<?php declare(strict_types=1);

namespace App\Object;

use Doctrine\ORM\Tools\Pagination\Paginator;

final class ElementsResponse
{
    private iterable $elements;
    private int $count;

    public function __construct(iterable $elements, int $count)
    {
        $this->elements = $elements;
        $this->count = $count;
    }

    public static function makeFromPaginator(Paginator $paginator): self
    {
        try {
            $elements = iterator_to_array($paginator->getIterator());
        } catch (\Throwable $exception){
            $elements = [];
        }

        return new self(
            elements: $elements,
            count: $paginator->count()
        );
    }

    /**
     * @return iterable
     */
    public function getElements(): iterable
    {
        return $this->elements;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }
}
