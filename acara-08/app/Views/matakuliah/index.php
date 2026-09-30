<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Mata Kuliah - SI Akademik</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Data Mata Kuliah</h1>

    <div class="mb-3">

        <a
            href="<?= BASE_PATH ?>/matakuliah/create"
            class="btn btn-primary"
        >
            Tambah Mata Kuliah
        </a>

        <a
            href="<?= BASE_PATH ?>/mahasiswa"
            class="btn btn-secondary"
        >
            Data Mahasiswa
        </a>

        <a
            href="<?= BASE_PATH ?>/prodi"
            class="btn btn-secondary"
        >
            Data Prodi
        </a>

    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-primary">

            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Program Studi</th>
                <th>Aksi</th>
            </tr>

        </thead>

        <tbody>

        <?php if (empty($matakuliah)): ?>

            <tr>
                <td colspan="6" class="text-center">
                    Belum ada data mata kuliah.
                </td>
            </tr>

        <?php else: ?>

            <?php $no = 1; ?>

            <?php foreach ($matakuliah as $mk): ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td>
                        <?= htmlspecialchars($mk['kode']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mk['nama']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mk['sks']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mk['prodi_nama']) ?>
                    </td>

                    <td>

                        <a
                            href="<?= BASE_PATH ?>/matakuliah/edit/<?= $mk['id'] ?>"
                            class="btn btn-sm btn-warning"
                        >
                            Edit
                        </a>

                        <form
                            action="<?= BASE_PATH ?>/matakuliah/delete/<?= $mk['id'] ?>"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?');"
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