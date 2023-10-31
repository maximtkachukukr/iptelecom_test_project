<?php

declare(strict_types=1);

namespace Core\Http;

class RequestFactory
{
    /**
     * Create new request
     *
     * @return Request
     */
    public function create(): Request
    {
        return new Request();
    }
}