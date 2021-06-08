<?php

namespace AwesomePackages\AwesomeRoutes\Core;

use AwesomePackages\AwesomeRoutes\Enum\StatusCode;

class Response
{
    public int $statusCode = StatusCode::SUCCESS;
    public array $body = [];

    public function setBody(array $body)
    {
        $this->body = $body;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }
}
