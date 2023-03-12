<?php

declare(strict_types=1);

namespace App\Model\Infrastructure;

use App\Model\Infrastructure\Admin\AdminRepositoryInterface;
use App\Model\Infrastructure\Task\TaskRepositoryInterface;
use PDO;

/**
 * An object that encapsulates access to the database (using repository objects) and allows you to save changes
 * to the database (commit a transaction)
 */
class UnitOfWork
{
    private PDO $connection;
    private TaskRepositoryInterface $taskRepository;
    private AdminRepositoryInterface $adminRepository;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param TaskRepositoryInterface $taskRepository
     */
    public function setTaskRepository(TaskRepositoryInterface $taskRepository
    ): void {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param AdminRepositoryInterface $adminRepository
     */
    public function setAdminRepository(AdminRepositoryInterface $adminRepository
    ): void {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Save changes to the database
     *
     * @return bool
     */
    public function saveChanges(): bool
    {
        return $this->connection->commit();
    }

    /**
     * @return TaskRepositoryInterface
     */
    public function getTaskRepository(): TaskRepositoryInterface
    {
        return $this->taskRepository;
    }

    /**
     * @return AdminRepositoryInterface
     */
    public function getAdminRepository(): AdminRepositoryInterface
    {
        return $this->adminRepository;
    }
}