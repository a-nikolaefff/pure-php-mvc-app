<?php

declare(strict_types=1);

namespace App\Controller\Core\Response;

/**
 * An object that represents the current response
 */
class Response implements ResponseInterface
{
    protected array $headers = [];
    protected int $status = 200;
    protected mixed $body;

    public function withRedirect(string $url): static
    {
        $this->status = 302;
        $this->headers['Location'] = $url;
        return $this;
    }

    public function withBody($body = null): static
    {
        if (is_string($body)) {
            $this->headers['Content-Length'] = mb_strlen($body);
        }
        $this->body = $body;
        return $this;
    }

    public function withStatus(int $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function withFormat(string $format): static
    {
        switch (strtolower($format)) {
            case 'json':
                $this->headers['Content-Type'] = 'application/json';
                $this->body = json_encode($this->body);
                $this->headers['Content-Length'] = mb_strlen($this->body);
        }
        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->status;
    }

    public function getBody(): mixed
    {
        return $this->body;
    }

    public function getHeaderLines(): array
    {
        return array_map(function ($key, $value) {
            return "$key: $value";
        }, array_keys($this->headers), $this->headers);
    }
}