<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

abstract class ApiControllerAbstract extends AbstractController
{
    /**
     * @param $data
     * @param array $groups
     * @return JsonResponse
     */
    protected function apiResponse($data, array $groups = []): JsonResponse
    {
        $context = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function (object $object) {
                return (string)$object;
            }
        ];

        if (!empty($groups)){
            $context['groups'] = $groups;
        }

        return $this->json($data, 200, [], $context);
    }

    protected function noContentResponse(): Response
    {
        return new Response('', 204);
    }
}
