<?php

$keyword = $_GET['keyword'] ?? '';

echo "<h1>Hasil Pencarian</h1>";
echo "<p>Anda mencari: " . htmlspecialchars($keyword) . "</p>";