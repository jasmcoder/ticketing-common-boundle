<?php

declare(strict_types = 1);

namespace Jasmcoder\TicketingCommonBundle\Event;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Throwable;

class ExceptionSubscriber
{
    private string $environment;
    private LoggerInterface $logger;
    private array $exceptionToStatus;

    public function __construct(string $environment, LoggerInterface $logger, array $exceptionToStatus = [])
    {
        $this->environment = $environment;
        $this->logger = $logger;
        $this->exceptionToStatus = $exceptionToStatus;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/vnd.api+json');
        $response->setStatusCode($this->determineStatusCode($exception));
        $response->setData($this->getErrorMessage($exception, $response));

        $event->setResponse($response);
    }

    private function getErrorMessage(Throwable $exception, Response $response): array
    {
        $error = [
            'errors' => [
                'title' => \str_replace('\\', '.', \get_class($exception)),
                'detail' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'status' => $response->getStatusCode(),
            ],
        ];

        if ('dev' === $this->environment) {
            $error = \array_merge(
                $error,
                [
                    'meta' => [
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'message' => $exception->getMessage(),
                        'trace' => $exception->getTrace(),
                        'traceString' => $exception->getTraceAsString(),
                    ],
                ]
            );
        }

        $this->logger->error(json_encode($error, JSON_THROW_ON_ERROR), ['service' => 'auth']);

        return $error;
    }

    private function determineStatusCode(Throwable $exception): int
    {
        $exceptionClass = \get_class($exception);

        foreach ($this->exceptionToStatus as $class => $status) {
            if (\is_a($exceptionClass, $class, true)) {
                return $status;
            }
        }

        if ($exception instanceof HttpExceptionInterface) {
            return $exception->getStatusCode();
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}