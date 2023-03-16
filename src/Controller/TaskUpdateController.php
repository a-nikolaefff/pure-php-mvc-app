<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;
use App\Controller\Utilities\TaskValidator;
use App\Entity\Task;
use Exception;

class TaskUpdateController extends TaskController
{

    public function dispatch(
        RequestInterface $request,
        ResponseInterface $response,
        SessionInterface $session
    ): ResponseInterface {
        $session->start();
        $adminName = $session->get('admin-name');
        if (!isset($adminName)) {
            return $response->withRedirect('/tasks');
        }
        $id = (int)$request->getAttribute("id");
        $task = new Task($id);
        $requestBody = $request->getBody();
        $task->setDescription($requestBody['description'] ?? '');
        $task->setIsDone(isset($requestBody['isDone']));
        $taskValidator = new TaskValidator($task);
        $errors = $taskValidator->validateUpdatingTask();
        if (count($errors) === 0) {
            $isUpdateSuccessful = false;
            try {
                $isUpdateSuccessful = $this->taskService->update($task);
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
            if ($isUpdateSuccessful) {
                return $response->withRedirect('/tasks');
            } else {
                $errors[]
                    = "An internal application error has occurred - failed to update data in the database";
            }
        }
        $params = [
            'adminName' => $adminName,
            'task' => $task,
            'errors' => $errors
        ];
        return $response->withBody(
            $this->renderer->render('tasks/edit', $params)
        );
    }
}