<?php declare(strict_types=1);

namespace App\Form;

use App\Exception\Http\FormValidationFailedException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

interface ProcessFormInterface
{
    /**
     * @param Request $request
     * @param string $type
     * @param object $data
     *
     * @throws FormValidationFailedException
     */
    public function process(Request $request, string $type, object $data): FormInterface;
}
