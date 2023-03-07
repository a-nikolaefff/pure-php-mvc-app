<?php

declare(strict_types=1);

namespace App\Controller\Core\Request;

interface RequestInterface
{
    /**
     * Get the method name of the current request
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * Get the URI of the current request
     *
     * @return string
     */
    public function getUri(): string;

    /**
     * Get all headers of the current request s a key-value array
     *
     * @return array<string, string>
     */
    public function getHeaders(): array;

    /**
     * Get all query parameters of the current request as a key-value array
     *
     * @return array<string, string>
     */
    public function getQueryParams(): array;

    /**
     * Get all attributes of the current request as a key-value array
     *
     * @return array<string, string>
     */
    public function getAttributes(): array;

    /**
     * Get an attribute of the current request by name
     *
     * @param string $name The name of an attribute to get
     *
     * @return string
     */
    public function getAttribute(string $name): string;

    /**
     * Get the body of the current request as a key-value array
     *
     * @return array<string, mixed>
     */
    public function getBody(): array;
}