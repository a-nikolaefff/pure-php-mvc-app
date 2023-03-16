<?php

declare(strict_types=1);

namespace App\Controller\Utilities;

use App\Entity\Task;

class TaskValidator
{
    private Task $task;
    private array $errors = [];

    /**
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Validate a new task before saving into the database
     *
     * @param Task $task
     *
     * @return array<string> Found errors
     */
    public function validateNewTask(): array
    {
        $this->checkUserName();
        $this->checkUserEmail();
        $this->checkDescription();
        return $this->errors;
    }

    /**
     * Validate a task to update before saving into the database
     *
     * @param Task $task
     *
     * @return array<string> Found errors
     */
    public function validateUpdatingTask(): array
    {
        $this->checkDescription();
        return $this->errors;
    }

    private function checkUserName(): void
    {
        $userName = $this->task->getUserName();
        if (empty($userName)) {
            $this->errors[] = "Field \"User name\" cannot be empty";
        }
    }

    private function checkUserEmail(): void
    {
        $userEmail = $this->task->getUserEmail();
        if (empty($userEmail)) {
            $this->errors[] = "Field \"User email\" cannot be empty";
        } else {
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                $this->errors[] = "Email address '$userEmail' is invalid";
            }
        }
    }

    private function checkDescription(): void
    {
        $description = $this->task->getDescription();
        if (empty($description)) {
            $this->errors[] = "Field \"Description\" cannot be empty";
        }
    }
}