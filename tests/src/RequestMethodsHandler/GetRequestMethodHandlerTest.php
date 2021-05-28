<?php

namespace AwesomeRoutesTests\RequestMethodsHandler;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use AwesomeRoutes\Enum\StatusCode;
use AwesomeRoutes\RequestMethodsHandler\DeleteRequestMethodHandler;
use AwesomeRoutes\RequestMethodsHandler\GetRequestMethodHandler;

final class GetRequestMethodHandlerTest extends TestCase
{
    public function testDeleteRequestMethod_GivenRequestMethodThatCanHandler_ShouldSuccessfulMessage(): void
    {
        $getRequestMethod = new GetRequestMethodHandler();

        $response = $getRequestMethod->exec(
            $requestMethod = 'GET',
            $requestURI = ['id' => null],
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'index'],
            null
        );

        $expectedResponse = [
            ['name' => 'Rhuan Gabriel', 'age' => 23],
            ['name' => 'Eloah Hadassa', 'age' => 13]
        ];

        Assert::assertEquals($expectedResponse, $response);
    }

    public function testDeleteRequestMethod_GivenRequestMethodThatCanNotHandler_WithNextRequestMethodCanHandlerRequest_ShouldSuccessfulMessage(): void
    {
        $deleteRequestMethod = (new GetRequestMethodHandler())
            ->setNextRequestMethodHandler(new DeleteRequestMethodHandler());

        $response = $deleteRequestMethod->exec(
            $requestMethod = 'DELETE',
            $requestURI = ['id' => 1],
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'delete'],
            null
        );

        $expectedResponse = [
            'status' => StatusCode::SUCCESS,
            'message' => "User with id 1, has deleted."
        ];

        Assert::assertEquals($expectedResponse, $response);
    }

    public function testDeleteRequestMethod_GivenRequestMethodThatNotCanHandler_ShouldThrowException(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Method not supported');
        $this->expectExceptionCode(StatusCode::NOT_FOUND);

        $getRequestMethod = new GetRequestMethodHandler();
        $getRequestMethod->exec(
            $requestMethod = 'DELETE',
            $requestURI = ['id' => 1],
            $controllerReference = ['namespace' => '\Mocks\UserController', 'method' => 'delete'],
            null
        );
    }
}
