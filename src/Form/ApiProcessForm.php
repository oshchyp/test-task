<?php declare(strict_types=1);

namespace App\Form;

use App\Exception\Http\FormValidationFailedException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

final class ApiProcessForm implements ProcessFormInterface
{
    public function __construct(
        private FormFactoryInterface $factory)
    {
    }

    /**
     * @param Request $request
     * @param string $type
     * @param object $data
     * @return FormInterface
     * @throws FormValidationFailedException
     */
    public function process(Request $request, string $type, object $data): FormInterface
    {
        $form = $this->factory->createNamed('', $type, $data, [
            //   'csrf_protection' => false
        ]);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()){
            throw new FormValidationFailedException($form);
        }

        return $form;
    }
}
