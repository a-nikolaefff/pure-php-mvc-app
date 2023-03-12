<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;

class TaskDeleteController extends TaskController
{

    public function dispatch(
        RequestInterface $request,
        ResponseInterface $response,
        SessionInterface $session
    ): ResponseInterface {
        $session->start();
        $adminName = $session->get('admin-name');
        if (isset($adminName)) {
            $id = $request->getAttribute("id");
            $this->taskService->delete((int)$id);
        }
        return $response->withRedirect('/tasks');
    }
}