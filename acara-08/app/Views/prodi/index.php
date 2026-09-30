<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Prodi - SI Akademik</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Data Program Studi</h1>

    <div class="mb-3">

        <a
            href="<?= BASE_PATH ?>/prodi/create"
            class="btn btn-primary"
        >
            Tambah Prodi
        </a>

        <a
            href="<?= BASE_PATH ?>/mahasiswa"
            class="btn btn-secondary"
        >
            Data Mahasiswa
        </a>

        <a
            href="<?= BASE_PATH ?>/matakuliah"
            class="btn btn-secondary"
        >
            Data Mata Kuliah
        </a>

    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-primary">

            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Prodi</th>
                <th>Aksi</th>
            </tr>

        </thead>

        <tbody>

        <?php if (empty($prodi)): ?>

            <tr>
                <td colspan="4" class="text-center">
                    Belum ada data prodi.
                </td>
            </tr>

        <?php else: ?>

            <?php $no = 1; ?>

            <?php foreach ($prodi as $p): ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td>
                        <?= htmlspecialchars($p['kode']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($p['nama']) ?>
                    </td>

                    <td>

                        <a
                            href="<?= BASE_PATH ?>/prodi/edit/<?= $p['id'] ?>"
                            class="btn btn-sm btn-warning"
                        >
                            Edit
                        </a>

                        <form
                            action="<?= BASE_PATH ?>/prodi/delete/<?= $p['id'] ?>"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Yakin ingin menghapus data prodi ini?');"
                        >

                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                            >
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php endif; ?>

        </tbody>

    </table>

</div>

</body>

</html>