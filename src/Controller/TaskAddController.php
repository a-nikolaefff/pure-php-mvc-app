<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;
use App\Controller\Utilities\TaskValidator;
use App\Entity\Task;

class TaskAddController extends TaskController
{
    public function dispatch(
        RequestInterface $request,
        ResponseInterface $response,
        SessionInterface $session
    ): ResponseInterface {
        $requestBody = $request->getBody();
        $task = new Task();
        $task->setUserName($requestBody['userName'] ?? '');
        $task->setUserEmail($requestBody['userEmail'] ?? '');
        $task->setDescription($requestBody['description'] ?? '');
        $taskValidator = new TaskValidator($task);
        $errors = $taskValidator->validateNewTask();
        if (count($errors) === 0) {
            $isInsertionSuccessful = $this->taskService->insert($task);
            if ($isInsertionSuccessful) {
                return $response->withRedirect('/tasks');
            } else {
                return $response
                    ->withBody('500 Internal Server Error')
                    ->withStatus(500)
                    ->withHeader('Content-Type', 'text/plain');
            }
        }
        $session->start();
        $adminName = $session->get('admin-name');
        $params = [
            'adminName' => $adminName,
            'errors' => $errors
        ];
        return $response->withBody(
            $this->renderer->render('tasks/new', $params)
        );
    }
}