<?php

namespace App\Controllers;

use App\Models\ProdiModel;

class ProdiController
{
    private ProdiModel $model;

    public function __construct()
    {
        $this->model = new ProdiModel();
    }

    public function index(): void
    {
        $prodi = $this->model->all();

        require __DIR__ . '/../Views/prodi/index.php';
    }

    public function create(): void
    {
        require __DIR__ . '/../Views/prodi/create.php';
    }

    public function store(): void
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');

        if ($kode === '' || $nama === '') {
            header('Location: ' . BASE_PATH . '/prodi/create');
            exit;
        }

        $this->model->create($kode, $nama);

        header('Location: ' . BASE_PATH . '/prodi');
        exit;
    }

    public function edit(int $id): void
    {
        $prodiData = $this->model->find($id);

        if (!$prodiData) {
            http_response_code(404);
            echo '<h1>404 - Data prodi tidak ditemukan</h1>';
            return;
        }

        require __DIR__ . '/../Views/prodi/edit.php';
    }

    public function update(int $id): void
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');

        if ($kode === '' || $nama === '') {
            header('Location: ' . BASE_PATH . '/prodi/edit/' . $id);
            exit;
        }

        $this->model->update($id, $kode, $nama);

        header('Location: ' . BASE_PATH . '/prodi');
        exit;
    }

    public function destroy(int $id): void
    {
        try {

            $this->model->delete($id);

        } catch (\PDOException $e) {

            echo '<h1>Data tidak dapat dihapus</h1>';
            echo '<p>Prodi masih digunakan oleh data mahasiswa atau mata kuliah.</p>';
            echo '<a href="' . BASE_PATH . '/prodi">Kembali</a>';

            return;
        }

        header('Location: ' . BASE_PATH . '/prodi');
        exit;
    }
}