<?php

$routes = [
    'GET' => [
        '/mahasiswa' => ['MahasiswaController', 'index'],
        '/mahasiswa/create' => ['MahasiswaController', 'create'],

        '/prodi' => ['ProdiController', 'index'],
        '/prodi/create' => ['ProdiController', 'create'],

        '/matakuliah' => ['MatakuliahController', 'index'],
        '/matakuliah/create' => ['MatakuliahController', 'create'],
    ],

    'POST' => [
        '/mahasiswa/store' => ['MahasiswaController', 'store'],
        '/mahasiswa/update' => ['MahasiswaController', 'update'],
        '/mahasiswa/delete' => ['MahasiswaController', 'destroy'],

        '/prodi/store' => ['ProdiController', 'store'],
        '/prodi/update' => ['ProdiController', 'update'],
        '/prodi/delete' => ['ProdiController', 'destroy'],

        '/matakuliah/store' => ['MatakuliahController', 'store'],
        '/matakuliah/update' => ['MatakuliahController', 'update'],
        '/matakuliah/delete' => ['MatakuliahController', 'destroy'],
    ],
];