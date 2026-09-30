<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';

use App\Controllers\HomeController;
use App\Controllers\MahasiswaController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = BASE_PATH;

if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

/*
|--------------------------------------------------------------------------
| Tugas Mandiri
|--------------------------------------------------------------------------
| Menangani URL /mahasiswa/{id}
*/

if ($method === 'GET' && preg_match('#^/mahasiswa/([0-9]+)$#', $uri, $matches)) {

    $controller = new MahasiswaController();

    $controller->show($matches[1]);

    exit;
}

/*
|--------------------------------------------------------------------------
| Routing biasa
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