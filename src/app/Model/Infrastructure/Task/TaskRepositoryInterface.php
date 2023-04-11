<?php

declare(strict_types=1);

namespace App\Model\Infrastructure\Task;

use App\Dto\SortingCriterion;
use App\Dto\SortingOrder;
use App\Entity\Task;

use Exception;

interface TaskRepositoryInterface
{

    /**
     * Get total count of tasks
     *
     * @return int
     */
    public function getTotalCount(): int;

    /**
     * Get all tasks
     *
     * @param SortingCriterion $sortingCriterion
     * @param SortingOrder     $sortingOrder
     *
     * @return array<Task>
     * @throws Exception
     */
    public function getAll(
        SortingCriterion $sortingCriterion,
        SortingOrder $sortingOrder,
        int $page,
        int $limit
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
     * @param Task $task
     *
     * @return bool TRUE on success or FALSE on failure.
     */
    public function insert(Task $task): bool;

    /**
     * Update a task in the database
     *
     * @param Task $task
     *
     * @return bool TRUE on success or FALSE on failure.
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