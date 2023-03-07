<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;
use App\Model\Services\Admin\AdminServiceInterface;
use App\View\RendererInterface;

final class SessionNewController extends BaseController
{
    private AdminServiceInterface $adminService;

    public function __construct(
        RendererInterface $render,
        AdminServiceInterface $adminService
    ) {
        parent::__construct($render);
        $this->adminService = $adminService;
    }

    public function dispatch(
        RequestInterface $request,
        ResponseInterface $response,
        SessionInterface $session
    ): ResponseInterface {
        $requestBody = $request->getBody();
        $errors = [];
        $name = $requestBody['name'] ?? '';
        $password = $requestBody['password'] ?? '';
        if ($this->adminService->isAdminVerified($name, $password)) {
            $session->start();
            $session->set('admin-name', 'admin');
            return $response->withRedirect('/tasks');
        } else {
            $errors[] = "Invalid name or password";
        }
        $params = ['errors' => $errors];
        return $response->withBody(
            $this->renderer->render('sessions/new', $params)
        );
    }
}