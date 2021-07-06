<?php declare(strict_types=1);

namespace App\Exception\Http;

use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationFailedException extends \RuntimeException
{
    /**
     * ValidationFailedException constructor.
     * @param ConstraintViolationListInterface $violationList
     */
    public function __construct(
        private ConstraintViolationListInterface $violationList
    )
    {
        parent::__construct('Data not valid');
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolationList(): ConstraintViolationListInterface
    {
        return $this->violationList;
    }
}
