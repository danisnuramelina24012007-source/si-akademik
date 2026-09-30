<?php

require_once __DIR__ . '/../config/database.php';

require_once __DIR__ . '/../app/Models/Database.php';
require_once __DIR__ . '/../app/Models/MahasiswaModel.php';
require_once __DIR__ . '/../app/Models/ProdiModel.php';
require_once __DIR__ . '/../app/Models/MatakuliahModel.php';

require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Controllers/ProdiController.php';
require_once __DIR__ . '/../app/Controllers/MatakuliahController.php';

require_once __DIR__ . '/../routes/web.php';

use App\Controllers\MahasiswaController;
use App\Controllers\ProdiController;
use App\Controllers\MatakuliahController;

define('BASE_PATH', '/si-akademik/acara-08/public');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = BASE_PATH;

if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

/*
|--------------------------------------------------------------------------
| Route dengan ID
|--------------------------------------------------------------------------
*/

if ($method === 'GET') {

    if (preg_match('#^/mahasiswa/edit/([0-9]+)$#', $uri, $matches)) {

        $controller = new MahasiswaController();

        $controller->edit((int)$matches[1]);

        exit;
    }

    if (preg_match('#^/prodi/edit/([0-9]+)$#', $uri, $matches)) {

        $controller = new ProdiController();

        $controller->edit((int)$matches[1]);

        exit;
    }

    if (preg_match('#^/matakuliah/edit/([0-9]+)$#', $uri, $matches)) {

        $controller = new MatakuliahController();

        $controller->edit((int)$matches[1]);

        exit;
    }
}

if ($method === 'POST') {

    if (preg_match('#^/mahasiswa/update/([0-9]+)$#', $uri, $matches)) {

        $controller = new MahasiswaController();

        $controller->update((int)$matches[1]);

        exit;
    }

    if (preg_match('#^/mahasiswa/delete/([0-9]+)$#', $uri, $matches)) {

        $controller = new MahasiswaController();

        $controller->destroy((int)$matches[1]);

        exit;
    }

    if (preg_match('#^/prodi/update/([0-9]+)$#', $uri, $matches)) {

        $controller = new ProdiController();

        $controller->update((int)$matches[1]);

        exit;
    }

    if (preg_match('#^/prodi/delete/([0-9]+)$#', $uri, $matches)) {

        $controller = new ProdiController();

        $controller->destroy((int)$matches[1]);

        exit;
    }

    if (preg_match('#^/matakuliah/update/([0-9]+)$#', $uri, $matches)) {

        $controller = new MatakuliahController();

        $controller->update((int)$matches[1]);

        exit;
    }

    if (preg_match('#^/matakuliah/delete/([0-9]+)$#', $uri, $matches)) {

        $controller = new MatakuliahController();

        $controller->destroy((int)$matches[1]);

        exit;
    }
}

/*
|--------------------------------------------------------------------------
| Route biasa
|--------------------------------------------------------------------------
*/

if (isset($routes[$method][$uri])) {

    [$controllerName, $action] = $routes[$method][$uri];

    $controllerClass = "App\\Controllers\\{$controllerName}";

    $controller = new $controllerClass();

    $controller->$action();

    exit;
}

/*
|--------------------------------------------------------------------------
| 404
|--------------------------------------------------------------------------
*/

http_response_code(404);

echo '<h1>404 - Halaman tidak ditemukan</h1>';