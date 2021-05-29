<?php

namespace AwesomeRoutesTests;

use AwesomeRoutes\Enum\StatusCode;
use AwesomeRoutes\Router;
use Mocks\UserController;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase
{
    public function testRouter_GivenGetRequestMethodForUserRout_ShouldReturnUsers(): void
    {
        $router = new Router();
        $router->get('/user', new UserController(), 'index');

        $response = $router->dispatch($requestMethod = 'GET', $requestURI = '/user', null);

        $expectedResponse = [
            ['name' => 'Rhuan Gabriel', 'age' => 23],
            ['name' => 'Eloah Hadassa', 'age' => 13]
        ];

        Assert::assertEquals($expectedResponse, $response->body);
        Assert::assertEquals(StatusCode::SUCCESS, $response->statusCode);
    }

    public function testRouter_GivenGetRequestMethodForUserRout_WithUserId_ShouldReturnSpecificUser(): void
    {
        $router = new Router();
        $router->get('/user/:id', new UserController(), 'show');

        $response = $router->dispatch($requestMethod = 'GET', $requestURI = '/user/1', null);
        $expectedResponse = ['id' => 1, 'name' => 'Rhuan Gabriel'];

        Assert::assertEquals($expectedResponse, $response->body);
        Assert::assertEquals(StatusCode::SUCCESS, $response->statusCode);
    }

    public function testRouter_GivenGetRequestMethodForUserRout_WithSpecificRout_ShouldReturnUserName(): void
    {
        $router = new Router();
        $router->get('/user/:id/name', new UserController(), 'findNameById');

        $response = $router->dispatch($requestMethod = 'GET', $requestURI = '/user/1/name', null);
        $expectedResponse = ['name' => 'Rhuan Gabriel'];

        Assert::assertEquals($expectedResponse, $response->body);
        Assert::assertEquals(StatusCode::SUCCESS, $response->statusCode);
    }

    public function testRouter_GivenPostRequestMethodForUserRout_WithUserRoutDefined_ShouldReturnUser(): void
    {
        $router = new Router();
        $router->post('/user', new UserController(), 'create');

        $user = ['name' => 'Rhuan Gabriel'];
        $response = $router->dispatch($requestMethod = 'POST', $requestURI = '/user', $user);

        Assert::assertEquals($user, $response->body);
        Assert::assertEquals(StatusCode::CREATED, $response->statusCode);
    }

    public function testRouter_GivenPutRequestMethodForUserRout_WithUserRoutDefined_ShouldReturnUser(): void
    {
        $router = new Router();
        $router->put('/user/:id', new UserController(), 'update');

        $user = ['name' => 'Rhuan Gabriel'];
        $response = $router->dispatch($requestMethod = 'PUT', $requestURI = '/user/1', $user);

        Assert::assertEquals($user, $response->body);
        Assert::assertEquals(StatusCode::SUCCESS, $response->statusCode);
    }

    public function testRouter_GivenDeleteRequestMethodForUserRout_WithUserRoutDefined_ShouldReturnUserId(): void
    {
        $router = new Router();
        $router->delete('/user/:id', new UserController(), 'destroy');

        $response = $router->dispatch($requestMethod = 'DELETE', $requestURI = '/user/1', null);
        $expectedResponse = ['id' => 1];

        Assert::assertEquals($expectedResponse, $response->body);
        Assert::assertEquals(StatusCode::SUCCESS, $response->statusCode);
    }

    public function testRouter_GivenAllRequestMethodForUserRout_WithUserRoutDefinedUsingResourceMethod_ShouldReturnSuccessfulMessage(): void
    {
        $router = new Router();
        $router->resource('/user', new UserController());

        $user = ['name' => 'Rhuan Gabriel'];

        $responseFromTheGetRequestMethod = $router->dispatch($requestMethod = 'GET', $requestURI = '/user', null);
        $responseFromThePostRequestMethod = $router->dispatch($requestMethod = 'POST', $requestURI = '/user', $user);
        $responseFromThePutRequestMethod = $router->dispatch($requestMethod = 'PUT', $requestURI = '/user/1', $user);
        $responseFromTheDeleteRequestMethod = $router->dispatch($requestMethod = 'DELETE', $requestURI = '/user/1', null);

        $expectedResponseFromTheGetRequestMethod = [
            ['name' => 'Rhuan Gabriel', 'age' => 23],
            ['name' => 'Eloah Hadassa', 'age' => 13]
        ];

        $expectedResponseFromThePostRequestMethod = ['name' => 'Rhuan Gabriel'];
        $expectedResponseFromThePutRequestMethod = ['name' => 'Rhuan Gabriel'];
        $expectedResponseFromTheDeleteRequestMethod = ['id' => 1];

        Assert::assertEquals($expectedResponseFromTheGetRequestMethod, $responseFromTheGetRequestMethod->body);
        Assert::assertEquals($expectedResponseFromThePostRequestMethod, $responseFromThePostRequestMethod->body);
        Assert::assertEquals($expectedResponseFromThePutRequestMethod, $responseFromThePutRequestMethod->body);
        Assert::assertEquals($expectedResponseFromTheDeleteRequestMethod, $responseFromTheDeleteRequestMethod->body);
    }

    public function testRouter_GivenGetRequestMethodForUserRout_UsingHandleRequestMethod_ShouldReturnSuccessfulMessage(): void
    {
        $router = new Router();
        $router->get('/user', new UserController(), 'index');

        $_SERVER["REQUEST_METHOD"] = 'GET';
        $_SERVER['REQUEST_URI'] = '/user';

        $router->handleRequest();

        $expectedResponse = json_encode([
            ['name' => 'Rhuan Gabriel', 'age' => 23],
            ['name' => 'Eloah Hadassa', 'age' => 13]
        ]);

        $this->expectOutputString($expectedResponse);
    }

    public function testRouter_GivenGetRequestMethodForProductRout_UsingHandleRequestMethodAndProductRoutNotDefined_ShouldThrowException(): void
    {
        $router = new Router();
        $router->get('/user', new UserController(), 'index');

        $_SERVER["REQUEST_METHOD"] = 'GET';
        $_SERVER['REQUEST_URI'] = '/product';

        $router->handleRequest();

        $expectedResponse = json_encode('Route not found.');

        $this->expectOutputString($expectedResponse);
    }

    public function testRouter_GivenGetRequestMethodForUserRout_WithUserRoutNotDefined_ShouldThrowException(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Route not found.');
        $this->expectExceptionCode(StatusCode::NOT_FOUND);

        $router = new Router();
        $router->dispatch($requestMethod = 'GET', $requestURI = '/user', null);
    }

    public function testRouter_GivenGetRequestMethodForProductRout_WithProductRoutNotDefined_ShouldThrowException(): void
    {
        $router = new Router();
        $router->get('/user', new UserController(), 'index');

        $this->expectException('Exception');
        $this->expectExceptionMessage('Route not found.');
        $this->expectExceptionCode(StatusCode::NOT_FOUND);

        $router = new Router();
        $router->dispatch($requestMethod = 'GET', $requestURI = '/user', null);
    }

    public function testRouter_GivenPatchRequestMethodForUserRout_WithUserRoutNotDefined_ShouldThrowException(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Route not found.');
        $this->expectExceptionCode(StatusCode::NOT_FOUND);

        $router = new Router();
        $router->dispatch($requestMethod = 'PATCH', $requestURI = '/user', null);
    }
}
