<?php

declare(strict_types=1);

namespace App\Controller\Core\Session;

interface SessionInterface
{
    /**
     * Initialize session data
     *
     * @return void
     */
    public function start(): void;

    /**
     * Register the value gor the key for current session
     *
     * @param $key
     * @param $value
     *
     * @return void
     */
    public function set($key, $value): void;

    /**
     * Get the value for the key. If the key is not found, null is returned.
     *
     * @param string $key
     *
     * @return string|null
     */
    public function get(string $key): ?string;

    /**
     * Destroys all data registered to a session
     *
     * @return void
     */
    public function destroy(): void;
}