<?php

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'mahasiswa':
        require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';

        $controller = new MahasiswaController();
        $controller->index();
        break;

    default:
        require_once __DIR__ . '/../app/Controllers/HomeController.php';

        $controller = new HomeController();
        $controller->index();
        break;
}