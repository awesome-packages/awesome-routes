<?php

namespace AwesomeRoutes\Core;

interface Controller
{
    /**
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
     */
    public function index(Request $request, Response $response): Response;

    /**
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
     */
    public function show(Request $request, Response $response): Response;

    /**
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
     */
    public function create(Request $request, Response $response): Response;

    /**
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
     */
    public function update(Request $request, Response $response): Response;

    /**
     * @param \AwesomeRoutes\Core\Request $request
     * @param \AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomeRoutes\Core\Response
     */
    public function destroy(Request $request, Response $response): Response;
}
