<?php

declare(strict_types=1);

namespace App\Model\Services\Admin;

interface AdminServiceInterface
{
    /**
     * Check if this username and password are verified
     *
     * @param string $name
     * @param string $password
     *
     * @return bool
     */
    public function isAdminVerified(string $name, string $password): bool;
}