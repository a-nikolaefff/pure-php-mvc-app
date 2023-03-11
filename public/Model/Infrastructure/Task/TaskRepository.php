<?php

declare(strict_types=1);

namespace App\Model\Infrastructure\Task;

use App\Entity\Task;
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

    public function getAll(): array
    {
        $query = $this->connection->prepare("SELECT * FROM tasks");
        $query->execute();
        $tasks = [];
        while (false !== $data = $query->fetch(PDO::FETCH_ASSOC)) {
            $task = new Task($data['id']);
            $task->setUserName($data['user_name']);
            $task->setUserEmail($data['user_email']);
            $task->setDescription($data['description']);
            $task->setIsDone($data['is_done']);
            $tasks[] = $task;
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
            $task = new Task($data['id']);
            $task->setUserName($data['user_name']);
            $task->setUserEmail($data['user_email']);
            $task->setDescription($data['description']);
            $task->setIsDone($data['is_done']);
            return $task;
        }
    }

    public function insert(Task $task): bool
    {
        $this->connection->beginTransaction();
        $query = $this->connection->prepare(
            "INSERT INTO tasks (user_name, user_email, description, is_done) 
                    VALUES (:userName, :userEmail, :description. :isDone)"
        );
        return $query->execute([
            'userName' => $task->getUserName(),
            'userEmail' => $task->getUserEmail(),
            'description' => $task->getDescription(),
            'isDone' => $task->isDone() ? 'TRUE' : 'FALSE'
        ]);
    }

    public function update(Task $task): bool
    {
        $this->connection->beginTransaction();
        $query = $this->connection->prepare(
            "UPDATE tasks 
                    SET user_name = :userName, user_email = :userEmail, description = :description, is_done = :isDone
                    WHERE id = :id"
        );
        return $query->execute([
            'userName' => $task->getUserName(),
            'userEmail' => $task->getUserEmail(),
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
}