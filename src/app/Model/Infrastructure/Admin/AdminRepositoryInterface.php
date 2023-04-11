<?php

declare(strict_types=1);

namespace App\Model\Infrastructure\Admin;

use App\Entity\Admin;

interface AdminRepositoryInterface
{
    /**
     * Get an administrator by the name
     *
     * @param string $name
     *
     * @return ?Admin Admin on success or NULL on failure.
     */
    public function getByName(string $name): ?Admin;
}