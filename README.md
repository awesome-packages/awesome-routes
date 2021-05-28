![simple-routes](https://socialify.git.ci/awesome-packages/awesome-routes/image?description=1&font=Raleway&owner=1&theme=Dark)

[![Total Downloads](https://img.shields.io/packagist/dt/awesome-packages/simple-routes?style=flat-square)](https://packagist.org/packages/awesome-packages/simple-routes)
![Size](https://img.shields.io/github/languages/code-size/awesome-packages/simple-routes?style=flat-square)
[![codecov.io](https://img.shields.io/codecov/c/github/awesome-packages/simple-routes?style=flat-square)](https://codecov.io/github/awesome-packages/simple-routes?branch=master)
[![travis-ci](https://img.shields.io/travis/awesome-packages/simple-routes?style=flat-square)](https://travis-ci.com/github/awesome-packages/simple-routes)
[![Issues](https://img.shields.io/github/issues/awesome-packages/simple-routes?style=flat-square)](https://github.com/awesome-packages/simple-routes/issues)
[![Pull Request's](https://img.shields.io/github/issues-pr/awesome-packages/simple-routes?style=flat-square)](https://github.com/awesome-packages/simple-routes/pulls)
<a href="https://gitmoji.dev">
  <img src="https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg?style=flat-square" alt="Gitmoji">
</a>

## How to install

To install the package use the command below

`composer require awesome-packages/simple-routes`

## How to use

The library uses the RESTFUL API concept , example:

```php
<?php

$router = new \SimpleRoutes\Router();

$router->get('/user', \Mocks\UserController::class, 'index');
$router->get('/user/:id', \Mocks\UserController::class, 'index');
$router->post('/user', \Mocks\UserController::class, 'create');
$router->put('/user/:id', \Mocks\UserController::class, 'update');
$router->delete('/user/:id', \Mocks\UserController::class, 'delete');

echo $router->handleRequest();
```

If you send a request of type GET to route /user, the index method of the UserController class will be called.

If you send a request of type GET to route /user/1, the id will be passed as a parameter to the index method.

In the case of the POST request for route /user, all attributes that you pass in the body of the request will be sent as a parameter to the create method.

As well as for other methods. an example of a controller:

```php
<?php

class UserController
{
    public function index(?int $id): void { }

    public function create(array $requestBody): void { }

    public function update(int $id, array $requestBody): void { }

    public function delete(int $id): void { }
}
```

There is also the resource method that creates the routes according to the table below.

```php
<?php

$router = new \SimpleRoutes\Router();

$router->resource('/user', \Mocks\UserController::class);

echo $router->handleRequest();
```


| Request Method | Route      | Controller Method |
|----------------|------------|-------------------|
| GET            | /user      | index             |
| POST           | /user      | create            |
| PUT            | /user/{id} | update            |
| DELETE         | /user/{id} | delete            |

## License

[MIT](LICENSE) &copy; SimpleRoutes
