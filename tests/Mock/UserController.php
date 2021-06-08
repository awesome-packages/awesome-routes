<?php

namespace Mocks;

use AwesomePackages\AwesomeRoutes\Core\Controller;
use AwesomePackages\AwesomeRoutes\Core\Request;
use AwesomePackages\AwesomeRoutes\Core\Response;
use AwesomePackages\AwesomeRoutes\Enum\StatusCode;

final class UserController implements Controller
{
    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function index(Request $request, Response $response): Response
    {
        $response->setBody([
            ['name' => 'Rhuan Gabriel', 'age' => 23],
            ['name' => 'Eloah Hadassa', 'age' => 13]
        ]);

        $response->setStatusCode(StatusCode::SUCCESS);

        return $response;
    }

    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function show(Request $request, Response $response): Response
    {
        $response->setBody([
            'id' => $request->id,
            'name' => 'Rhuan Gabriel'
        ]);

        $response->setStatusCode(StatusCode::SUCCESS);

        return $response;
    }

    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function create(Request $request, Response $response): Response
    {
        $response->setBody($request->body);
        $response->setStatusCode(StatusCode::CREATED);

        return $response;
    }

    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function update(Request $request, Response $response): Response
    {
        $response->setBody($request->body);
        $response->setStatusCode(StatusCode::SUCCESS);

        return $response;
    }

    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function destroy(Request $request, Response $response): Response
    {
        $response->setBody([
            'id' => $request->id
        ]);

        $response->setStatusCode(StatusCode::SUCCESS);

        return $response;
    }

    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function findNameById(Request $request, Response $response): Response
    {
        $response->setBody(['name' => 'Rhuan Gabriel']);

        $response->setStatusCode(StatusCode::SUCCESS);

        return $response;
    }
}
