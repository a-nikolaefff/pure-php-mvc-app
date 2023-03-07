<?php

declare(strict_types=1);

namespace App\Controller\Core;

use App\Controller\Core\Request\Request;
use App\Controller\Core\Response\Response;
use App\Controller\Core\Session\Session;

/**
 * An object that represents the request handler application
 */
final class Application
{
    /**
     * An array of request handlers, each in the format [route, handlerMethod, handler]
     *
     * @var array
     */
    private array $handlers = [];

    /**
     * Set a handler function for GET requests with a specific route
     *
     * @param string   $route   The route that the handler function handles
     * @param callable $handler The function to be executed when the request is processed. This function receives
     *                          three arguments from the application: request, response, session.
     *
     * @return void
     */
    public function get(string $route, callable $handler): void
    {
        $this->append('GET', $route, $handler);
    }

    /**
     * Set a handler function for POST requests with a specific route
     *
     * @param string   $route   The route that the handler function handles
     * @param callable $handler The function to be executed when the request is processed. This function receives
     *                          three arguments from the application: request, response, session.
     *
     * @return void
     */
    public function post(string $route, callable $handler): void
    {
        $this->append('POST', $route, $handler);
    }

    /**
     * Set a handler function for PUT requests with a specific route
     *
     * @param $route   "The route that the handler function handles"
     * @param $handler "The function to be executed when the request is processed. This function receives
     *                 three arguments from the application: request, response, session."
     *
     * @return void
     */
    public function put(string $route, callable $handler): void
    {
        $this->append('PUT', $route, $handler);
    }

    /**
     * Set a handler function for DELETE requests with a specific route
     *
     * @param $route   "The route that the handler function handles"
     * @param $handler "The function to be executed when the request is processed. This function receives
     *                 three arguments from the application: request, response, session."
     *
     * @return void
     */
    public function delete(string $route, callable $handler): void
    {
        $this->append('DELETE', $route, $handler);
    }

    /**
     * The internal method that directly adds a handler to the handlers array
     *
     * @param string   $method  "The name of the method"
     * @param string   $route   "The route that the handler function handles"
     * @param callable $handler "The function to be executed when the request is processed. This function receives
     *                          three arguments from the application: request, response, session."
     *
     * @return void
     */
    private function append(
        string $method,
        string $route,
        callable $handler
    ): void {
        $updatedRoute = $route;
        $matches = [];
        if (preg_match_all('/{([^\/]+)}/', $route, $matches)) {
            $updatedRoute = array_reduce($matches[1], function ($acc, $value) {
                $group = "(?P<$value>[\w-]+)";
                return str_replace("{{$value}}", $group, $acc);
            }, $route);
        }
        $this->handlers[] = [$updatedRoute, $method, $handler];
    }

    /**
     * Start processing requests
     *
     * @return void
     */
    public function run(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if ($_SERVER['REQUEST_METHOD'] === 'POST'
            && array_key_exists(
                '_method',
                $_POST
            )
        ) {
            $method = strtoupper($_POST['_method']);
        } else {
            $method = $_SERVER['REQUEST_METHOD'];
        }
        foreach ($this->handlers as $item) {
            [$route, $handlerMethod, $handler] = $item;
            $preparedRoute = str_replace('/', '\/', $route);
            $matches = [];
            if ($method === $handlerMethod
                && preg_match(
                    "/^$preparedRoute$/i",
                    $uri,
                    $matches
                )
            ) {
                $attributes = array_filter($matches, function ($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);

                $request = new Request(
                    $method,
                    $uri,
                    getallheaders(),
                    $_GET,
                    $attributes,
                    $_POST
                );
                $response = new Response();
                $session = new Session();

                $response = $handler($request, $response, $session);
                http_response_code($response->getStatusCode());
                foreach ($response->getHeaderLines() as $header) {
                    header($header);
                }
                echo $response->getBody();
                return;
            }
        }
    }
}