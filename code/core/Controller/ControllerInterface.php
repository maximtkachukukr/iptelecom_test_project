<?php

declare(strict_types=1);

namespace Core\Controller;

use Core\Http\RequestInterface;

interface ControllerInterface
{
    /**
     * Execute controller
     *
     * @param RequestInterface $request
     * @return void
     */
    public function execute(RequestInterface $request): void;
}