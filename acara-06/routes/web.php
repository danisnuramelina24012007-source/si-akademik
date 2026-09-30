<?php

$routes = [
    'GET' => [
        '/' => ['AuthController', 'loginForm'],
        '/login' => ['AuthController', 'loginForm'],
        '/dashboard' => ['DashboardController', 'index'],
        '/mahasiswa' => ['MahasiswaController', 'index'],
        '/logout' => ['AuthController', 'logout'],
    ],

    'POST' => [
        '/login' => ['AuthController', 'login'],
    ],
];

$middlewareRoutes = [
    '/dashboard' => [
        'App\\Core\\Middleware\\AuthMiddleware'
    ],

    '/mahasiswa' => [
        'App\\Core\\Middleware\\AuthMiddleware'
    ],
];