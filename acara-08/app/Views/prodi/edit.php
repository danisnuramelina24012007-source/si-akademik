<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Prodi</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Edit Program Studi</h1>

    <form
        action="<?= BASE_PATH ?>/prodi/update/<?= $prodiData['id'] ?>"
        method="POST"
    >

        <div class="mb-3">

            <label class="form-label">
                Kode Prodi
            </label>

            <input
                type="text"
                name="kode"
                class="form-control"
                value="<?= htmlspecialchars($prodiData['kode']) ?>"
                required
            >

        </div>

        <div class="mb-3">

            <label class="form-label">
                Nama Prodi
            </label>

            <input
                type="text"
                name="nama"
                class="form-control"
                value="<?= htmlspecialchars($prodiData['nama']) ?>"
                required
            >

        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Update
        </button>

        <a
            href="<?= BASE_PATH ?>/prodi"
            class="btn btn-secondary"
        >
            Kembali
        </a>

    </form>

</div>

</body>

</html>