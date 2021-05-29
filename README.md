![awesome-routes](https://socialify.git.ci/awesome-packages/awesome-routes/image?description=1&forks=1&issues=1&language=1&logo=https%3A%2F%2Favatars.githubusercontent.com%2Fu%2F84918258%3Fv%3D4&owner=1&pulls=1&stargazers=1&theme=Dark)

[![Total Downloads](https://img.shields.io/packagist/dt/awesome-packages/awesome-routes?style=flat-square)](https://packagist.org/packages/awesome-packages/awesome-routes)
![Size](https://img.shields.io/github/languages/code-size/awesome-packages/awesome-routes?style=flat-square)
[![codecov.io](https://img.shields.io/codecov/c/github/awesome-packages/awesome-routes?style=flat-square)](https://codecov.io/github/awesome-packages/awesome-routes?branch=master)
[![CodeFactor](https://www.codefactor.io/repository/github/awesome-packages/awesome-routes/badge)](https://www.codefactor.io/repository/github/awesome-packages/awesome-routes)
[![travis-ci](https://img.shields.io/travis/awesome-packages/awesome-routes?style=flat-square)](https://travis-ci.com/github/awesome-packages/awesome-routes)
[![Issues](https://img.shields.io/github/issues/awesome-packages/awesome-routes?style=flat-square)](https://github.com/awesome-packages/awesome-routes/issues)
[![Pull Request's](https://img.shields.io/github/issues-pr/awesome-packages/awesome-routes?style=flat-square)](https://github.com/awesome-packages/awesome-routes/pulls)
<a href="https://gitmoji.dev">
  <img src="https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg?style=flat-square" alt="Gitmoji">
</a>
  
## How to install

To install the package use the command below

`composer require awesome-packages/awesome-routes`

## How to use

The library uses the RESTFUL API concept , example:

```php
<?php

$router = new \AwesomeRoutes\Router();

$router->get('/user', new \Mocks\UserController(), 'index');
$router->get('/user/:id', new \Mocks\UserController(), 'show');
$router->post('/user', new \Mocks\UserController(), 'create');
$router->put('/user/:id', new \Mocks\UserController(), 'update');
$router->delete('/user/:id', new \Mocks\UserController(), 'delete');

$router->handleRequest();
```

If you send a request of type GET to route /user, the index method of the UserController class will be called.

If you send a request of type GET to route /user/1, the id will be passed as a parameter to the show method.

In the case of the POST request for route /user, all attributes that you pass in the body of the request will be sent as
a parameter to the create method.

As well as for other methods. An example of a controller:

```php
<?php

use AwesomeRoutes\Core\Controller;
use AwesomeRoutes\Core\Request;
use AwesomeRoutes\Core\Response;
use AwesomeRoutes\Enum\StatusCode;

class UserController implements Controller
{
      public function index(Request $request,Response $response) : Response
      {
          $response->setBody([
              ['name' => 'Rhuan Gabriel', 'age' => 23],
              ['name' => 'Eloah Hadassa', 'age' => 13]
          ]);

          $response->setStatusCode(StatusCode::SUCCESS);

          return $response;
      }
      
      public function show(Request $request,Response $response) : Response
      {
          $id = $request->id;
      
          $response->setBody([
              'name' => 'Rhuan Gabriel',
              'age' => 23
          ]);
  
          $response->setStatusCode(StatusCode::SUCCESS);
  
          return $response;
      }
      
      public function create(Request $request,Response $response) : Response
      {
          $id = $request->id;
          $body = $request->body;
          
          $response->setBody([
              'message' => 'User was created'
          ]);
          
          $response->setStatusCode(StatusCode::CREATED);
  
          return $response;
      }
      
      public function update(Request $request,Response $response) : Response
      {
          $id = $request->id;
          $body = $request->body;
      
          $response->setBody([
              'message' => 'User has been updated'
          ]);
          
          $response->setStatusCode(StatusCode::SUCCESS);
  
          return $response;
      }
      
      public function destroy(Request $request,Response $response) : Response
      {
          $id = $request->id;
          
          $response->setBody([
              'message' => 'User has been deleted'
          ]);
          
          $response->setStatusCode(StatusCode::SUCCESS);
  
          return $response;
      }
}
```

There is also the resource method that creates the routes according to the table below.

```php
<?php

$router = new \AwesomeRoutes\Router();

$router->resource('/user', new \Mocks\UserController());
$router->handleRequest();
```

| Request Method | Route      | Controller Method |
|----------------|------------|-------------------|
| GET            | /user      | index             |
| GET            | /user/{id} | show              |
| POST           | /user      | create            |
| PUT            | /user/{id} | update            |
| DELETE         | /user/{id} | delete            |

## License

[MIT](LICENSE) &copy; AwesomeRoutes
