<?php

namespace AwesomeRoutesTests\RequestMethodsHandler;

use AwesomeRoutes\Core\Request;
use AwesomeRoutes\Enum\StatusCode;
use AwesomeRoutes\RequestMethodsHandler\GetRequestMethodHandler;
use AwesomeRoutes\RequestMethodsHandler\PostRequestMethodHandler;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class PostRequestMethodHandlerTest extends TestCase
{
    public function testDeleteRequestMethod_GivenRequestMethodThatCanHandler_ShouldSuccessfulMessage(): void
    {
        $postRequestMethod = new PostRequestMethodHandler();

        $response = $postRequestMethod->handler(
            $requestMethod = 'POST',
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'create'],
            new Request($requestBody = ['name' => 'rhuangabriel'], null)
        );

        Assert::assertEquals($requestBody, $response->body);
    }

    public function testDeleteRequestMethod_GivenRequestMethodThatCanNotHandler_WithNextRequestMethodCanHandlerRequest_ShouldSuccessfulMessage(): void
    {
        $deleteRequestMethod = (new PostRequestMethodHandler())
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

        $postRequestMethod = new PostRequestMethodHandler();
        $postRequestMethod->handler(
            $requestMethod = 'GET',
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'index'],
            new Request([], 1)
        );
    }
}
