<?php declare(strict_types=1);

namespace App\Exception\Http;

use Symfony\Component\Form\FormInterface;

final class FormValidationFailedException extends \RuntimeException
{
    public function __construct(
        private FormInterface $form
    )
    {
        parent::__construct('Data not valid');
    }

    /**
     * @return FormInterface
     */
    public function getForm(): FormInterface
    {
        return $this->form;
    }
}
