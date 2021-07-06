<?php declare(strict_types=1);

namespace App\ArgumentResolver;

use App\Exception\Http\ValidationFailedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class AppRequestArgumentResolver implements ArgumentValueResolverInterface
{
    public function __construct(
        private ValidatorInterface $validator
    ){}

    /**
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return bool
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        try {
            $classImplements = class_implements($argument->getType());

            return $classImplements !== false && in_array(AppRequestInterface::class, array_values($classImplements));
        } catch (\Exception $e) {

            return false;
        }
    }

    /**
     * @param Request $request
     * @param ArgumentMetadata $argument
     * @return \Generator
     */
    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $class = $argument->getType();
        $queryData = new $class($request);

        $constraintViolationList = $this->validator->validate($queryData);

        if (0 !== $constraintViolationList->count()){
            throw new ValidationFailedException($constraintViolationList);
        }

        yield $queryData;
    }
}
