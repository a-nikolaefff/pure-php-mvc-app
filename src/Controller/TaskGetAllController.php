<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;
use App\Model\Services\Task\TaskServiceInterface;
use App\View\RendererInterface;
use Exception;

class TaskGetAllController extends TaskController
{
    public function __construct(
        RendererInterface $render,
        TaskServiceInterface $taskService
    ) {
        parent::__construct($render, $taskService);
    }

    public function dispatch(
        RequestInterface $request,
        ResponseInterface $response,
        SessionInterface $session
    ): ResponseInterface {
        $session->start();
        $adminName = $session->get('admin-name');
        $errors = [];
        try {
            $tasks = $this->taskService->getAll();
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
        $params = [
            'adminName' => $adminName,
            'tasks' => $tasks,
            'errors' => $errors
        ];
        return $response->withBody(
            $this->renderer->render('tasks/index', $params)
        );
    }
}