<?php

$method = $_SERVER['REQUEST_METHOD'];

echo "<h1>Deteksi Method Request</h1>";

if ($method === 'GET') {
    echo "<p>Request yang diterima menggunakan method GET.</p>";
} elseif ($method === 'POST') {
    echo "<p>Request yang diterima menggunakan method POST.</p>";
} else {
    echo "<p>Request menggunakan method: " . htmlspecialchars($method) . "</p>";
}