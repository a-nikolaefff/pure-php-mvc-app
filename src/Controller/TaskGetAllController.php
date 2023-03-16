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
    private const DEFAULT_SORT_BY = SortingCriterion::CREATED_AT;
    private const DEFAULT_ORDER_BY = SortingOrder::ASC;
    private const DEFAULT_TASKS_PER_PAGE = 5;

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

        $sortingCriterion = self::DEFAULT_SORT_BY;
        if (isset($queryParams['sort'])) {
            $sortingCriterion = SortingCriterion::tryFrom($queryParams['sort'])
                ?? $sortingCriterion;
        }
        $sortingOrder = self::DEFAULT_ORDER_BY;
        if (isset($queryParams['order'])) {
            $sortingOrder = SortingOrder::tryFrom($queryParams['order']) ??
                $sortingOrder;
        }

        $limit = $queryParams['limit'] ?? self::DEFAULT_TASKS_PER_PAGE;
        $taskTotalCount = $this->taskService->getTotalCount();
        $pageTotalCount = (int)ceil($taskTotalCount / $limit);
        $page = (int)max((int)($queryParams['page'] ?? 1), 1);
        $page = (int)min($page, $pageTotalCount);

        $errors = [];
        $tasks = [];
        try {
            $tasks = $this->taskService->getAll(
                $sortingCriterion,
                $sortingOrder,
                $page,
                $limit
            );
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
        $params = [
            'adminName' => $adminName,
            'tasks' => $tasks,
            'sortBy' => $sortingCriterion,
            'orderBy' => $sortingOrder,
            'currentPage' => $page,
            'pageTotalCount' => $pageTotalCount,
            'errors' => $errors
        ];
        return $response->withBody(
            $this->renderer->render('tasks/index', $params)
        );
    }
}