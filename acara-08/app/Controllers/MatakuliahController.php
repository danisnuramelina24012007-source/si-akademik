<?php

namespace App\Controllers;

use App\Models\MatakuliahModel;
use App\Models\ProdiModel;

class MatakuliahController
{
    private MatakuliahModel $model;
    private ProdiModel $prodiModel;

    public function __construct()
    {
        $this->model = new MatakuliahModel();
        $this->prodiModel = new ProdiModel();
    }

    public function index(): void
    {
        $matakuliah = $this->model->all();

        require __DIR__ . '/../Views/matakuliah/index.php';
    }

    public function create(): void
    {
        $prodi = $this->prodiModel->all();

        require __DIR__ . '/../Views/matakuliah/create.php';
    }

    public function store(): void
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $sks = (int)($_POST['sks'] ?? 0);
        $prodi_id = (int)($_POST['prodi_id'] ?? 0);

        if ($kode === '' || $nama === '' || $sks === 0 || $prodi_id === 0) {
            header('Location: ' . BASE_PATH . '/matakuliah/create');
            exit;
        }

        $this->model->create(
            $kode,
            $nama,
            $sks,
            $prodi_id
        );

        header('Location: ' . BASE_PATH . '/matakuliah');
        exit;
    }

    public function edit(int $id): void
    {
        $matakuliahData = $this->model->find($id);
        $prodi = $this->prodiModel->all();

        if (!$matakuliahData) {
            http_response_code(404);
            echo '<h1>404 - Data mata kuliah tidak ditemukan</h1>';
            return;
        }

        require __DIR__ . '/../Views/matakuliah/edit.php';
    }

    public function update(int $id): void
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $sks = (int)($_POST['sks'] ?? 0);
        $prodi_id = (int)($_POST['prodi_id'] ?? 0);

        if ($kode === '' || $nama === '' || $sks === 0 || $prodi_id === 0) {
            header('Location: ' . BASE_PATH . '/matakuliah/edit/' . $id);
            exit;
        }

        $this->model->update(
            $id,
            $kode,
            $nama,
            $sks,
            $prodi_id
        );

        header('Location: ' . BASE_PATH . '/matakuliah');
        exit;
    }

    public function destroy(int $id): void
    {
        $this->model->delete($id);

        header('Location: ' . BASE_PATH . '/matakuliah');
        exit;
    }
}