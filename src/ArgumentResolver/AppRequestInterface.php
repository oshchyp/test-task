<?php declare(strict_types=1);

namespace App\ArgumentResolver;

use Symfony\Component\HttpFoundation\Request;

interface AppRequestInterface
{
    public function __construct(Request $request);
}
