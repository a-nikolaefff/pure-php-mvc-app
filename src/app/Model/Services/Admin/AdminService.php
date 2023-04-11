<?php

declare(strict_types=1);

namespace App\Model\Services\Admin;

use App\Model\Infrastructure\UnitOfWork;

/**
 * An object that encapsulates actions with administrators
 */
class AdminService implements AdminServiceInterface
{
    private UnitOfWork $dbContext;

    /**
     * @param UnitOfWork $dbContext
     */
    public function __construct(UnitOfWork $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    public function isAdminVerified(string $name, string $password): bool
    {
        $admin = $this->dbContext->getAdminRepository()->getByName($name);
        if ($admin === null) {
            return false;
        } else {
            return password_verify($password, $admin->getPasswordHash());
        }
    }
}