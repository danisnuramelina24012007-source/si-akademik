<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../routes/web.php';

require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Core/Middleware/AuthMiddleware.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = BASE_PATH;

if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

/*
|--------------------------------------------------------------------------
| Cek apakah route membutuhkan middleware
|--------------------------------------------------------------------------
*/

if (isset($middlewareRoutes[$uri])) {

    foreach ($middlewareRoutes[$uri] as $middleware) {

        $middlewareInstance = new $middleware();

        $middlewareInstance->handle();
    }
}

/*
|--------------------------------------------------------------------------
| Routing
|--------------------------------------------------------------------------
*/

if (isset($routes[$method][$uri])) {

    [$controllerName, $action] = $routes[$method][$uri];

    $controllerClass = "App\\Controllers\\{$controllerName}";

    $controller = new $controllerClass();

    $controller->$action();

} else {

    http_response_code(404);

    echo "<h1>404 - Halaman tidak ditemukan</h1>";
}