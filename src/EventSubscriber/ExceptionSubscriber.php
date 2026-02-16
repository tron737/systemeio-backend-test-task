<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => [
                ['onValidationException', 10],
                ['onHttpException', 0],
            ],
        ];
    }

    public function onValidationException(ExceptionEvent $event): void
    {
        $exception =
            $event->getThrowable() instanceof ValidationFailedException ?
                $event->getThrowable() : $event->getThrowable()->getPrevious();

        if (!$exception instanceof ValidationFailedException) {
            return;
        }

        $violations = [];
        foreach ($exception->getViolations() as $violation) {
            $violations[] = [
                'field' => $violation->getPropertyPath(),
                'message' => $violation->getMessage(),
                'invalidValue' => $violation->getInvalidValue(),
            ];
        }

        $response = new JsonResponse([
            'error' => $event->getThrowable()->getMessage(),
            'violations' => $violations,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);

        $event->setResponse($response);
    }

    public function onHttpException(ExceptionEvent $event): void
    {
        if ($event->hasResponse()) {
            return;
        }

        $exception = $event->getThrowable();

        if (!$exception instanceof HttpExceptionInterface) {
            return;
        }

        $statusCode = $exception->getStatusCode();
        $headers = $exception->getHeaders();

        $response = new JsonResponse([
            'error' => $exception->getMessage() ?: 'HTTP error',
            'code' => $statusCode,
        ], $statusCode, $headers);

        $event->setResponse($response);
    }
}
