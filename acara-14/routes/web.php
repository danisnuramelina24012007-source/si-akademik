<?php

$routes = [
    'GET' => [
        '/' => ['MahasiswaController', 'index'],
        '/mahasiswa' => ['MahasiswaController', 'index'],
        '/mahasiswa/create' => ['MahasiswaController', 'create'],
    ],

    'POST' => [
        '/mahasiswa/store' => ['MahasiswaController', 'store'],
    ],
];