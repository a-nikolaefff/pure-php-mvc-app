<?php

declare(strict_types=1);

namespace App\Controller\Core\Request;

/**
 * An object that represents the current request
 */
class Request implements RequestInterface
{
    protected string $method;
    protected string $uri;
    protected array $headers;
    protected array $queryParams;
    protected array $attributes;
    protected array $body;

    /**
     * @param string $method
     * @param string $uri
     * @param array  $headers
     * @param array  $queryParams
     * @param array  $attributes
     * @param array  $body
     */
    public function __construct(
        string $method,
        string $uri,
        array $headers,
        array $queryParams,
        array $attributes,
        array $body
    ) {
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->queryParams = $queryParams;
        $this->attributes = $attributes;
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getAttribute(string $name): string
    {
        return $this->attributes[$name];
    }

    public function getBody(): array
    {
        if ($this->method === 'GET') {
            return [];
        }
        return $this->body;
    }
}