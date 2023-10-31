<?php

declare(strict_types=1);

namespace Core;

use Core\Controller\ControllerInterface;
use Core\Http\RequestFactory;
use Exception;

class RouterSingleton
{
    private static self|null $instance = null;

    private array $routes = [];

    protected function __construct(private readonly RequestFactory $requestFactory){}

    /**
     * Add route to the list
     * // todo implement class RouteItem because of DDD
     *
     * @param string $uri
     * @param string $controllerClassName
     * @return void
     */
    public function addRoute(string $uri, string $controllerClassName): void
    {
        $this->routes[$uri] = $controllerClassName;
    }

    /**
     * Perform needed controller based on routes
     *
     * @return void
     * @throws Exception
     */
    public function execute(): void
    {
        $url = (string)strtok($_SERVER["REQUEST_URI"], '?');
        if (array_key_exists($url, $this->routes)) {
            $controller = new $this->routes[$url]();
            if ($controller instanceof ControllerInterface) {
                $controller->execute($this->requestFactory->create());
            } else {
                throw new Exception('Controller must be instance of ControllerInterface');
            }
        } else {
            //todo throw 404
        }
    }

    final protected function __clone(){}

    final public function __wakeup()
    {
        throw new Exception('not implemented method');
    }

    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new self(new RequestFactory());
        }

        return static::$instance;
    }
}