<?php

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

echo "<h1>Hasil Login</h1>";
echo "<p>Username yang dikirim: " . htmlspecialchars($username) . "</p>";
echo "<p>Password berhasil diterima melalui POST.</p>";