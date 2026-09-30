<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Mahasiswa - Acara 9</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Tambah Mahasiswa</h1>

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

            <input
                type="number"
                name="prodi_id"
                class="form-control"
                value="1"
                required
            >

            <small class="text-muted">
                Gunakan ID prodi yang tersedia di database.
            </small>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Angkatan
            </label>

            <input
                type="number"
                name="angkatan"
                class="form-control"
                value="<?= date('Y') ?>"
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