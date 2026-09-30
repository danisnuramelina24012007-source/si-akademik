<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Tambah Mahasiswa</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">
        Tambah Data Mahasiswa
    </h2>

    <?php if ($flash): ?>

        <div class="alert alert-<?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>

    <?php endif; ?>

    <form
        action="<?= BASE_PATH ?>/mahasiswa/store"
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

                <option value="">
                    -- Pilih Program Studi --
                </option>

                <?php foreach ($prodi as $item): ?>

                    <option value="<?= $item['id'] ?>">
                        <?= htmlspecialchars($item['kode']) ?>
                        -
                        <?= htmlspecialchars($item['nama']) ?>
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

                <option value="aktif">
                    Aktif
                </option>

                <option value="cuti">
                    Cuti
                </option>

                <option value="lulus">
                    Lulus
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Simpan
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