<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Data Mahasiswa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Data Mahasiswa</h2>

        <a
            href="<?= BASE_PATH ?>/mahasiswa/create"
            class="btn btn-primary"
        >
            Tambah Mahasiswa
        </a>
    </div>

    <?php if ($flash): ?>

        <div class="alert alert-<?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>

    <?php endif; ?>

    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Program Studi</th>
                    <th>Angkatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

            <?php if (empty($mahasiswa)): ?>

                <tr>
                    <td colspan="8" class="text-center">
                        Belum ada data mahasiswa.
                    </td>
                </tr>

            <?php else: ?>

                <?php foreach ($mahasiswa as $index => $row): ?>

                    <tr>

                        <td>
                            <?= $index + 1 ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['nim']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['nama']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['email']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['prodi_nama']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['angkatan']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($row['status']) ?>
                        </td>

                        <td>

                            <a
                                href="<?= BASE_PATH ?>/mahasiswa/edit/<?= $row['id'] ?>"
                                class="btn btn-warning btn-sm"
                            >
                                Edit
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>