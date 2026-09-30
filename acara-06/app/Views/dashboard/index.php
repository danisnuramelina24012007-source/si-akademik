<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - SI Akademik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Dashboard</h1>

    <p>
        Selamat datang,
        <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>.
    </p>

    <a href="<?= BASE_PATH ?>/mahasiswa" class="btn btn-primary">
        Data Mahasiswa
    </a>

    <a href="<?= BASE_PATH ?>/logout" class="btn btn-danger">
        Logout
    </a>

</div>

</body>
</html>