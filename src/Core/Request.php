<?php

namespace AwesomeRoutes\Core;

class Request
{
    public ?array $body;
    public ?int $id;

    public function __construct(?array $body, ?int $id)
    {
        $this->body = $body;
        $this->id = $id;
    }
}
