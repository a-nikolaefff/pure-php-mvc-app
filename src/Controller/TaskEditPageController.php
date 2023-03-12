<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;

class TaskEditPageController extends TaskController
{
    public function dispatch(
        RequestInterface $request,
        ResponseInterface $response,
        SessionInterface $session
    ): ResponseInterface {
        $session->start();
        $adminName = $session->get('admin-name');
        if (isset($adminName)) {
            $id = (int)$request->getAttribute("id");
            $task = $this->taskService->get($id);
            if (isset($task)) {
                $params = [
                    'adminName' => $adminName,
                    'task' => $task
                ];
                return $response->withBody(
                    $this->renderer->render('tasks/edit', $params)
                );
            }
        }
        return $response->withRedirect('/tasks');
    }
}