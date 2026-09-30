<?php

require_once __DIR__ . '/../app/Models/Model.php';
require_once __DIR__ . '/../app/Models/MahasiswaModel.php';

use App\Models\MahasiswaModel;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = '/si-akademik/acara-07/public';

if (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base)) ?: '/';
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && $uri === '/mahasiswa') {

    $model = new MahasiswaModel();

    $mahasiswa = $model->all();

    ?>

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Data Mahasiswa - SI Akademik</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        >
    </head>

    <body>

    <div class="container mt-5">

        <h1 class="mb-4">Data Mahasiswa</h1>

        <table class="table table-bordered table-striped">

            <thead class="table-primary">

                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

            <?php $no = 1; ?>

            <?php foreach ($mahasiswa as $mhs): ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td>
                        <?= htmlspecialchars($mhs['nim']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mhs['nama']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mhs['email']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mhs['prodi']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mhs['angkatan']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mhs['status']) ?>
                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    </body>

    </html>

    <?php

    exit;
}

http_response_code(404);

echo '<h1>404 - Halaman tidak ditemukan</h1>';