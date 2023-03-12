<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;

class TaskCreatePageController extends TaskController
{

    public function dispatch(
        RequestInterface $request,
        ResponseInterface $response,
        SessionInterface $session
    ): ResponseInterface {
        $session->start();
        $adminName = $session->get('admin-name');
        $params = ['adminName' => $adminName,];
        return $response->withBody(
            $this->renderer->render('tasks/new', $params)
        );
    }
}