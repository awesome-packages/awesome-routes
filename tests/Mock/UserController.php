<?php

namespace Mocks;

use AwesomeRoutes\Core\Controller;
use AwesomeRoutes\Core\Request;
use AwesomeRoutes\Core\Response;
use AwesomeRoutes\Enum\StatusCode;

final class UserController implements Controller
{
    /**
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
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
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
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
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
     */
    public function create(Request $request, Response $response): Response
    {
        $response->setBody($request->body);
        $response->setStatusCode(StatusCode::CREATED);

        return $response;
    }

    /**
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
     */
    public function update(Request $request, Response $response): Response
    {
        $response->setBody($request->body);
        $response->setStatusCode(StatusCode::SUCCESS);

        return $response;
    }

    /**
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
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
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
     */
    public function findNameById(Request $request, Response $response): Response
    {
        $response->setBody(['name' => 'Rhuan Gabriel']);

        $response->setStatusCode(StatusCode::SUCCESS);

        return $response;
    }
}
