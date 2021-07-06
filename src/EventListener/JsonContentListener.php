<?php declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class JsonContentListener
{
    public function __invoke(ControllerEvent $event)
    {
        $request = $event->getRequest();

        if ($request->getContentType() !== 'json' || !$request->getContent()) {
            return;
        }

        try {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        } catch (\Exception $exception){
            throw new BadRequestHttpException('Invalid data');
        }
    }
}
