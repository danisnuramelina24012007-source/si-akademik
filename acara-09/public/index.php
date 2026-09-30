<?php

require_once __DIR__ . '/../app/Models/Database.php';
require_once __DIR__ . '/../app/Models/Mahasiswa.php';

require_once __DIR__ . '/../app/Repositories/MahasiswaRepository.php';

require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';

require_once __DIR__ . '/../routes/web.php';

use App\Models\Database;
use App\Repositories\MahasiswaRepository;
use App\Controllers\MahasiswaController;

define('BASE_PATH', '/si-akademik/acara-09/public');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = BASE_PATH;

if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

$database = new Database();

$repository = new MahasiswaRepository($database);

$controller = new MahasiswaController($repository);


if ($method === 'GET') {

    if (preg_match('#^/mahasiswa/edit/([0-9]+)$#', $uri, $matches)) {

        $controller->edit((int) $matches[1]);

        exit;
    }
}


if ($method === 'POST') {

    if (preg_match('#^/mahasiswa/update/([0-9]+)$#', $uri, $matches)) {

        $controller->update((int) $matches[1]);

        exit;
    }

    if (preg_match('#^/mahasiswa/delete/([0-9]+)$#', $uri, $matches)) {

        $controller->destroy((int) $matches[1]);

        exit;
    }
}


if (isset($routes[$method][$uri])) {

    [$controllerName, $action] = $routes[$method][$uri];

    $controllerClass = "App\\Controllers\\{$controllerName}";

    $controller->$action();

    exit;
}


http_response_code(404);

echo '<h1>404 - Halaman tidak ditemukan</h1>';