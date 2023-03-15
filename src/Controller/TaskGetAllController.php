<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;
use App\Dto\SortingCriterion;
use App\Dto\SortingOrder;
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
        $queryParams = $request->getQueryParams();
        $sortingCriterion = match ($queryParams['sort'] ?? 'created_at') {
            'user_name' => SortingCriterion::UserName,
            'user_email' => SortingCriterion::UserEmail,
            'description' => SortingCriterion::Description,
            'is_done' => SortingCriterion::IsDone,
            default => SortingCriterion::CreatedAt,
        };
        $sortingOrder = match ($queryParams['order'] ?? 'asc') {
            'desc' => SortingOrder::DESC,
            default => SortingOrder::ASC
        };
        $errors = [];
        $tasks = [];
        try {
            $tasks = $this->taskService->getAll(
                $sortingCriterion,
                $sortingOrder
            );
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
        $params = [
            'adminName' => $adminName,
            'tasks' => $tasks,
            'sortBy' => $sortingCriterion,
            'orderBy' => $sortingOrder,
            'errors' => $errors
        ];
        return $response->withBody(
            $this->renderer->render('tasks/index', $params)
        );
    }
}