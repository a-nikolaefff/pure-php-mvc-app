<?php

declare(strict_types=1);

namespace App\Controller\Utilities;

use App\Entity\Task;

class TaskValidator
{
    /**
     * Validate a task before saving into the database
     *
     * @param Task $task
     *
     * @return array<string> Found errors
     */
    public static function validate(Task $task): array
    {
        $userName = $task->getUserName();
        $userEmail = $task->getUserEmail();
        $description = $task->getDescription();
        $errors = [];
        if (empty($userName)) {
            $errors[] = "Field \"User name\" cannot be empty";
        }
        if (empty($userEmail)) {
            $errors[] = "Field \"User email\" cannot be empty";
        } else {
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email address '$userEmail' is invalid";
            }
        }
        if (empty($description)) {
            $errors[] = "Field \"Description\" cannot be empty";
        }
        return $errors;
    }
}