<?php

namespace AwesomeRoutesTests\RequestMethodsHandler;

use AwesomeRoutes\Core\Request;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use AwesomeRoutes\Enum\StatusCode;
use AwesomeRoutes\RequestMethodsHandler\GetRequestMethodHandler;
use AwesomeRoutes\RequestMethodsHandler\PutRequestMethodHandler;

final class PutRequestMethodHandlerTest extends TestCase
{
    public function testDeleteRequestMethod_GivenRequestMethodThatCanHandler_ShouldSuccessfulMessage(): void
    {
        $postRequestMethod = new PutRequestMethodHandler();

        $response = $postRequestMethod->handler(
            $requestMethod = 'PUT',
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'update'],
            new Request($requestBody = ['name' => 'rhuangabriel'], 1)
        );

        Assert::assertEquals($requestBody, $response->body);
    }

    public function testDeleteRequestMethod_GivenRequestMethodThatCanNotHandler_WithNextRequestMethodCanHandlerRequest_ShouldSuccessfulMessage(): void
    {
        $deleteRequestMethod = (new PutRequestMethodHandler())
            ->setNextRequestMethodHandler(new GetRequestMethodHandler());

        $response = $deleteRequestMethod->handler(
            $requestMethod = 'GET',
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'index'],
            new Request([], 1)
        );

        $expectedResponse = [
            ['name' => 'Rhuan Gabriel', 'age' => 23],
            ['name' => 'Eloah Hadassa', 'age' => 13]
        ];

        Assert::assertEquals($expectedResponse, $response->body);
    }

    public function testDeleteRequestMethod_GivenRequestMethodThatNotCanHandler_ShouldThrowException(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Method not supported');
        $this->expectExceptionCode(StatusCode::NOT_FOUND);

        $postRequestMethod = new PutRequestMethodHandler();
        $postRequestMethod->handler(
            $requestMethod = 'GET',
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'index'],
            new Request([], 1)
        );
    }
}
