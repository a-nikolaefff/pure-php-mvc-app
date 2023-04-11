<?php

declare(strict_types=1);

namespace App\Controller\Core\Session;

/**
 * An object that represents the current session
 */
class Session implements SessionInterface
{
    public function start(): void
    {
        session_start();
    }

    public function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key): ?string
    {
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : null;
    }

    public function destroy(): void
    {
        session_destroy();
    }
}