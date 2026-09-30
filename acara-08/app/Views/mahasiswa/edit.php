<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Mahasiswa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Edit Mahasiswa</h1>

    <form
        action="<?= BASE_PATH ?>/mahasiswa/update/<?= $mahasiswa['id'] ?>"
        method="POST"
    >

        <div class="mb-3">

            <label class="form-label">
                NIM
            </label>

            <input
                type="text"
                name="nim"
                class="form-control"
                value="<?= htmlspecialchars($mahasiswa['nim']) ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">
                Nama
            </label>

            <input
                type="text"
                name="nama"
                class="form-control"
                value="<?= htmlspecialchars($mahasiswa['nama']) ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">
                Email
            </label>

            <input
                type="email"
                name="email"
                class="form-control"
                value="<?= htmlspecialchars($mahasiswa['email']) ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">
                Program Studi
            </label>

            <select
                name="prodi_id"
                class="form-select"
                required
            >

                <?php foreach ($prodi as $p): ?>

                    <option
                        value="<?= $p['id'] ?>"
                        <?= $p['id'] == $mahasiswa['prodi_id'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($p['kode']) ?>
                        -
                        <?= htmlspecialchars($p['nama']) ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Angkatan
            </label>

            <input
                type="number"
                name="angkatan"
                class="form-control"
                value="<?= htmlspecialchars($mahasiswa['angkatan']) ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">
                Status
            </label>

            <select
                name="status"
                class="form-select"
            >

                <option
                    value="aktif"
                    <?= $mahasiswa['status'] === 'aktif' ? 'selected' : '' ?>
                >
                    Aktif
                </option>

                <option
                    value="cuti"
                    <?= $mahasiswa['status'] === 'cuti' ? 'selected' : '' ?>
                >
                    Cuti
                </option>

                <option
                    value="lulus"
                    <?= $mahasiswa['status'] === 'lulus' ? 'selected' : '' ?>
                >
                    Lulus
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Update
        </button>

        <a
            href="<?= BASE_PATH ?>/mahasiswa"
            class="btn btn-secondary"
        >
            Kembali
        </a>

    </form>

</div>

</body>

</html>