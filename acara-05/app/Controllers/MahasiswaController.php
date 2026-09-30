<?php

namespace App\Controllers;

class MahasiswaController
{
    public function index()
    {
        echo "<h1>Data Mahasiswa</h1>";
        echo "<p>Halaman daftar mahasiswa.</p>";
    }

    public function create()
    {
        echo "<h1>Tambah Mahasiswa</h1>";
        echo "<p>Halaman untuk menambahkan mahasiswa.</p>";
    }

    public function show($id)
    {
        echo "<h1>Detail Mahasiswa</h1>";
        echo "<p>ID Mahasiswa: " . htmlspecialchars($id) . "</p>";
    }
}