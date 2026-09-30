<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Mahasiswa - Acara 9</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Data Mahasiswa</h1>

    <div class="mb-3">

        <a
            href="<?= BASE_PATH ?>/mahasiswa/create"
            class="btn btn-primary"
        >
            Tambah Mahasiswa
        </a>

    </div>

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
                        <?= htmlspecialchars($mhs['prodi_nama']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mhs['angkatan']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($mhs['status']) ?>
                    </td>

                    <td>

                        <a
                            href="<?= BASE_PATH ?>/mahasiswa/edit/<?= $mhs['id'] ?>"
                            class="btn btn-sm btn-warning"
                        >
                            Edit
                        </a>

                        <form
                            action="<?= BASE_PATH ?>/mahasiswa/delete/<?= $mhs['id'] ?>"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Yakin ingin menghapus data ini?');"
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