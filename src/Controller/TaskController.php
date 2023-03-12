<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Services\Task\TaskServiceInterface;
use App\View\RendererInterface;

abstract class TaskController extends BaseController
{
    protected TaskServiceInterface $taskService;

    public function __construct(
        RendererInterface $render,
        TaskServiceInterface $taskService
    ) {
        parent::__construct($render);
        $this->taskService = $taskService;
    }
}