<?php

namespace AwesomePackages\AwesomeRoutes\RequestMethodsHandler;

use AwesomePackages\AwesomeRoutes\Core\Request;
use AwesomePackages\AwesomeRoutes\Core\Response;
use AwesomePackages\AwesomeRoutes\Enum\StatusCode;
use Exception;
use ReflectionException;
use ReflectionMethod;

abstract class RequestHandler
{
    protected string $requestMethod = 'GET';

    protected ?RequestHandler $nextRequestMethodHandler;

    /**
     * @param string $requestMethod
     * @param Request $requestParams
     * @param array $controllerReference
     *
     * @return Response
     * @throws ReflectionException
     * @throws Exception
     */
    public function handler(string $requestMethod, array $controllerReference, Request $requestParams): Response
    {
        if ($this->canHandleRequestMethod($requestMethod)) {
            $reflectedController = new ReflectionMethod(
                $controllerReference['namespace'],
                $controllerReference['method']
            );

            return $reflectedController->invokeArgs(new $controllerReference['namespace'], [$requestParams, new Response()]);
        }

        if ($this->hasNextRequestMethod()) {
            return $this->nextRequestMethodHandler->handler(
                $requestMethod,
                $controllerReference,
                $requestParams
            );
        }

        throw new Exception($message = 'Method not supported', StatusCode::NOT_FOUND);
    }

    /**
     * @param string $requestMethod
     * @return bool
     */
    protected function canHandleRequestMethod(string $requestMethod): bool
    {
        return $requestMethod === $this->requestMethod;
    }

    /**
     * @return bool
     */
    private function hasNextRequestMethod(): bool
    {
        return !empty($this->nextRequestMethodHandler);
    }

    /**
     * @param RequestHandler|null $nextRequestMethodHandler
     * @return RequestHandler
     */
    public function setNextRequestMethodHandler(?RequestHandler $nextRequestMethodHandler): RequestHandler
    {
        $this->nextRequestMethodHandler = $nextRequestMethodHandler;
        return $this;
    }
}