<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;
use App\View\RendererInterface;

final class IndexController extends BaseController
{

    public function __construct(RendererInterface $render)
    {
        parent::__construct($render);
    }

    public function dispatch(
        RequestInterface $request,
        ResponseInterface $response,
        SessionInterface $session
    ): ResponseInterface {
        return $response->withRedirect('/tasks');
    }
}