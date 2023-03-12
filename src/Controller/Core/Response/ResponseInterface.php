<?php

declare(strict_types=1);

namespace App\Controller\Core\Response;

interface ResponseInterface
{
    /**
     * Add the redirect to the specified url
     *
     * @param string $url The URL of an attribute to redirect
     *
     * @return static The same response object
     */
    public function withRedirect(string $url): static;

    /**
     * Add the body to the response
     *
     * @param $body "Response body, such as HTML or JSON"
     *
     * @return static The same response object
     */
    public function withBody($body = null): static;

    /**
     * Add the status to the response
     *
     * @param int $status "HTTP status code"
     *
     * @return static The same response object
     */
    public function withStatus(int $status): static;

    /**
     * Converts the response body according to the specified format.
     *
     * @param string $format "The name of the format, for example "JSON"
     *
     * @return static The same response object
     */
    public function withFormat(string $format): static;

    /**
     * Get the status of the response
     *
     * @return int The status of the response
     */
    public function getStatusCode(): int;

    /**
     * Get the body of the response
     *
     * @return mixed The body of the response
     */
    public function getBody(): mixed;

    /**
     * Get all headers of the response as array of strings "key: value"
     *
     * @return array<string>
     */
    public function getHeaderLines(): array;
}