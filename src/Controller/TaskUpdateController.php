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
                /*
                If an error occurs, the isUpdateSuccessful flag remains false
                 and therefore the code below will send a 500 response
                */
            }
            if ($isUpdateSuccessful) {
                return $response->withRedirect('/tasks');
            } else {
                return $response
                    ->withBody('500 Internal Server Error')
                    ->withStatus(500)
                    ->withHeader('Content-Type', 'text/plain');
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