<?php

$routes = [
    'GET' => [
        '/mahasiswa' => ['MahasiswaController', 'index'],
        '/mahasiswa/create' => ['MahasiswaController', 'create'],
    ],

    'POST' => [
        '/mahasiswa/store' => ['MahasiswaController', 'store'],
    ],
];