<?php

session_start();

define(
    'BASE_PATH',
    '/si-akademik/acara-13/public'
);

require_once __DIR__ . '/../app/Models/Database.php';
require_once __DIR__ . '/../app/Models/Mahasiswa.php';

require_once __DIR__ . '/../app/Repositories/MahasiswaRepository.php';
require_once __DIR__ . '/../app/Repositories/ProdiRepository.php';

require_once __DIR__ . '/../app/Services/MahasiswaService.php';

require_once __DIR__ . '/../app/Controllers/BaseController.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';

use App\Models\Database;
use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
use App\Services\MahasiswaService;
use App\Controllers\MahasiswaController;

$config = require __DIR__ . '/../config/database.php';

$database = new Database($config);

$mahasiswaRepo = new MahasiswaRepository($database);
$prodiRepo = new ProdiRepository($database);

$service = new MahasiswaService(
    $mahasiswaRepo,
    $prodiRepo
);

$controller = new MahasiswaController(
    $service,
    $mahasiswaRepo,
    $prodiRepo
);

$method = $_SERVER['REQUEST_METHOD'];

$uri = parse_url(
    $_SERVER['REQUEST_URI'],
    PHP_URL_PATH
);

$path = str_replace(
    BASE_PATH,
    '',
    $uri
);

if ($path === '') {
    $path = '/';
}

/*
|--------------------------------------------------------------------------
| GET Routes
|--------------------------------------------------------------------------
*/

if ($method === 'GET' && $path === '/') {
    $controller->index();
    exit;
}

if ($method === 'GET' && $path === '/mahasiswa') {
    $controller->index();
    exit;
}

if ($method === 'GET' && $path === '/mahasiswa/create') {
    $controller->create();
    exit;
}

/*
|--------------------------------------------------------------------------
| GET Edit
|--------------------------------------------------------------------------
*/

if (
    $method === 'GET' &&
    preg_match(
        '#^/mahasiswa/edit/([0-9]+)$#',
        $path,
        $matches
    )
) {
    $controller->edit((int) $matches[1]);
    exit;
}

/*
|--------------------------------------------------------------------------
| POST Store
|--------------------------------------------------------------------------
*/

if (
    $method === 'POST' &&
    $path === '/mahasiswa/store'
) {
    $controller->store();
    exit;
}

/*
|--------------------------------------------------------------------------
| POST Update
|--------------------------------------------------------------------------
*/

if (
    $method === 'POST' &&
    preg_match(
        '#^/mahasiswa/update/([0-9]+)$#',
        $path,
        $matches
    )
) {
    $controller->update((int) $matches[1]);
    exit;
}

/*
|--------------------------------------------------------------------------
| 404
|--------------------------------------------------------------------------
*/

http_response_code(404);

echo '<h1>404 - Halaman Tidak Ditemukan</h1>';