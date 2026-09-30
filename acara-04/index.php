<?php

require_once __DIR__ . '/app/Models/Mahasiswa.php';

use App\Models\Mahasiswa;

$mahasiswa = [
    new Mahasiswa(
        '2401001',
        'Budi Santoso',
        'Teknik Informatika'
    ),

    new Mahasiswa(
        '2501002',
        'Citra Lestari',
        'Teknik Informatika'
    ),

    new Mahasiswa(
        '2601003',
        'Dina Amelia',
        'Teknik Informatika'
    )
];

$content = __DIR__ . '/app/Views/mahasiswa/index.php';

require __DIR__ . '/app/Views/layouts/main.php';