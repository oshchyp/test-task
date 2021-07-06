<?php declare(strict_types=1);

namespace App\EntityManager;

interface SearchRequestInterface
{
    public function getLimit(): int;

    public function getPage(): int;
}
