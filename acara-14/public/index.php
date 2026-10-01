<?php

session_start();

define('BASE_PATH', '/si-akademik/acara-14/public');

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

try {
    $database = new Database($config);

$mahasiswaRepository = new MahasiswaRepository($database);
$prodiRepository = new ProdiRepository($database);

    $mahasiswaService = new MahasiswaService(
        $mahasiswaRepository,
        $prodiRepository
    );

    $controller = new MahasiswaController(
        $mahasiswaService,
        $mahasiswaRepository,
        $prodiRepository
    );

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $basePath = BASE_PATH;

    if (str_starts_with($path, $basePath)) {
        $path = substr($path, strlen($basePath));
    }

    $path = '/' . trim($path, '/');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($path === '/' && $method === 'GET') {
        header('Location: ' . BASE_PATH . '/mahasiswa');
        exit;
    }

    if ($path === '/mahasiswa' && $method === 'GET') {
        $controller->index();
        exit;
    }

    if ($path === '/mahasiswa/create' && $method === 'GET') {
        $controller->create();
        exit;
    }

    if (preg_match('#^/mahasiswa/edit/(\d+)$#', $path, $matches) && $method === 'GET') {
        $controller->edit((int) $matches[1]);
        exit;
    }

    if ($path === '/mahasiswa/store' && $method === 'POST') {
        $controller->store();
        exit;
    }

    if (preg_match('#^/mahasiswa/update/(\d+)$#', $path, $matches) && $method === 'POST') {
        $controller->update((int) $matches[1]);
        exit;
    }

    if (preg_match('#^/mahasiswa/delete/(\d+)$#', $path, $matches) && $method === 'POST') {
        $controller->delete((int) $matches[1]);
        exit;
    }

    http_response_code(404);
    echo 'Halaman tidak ditemukan.';

} catch (\Throwable $e) {

    $logDirectory = __DIR__ . '/../storage/logs';
    $logFile = $logDirectory . '/app.log';

    if (!is_dir($logDirectory)) {
        mkdir($logDirectory, 0777, true);
    }

    $logMessage =
        '[' . date('Y-m-d H:i:s') . '] ' .
        $e->getMessage() .
        PHP_EOL;

    error_log($logMessage, 3, $logFile);

    http_response_code(500);

    echo '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Terjadi Kesalahan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <div class="alert alert-danger">
                Data gagal disimpan.
            </div>
        </div>
    </body>
    </html>
    ';
}