<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Mata Kuliah</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Edit Mata Kuliah</h1>

    <form
        action="<?= BASE_PATH ?>/matakuliah/update/<?= $matakuliahData['id'] ?>"
        method="POST"
    >

        <div class="mb-3">

            <label class="form-label">
                Kode Mata Kuliah
            </label>

            <input
                type="text"
                name="kode"
                class="form-control"
                value="<?= htmlspecialchars($matakuliahData['kode']) ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">
                Nama Mata Kuliah
            </label>

            <input
                type="text"
                name="nama"
                class="form-control"
                value="<?= htmlspecialchars($matakuliahData['nama']) ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">
                SKS
            </label>

            <input
                type="number"
                name="sks"
                class="form-control"
                min="1"
                max="6"
                value="<?= htmlspecialchars($matakuliahData['sks']) ?>"
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
                        <?= $p['id'] == $matakuliahData['prodi_id'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($p['kode']) ?>
                        -
                        <?= htmlspecialchars($p['nama']) ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Update
        </button>

        <a
            href="<?= BASE_PATH ?>/matakuliah"
            class="btn btn-secondary"
        >
            Kembali
        </a>

    </form>

</div>

</body>

</html>