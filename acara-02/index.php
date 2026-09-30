<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SI Akademik - Acara 2</title>
</head>
<body>

    <h1>Selamat datang di SI Akademik</h1>

    <h2>Pencarian Mahasiswa</h2>

    <form action="proses-get.php" method="GET">
        <label for="keyword">Cari Mahasiswa:</label>
        <input type="text" id="keyword" name="keyword">
        <button type="submit">Cari</button>
    </form>

    <h2>Login</h2>

    <form action="proses-post.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">

        <br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <br><br>

        <button type="submit">Login</button>
    </form>

</body>
</html>