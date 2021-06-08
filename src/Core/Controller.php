<?php

namespace AwesomePackages\AwesomeRoutes\Core;

interface Controller
{
    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function index(Request $request, Response $response): Response;

    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function show(Request $request, Response $response): Response;

    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function create(Request $request, Response $response): Response;

    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function update(Request $request, Response $response): Response;

    /**
     * @param \AwesomePackages\AwesomeRoutes\Core\Request $request
     * @param \AwesomePackages\AwesomeRoutes\Core\Response $response
     *
     * @return \AwesomePackages\AwesomeRoutes\Core\Response
     */
    public function destroy(Request $request, Response $response): Response;
}
