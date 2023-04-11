<?php

declare(strict_types=1);

use App\Controller\Core\Application;
use App\Controller\Core\Request\RequestInterface;
use App\Controller\Core\Response\ResponseInterface;
use App\Controller\Core\Session\SessionInterface;
use App\Controller\IndexController;
use App\Controller\NotFoundController;
use App\Controller\SessionCreatePageController;
use App\Controller\SessionDeleteController;
use App\Controller\SessionNewController;
use App\Controller\TaskAddController;
use App\Controller\TaskCreatePageController;
use App\Controller\TaskDeleteController;
use App\Controller\TaskEditPageController;
use App\Controller\TaskGetAllController;
use App\Controller\TaskUpdateController;
use App\Model\Infrastructure\Admin\AdminRepository;
use App\Model\Infrastructure\Task\TaskRepository;
use App\Model\Infrastructure\UnitOfWork;
use App\Model\Services\Admin\AdminService;
use App\Model\Services\Task\TaskService;
use App\View\Renderer;

require_once "../vendor/autoload.php";

$connection = new PDO(
    'pgsql:host=pgsql;
    port=' . getenv('PGSQL_PORT') .
    ';dbname=' . getenv('PGSQL_DB'),
    getenv('PGSQL_USER'),
    getenv('PGSQL_PASSWORD')
);

$adminRepository = new AdminRepository($connection);
$taskRepository = new TaskRepository($connection);

$dbContext = new UnitOfWork($connection);
$dbContext->setAdminRepository($adminRepository);
$dbContext->setTaskRepository($taskRepository);

$adminService = new AdminService($dbContext);
$taskService = new TaskService($dbContext);

$renderer = new Renderer('/var/www/app/templates', '_layout');

$indexController = new IndexController($renderer);
$sessionCreatePageController = new SessionCreatePageController($renderer);
$sessionNewController = new SessionNewController($renderer, $adminService);
$sessionDeleteController = new SessionDeleteController($renderer);
$taskGetAllController = new TaskGetAllController($renderer, $taskService);
$taskAddController = new TaskAddController($renderer, $taskService);
$taskCreatePageController = new TaskCreatePageController(
    $renderer, $taskService
);
$taskEditPageController = new TaskEditPageController($renderer, $taskService);
$taskUpdateController = new TaskUpdateController($renderer, $taskService);
$taskDeleteController = new TaskDeleteController($renderer, $taskService);
$notFoundController = new NotFoundController($renderer);

$app = new Application();

$app->get('/', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($indexController) {
    return $indexController->dispatch($request, $response, $session);
});

$app->get('/sessions/new', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($sessionCreatePageController) {
    return $sessionCreatePageController->dispatch(
        $request,
        $response,
        $session
    );
});

$app->post('/sessions', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($sessionNewController) {
    return $sessionNewController->dispatch($request, $response, $session);
});

$app->delete('/sessions', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($sessionDeleteController) {
    return $sessionDeleteController->dispatch($request, $response, $session);
});

$app->get('/tasks', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($taskGetAllController) {
    return $taskGetAllController->dispatch($request, $response, $session);
});

$app->post('/tasks', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($taskAddController) {
    return $taskAddController->dispatch($request, $response, $session);
});

$app->get('/tasks/new', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($taskCreatePageController) {
    return $taskCreatePageController->dispatch($request, $response, $session);
});

$app->get('/tasks/{id}/edit', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($taskEditPageController) {
    return $taskEditPageController->dispatch($request, $response, $session);
});

$app->put('/tasks/{id}', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($taskUpdateController) {
    return $taskUpdateController->dispatch($request, $response, $session);
});

$app->delete('/tasks/{id}', function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($taskDeleteController) {
    return $taskDeleteController->dispatch($request, $response, $session);
});

$app->notFound(function (
    RequestInterface $request,
    ResponseInterface $response,
    SessionInterface $session
) use ($notFoundController) {
    return $notFoundController->dispatch($request, $response, $session);
});

$app->run();











