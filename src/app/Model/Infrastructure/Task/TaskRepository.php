<?php

declare(strict_types=1);

namespace App\Model\Infrastructure\Task;

use App\Dto\SortingCriterion;
use App\Dto\SortingOrder;
use App\Entity\Task;

use DateTime;
use DateTimeZone;
use Exception;
use PDO;

/**
 *  An object that encapsulates access to data about tasks in the database
 */
class TaskRepository implements TaskRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }


    public function getTotalCount(): int
    {
        $query = $this->connection->prepare(
            "SELECT COUNT(*) FROM tasks"
        );
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['count'];
    }

    public function getAll(
        SortingCriterion $sortingCriterion,
        SortingOrder $sortingOrder,
        int $page,
        int $limit
    ): array {
        $offset = ($page - 1) * $limit;
        $sortBy = match ($sortingCriterion) {
            SortingCriterion::USER_NAME => 'user_name',
            SortingCriterion::USER_EMAIL => 'user_email',
            SortingCriterion::DESCRIPTION => 'description',
            SortingCriterion::IS_DONE => 'is_done',
            SortingCriterion::CREATED_AT => 'created_at',
        };
        $orderBy = match ($sortingOrder) {
            SortingOrder::ASC => 'ASC',
            SortingOrder::DESC => 'DESC',
        };
        $query = $this->connection->prepare(
            "SELECT * FROM tasks ORDER BY $sortBy $orderBy LIMIT $limit OFFSET $offset"
        );
        $query->execute();
        $tasks = [];
        while (false !== $data = $query->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $this->parseTask($data);
        }
        return $tasks;
    }

    public function get(int $id): ?Task
    {
        $query = $this->connection->prepare(
            "SELECT * FROM tasks WHERE id = :id"
        );
        $query->execute(['id' => $id]);
        $data = $query->fetch();
        if (empty($data)) {
            return null;
        } else {
            return $this->parseTask($data);
        }
    }

    public function insert(Task $task): bool
    {
        $this->connection->beginTransaction();
        $query = $this->connection->prepare(
            "INSERT INTO tasks (user_name, user_email, description, is_done, created_at) 
                    VALUES (:userName, :userEmail, :description, :isDone, :createdAt)"
        );
        return $query->execute([
            'userName' => $task->getUserName(),
            'userEmail' => $task->getUserEmail(),
            'description' => $task->getDescription(),
            'isDone' => $task->isDone() ? 'TRUE' : 'FALSE',
            'createdAt' => $task->getCreatedAt()->format('Y-m-d H:i:s.u')
        ]);
    }

    public function update(Task $task): bool
    {
        $this->connection->beginTransaction();
        $query = $this->connection->prepare(
            "UPDATE tasks 
                    SET description = :description, is_done = :isDone
                    WHERE id = :id"
        );
        return $query->execute([
            'description' => $task->getDescription(),
            'isDone' => $task->isDone() ? 'TRUE' : 'FALSE',
            'id' => $task->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $this->connection->beginTransaction();
        $query = $this->connection->prepare("DELETE FROM tasks WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

    /**
     * @param array $data
     *
     * @return Task
     * @throws Exception
     */
    private function parseTask(array $data): Task
    {
        $task = new Task($data['id']);
        $task->setUserName($data['user_name']);
        $task->setUserEmail($data['user_email']);
        $task->setDescription($data['description']);
        $task->setIsDone($data['is_done']);
        $createdAt = new DateTime($data['created_at']);
        $createdAt->setTimezone(new DateTimeZone('Europe/Moscow'));
        $task->setCreatedAt($createdAt);
        return $task;
    }
}