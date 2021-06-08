<?php

namespace AwesomePackages\AwesomeRoutesTests\RequestMethodsHandler;

use AwesomePackages\AwesomeRoutes\Core\Request;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use AwesomePackages\AwesomeRoutes\Enum\StatusCode;
use AwesomePackages\AwesomeRoutes\RequestMethodsHandler\DeleteRequestMethodHandler;
use AwesomePackages\AwesomeRoutes\RequestMethodsHandler\GetRequestMethodHandler;

final class GetRequestMethodHandlerTest extends TestCase
{
    public function testDeleteRequestMethod_GivenRequestMethodThatCanHandler_ShouldSuccessfulMessage(): void
    {
        $getRequestMethod = new GetRequestMethodHandler();

        $response = $getRequestMethod->handler(
            $requestMethod = 'GET',
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'index'],
            new Request([], null)
        );

        $expectedResponse = [
            ['name' => 'Rhuan Gabriel', 'age' => 23],
            ['name' => 'Eloah Hadassa', 'age' => 13]
        ];

        Assert::assertEquals($expectedResponse, $response->body);
    }

    public function testDeleteRequestMethod_GivenRequestMethodThatCanNotHandler_WithNextRequestMethodCanHandlerRequest_ShouldSuccessfulMessage(): void
    {
        $deleteRequestMethod = (new GetRequestMethodHandler())
            ->setNextRequestMethodHandler(new DeleteRequestMethodHandler());

        $response = $deleteRequestMethod->handler(
            $requestMethod = 'DELETE',
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'destroy'],
            new Request([], 1)
        );

        $expectedResponse = ['id' => 1];

        Assert::assertEquals($expectedResponse, $response->body);
    }

    public function testDeleteRequestMethod_GivenRequestMethodThatNotCanHandler_ShouldThrowException(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Method not supported');
        $this->expectExceptionCode(StatusCode::NOT_FOUND);

        $getRequestMethod = new GetRequestMethodHandler();
        $getRequestMethod->handler(
            $requestMethod = 'DELETE',
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'destroy'],
            new Request([], 1)
        );
    }
}
