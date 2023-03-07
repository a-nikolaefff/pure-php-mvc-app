<?php

declare(strict_types=1);

namespace App\Model\Services\Task;

use App\Entity\Task;
use App\Model\Infrastructure\UnitOfWork;

/**
 * An object that encapsulates actions with tasks
 */
class TaskService implements TaskServiceInterface
{
    private UnitOfWork $dbContext;

    /**
     * @param UnitOfWork $dbContext
     */
    public function __construct(UnitOfWork $dbContext)
    {
        $this->dbContext = $dbContext;
    }

    /**
     * @return array<Task>
     */
    public function getAll(): array
    {
        return $this->dbContext->getTaskRepository()->getAll();
    }

    public function get(int $id): ?Task
    {
        return $this->dbContext->getTaskRepository()->get($id);
    }

    public function insert(Task $task): bool
    {
        $isInsertionSuccessful = $this->dbContext->getTaskRepository()->insert(
            $task
        );
        if ($isInsertionSuccessful) {
            $this->dbContext->saveChanges();
        }
        return $isInsertionSuccessful;
    }

    public function update(Task $task): bool
    {
        if ($this->dbContext->getTaskRepository()->get($task->getId())
            === null
        ) {
            return false;
        }
        $isUpdateSuccessful = $this->dbContext->getTaskRepository()->update(
            $task
        );
        if ($isUpdateSuccessful) {
            $this->dbContext->saveChanges();
        }
        return $isUpdateSuccessful;
    }

    public function delete(int $id): bool
    {
        $isDeletionSuccessful = $this->dbContext->getTaskRepository()->delete(
            $id
        );
        if ($isDeletionSuccessful) {
            $this->dbContext->saveChanges();
        }
        return $isDeletionSuccessful;
    }
}