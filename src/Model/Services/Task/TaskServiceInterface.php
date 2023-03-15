<?php

declare(strict_types=1);

namespace App\Model\Services\Task;

use App\Dto\SortingCriterion;
use App\Dto\SortingOrder;
use App\Entity\Task;
use Exception;

interface TaskServiceInterface
{
    /**
     * Get all tasks
     *
     * @return array<Task>
     * @throws Exception
     */
    public function getAll(
        SortingCriterion $sortingCriterion,
        SortingOrder $sortingOrder
    ): array;

    /**
     * Get a task by ID
     *
     * @param int $id The ID of the task
     *
     * @return ?Task Task with given ID
     * @throws Exception
     */
    public function get(int $id): ?Task;

    /**
     * Insert a task into the database
     *
     * @param Task $taskDto
     *
     * @return bool TRUE on success or FALSE on failure.
     */
    public function insert(Task $task): bool;

    /**
     * Update the task in the database
     *
     * @param Task $task
     *
     * @return bool TRUE on success or FALSE on failure.
     * @throws Exception
     */
    public function update(Task $task): bool;

    /**
     * Delete the task from the database
     *
     * @param int $id
     *
     * @return bool TRUE on success or FALSE on failure.
     */
    public function delete(int $id): bool;
}