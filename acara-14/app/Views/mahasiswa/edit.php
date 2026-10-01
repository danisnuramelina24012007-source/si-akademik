<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Edit Mahasiswa
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">
        Edit Data Mahasiswa
    </h2>

    <?php if ($flash): ?>

        <div
            class="alert alert-<?= htmlspecialchars($flash['type']) ?>"
        >
            <?= htmlspecialchars($flash['message']) ?>
        </div>

    <?php endif; ?>

    <form
        action="<?= BASE_PATH ?>/mahasiswa/update/<?= $mahasiswa->getId() ?>"
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
                value="<?= htmlspecialchars(
                    $mahasiswa->getNim()
                ) ?>"
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
                value="<?= htmlspecialchars(
                    $mahasiswa->getNama()
                ) ?>"
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
                value="<?= htmlspecialchars(
                    $mahasiswa->getEmail()
                ) ?>"
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

                <?php foreach ($prodi as $item): ?>

                    <option
                        value="<?= $item['id'] ?>"
                        <?= $item['id'] ==
                            $mahasiswa->getProdiId()
                            ? 'selected'
                            : '' ?>
                    >
                        <?= htmlspecialchars(
                            $item['kode']
                        ) ?>
                        -
                        <?= htmlspecialchars(
                            $item['nama']
                        ) ?>
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
                value="<?= htmlspecialchars(
                    $mahasiswa->getAngkatan()
                ) ?>"
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
                    <?= $mahasiswa->getStatus() === 'aktif'
                        ? 'selected'
                        : '' ?>
                >
                    Aktif
                </option>

                <option
                    value="cuti"
                    <?= $mahasiswa->getStatus() === 'cuti'
                        ? 'selected'
                        : '' ?>
                >
                    Cuti
                </option>

                <option
                    value="lulus"
                    <?= $mahasiswa->getStatus() === 'lulus'
                        ? 'selected'
                        : '' ?>
                >
                    Lulus
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Simpan Perubahan
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