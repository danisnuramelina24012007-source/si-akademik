<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\ProdiModel;

class MahasiswaController
{
    private MahasiswaModel $model;
    private ProdiModel $prodiModel;

    public function __construct()
    {
        $this->model = new MahasiswaModel();
        $this->prodiModel = new ProdiModel();
    }

    public function index(): void
    {
        $search = trim($_GET['search'] ?? '');

        $mahasiswa = $this->model->all($search);

        require __DIR__ . '/../Views/mahasiswa/index.php';
    }

    public function create(): void
    {
        $prodi = $this->prodiModel->all();

        require __DIR__ . '/../Views/mahasiswa/create.php';
    }

    public function store(): void
    {
        $nim = trim($_POST['nim'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $prodi_id = (int)($_POST['prodi_id'] ?? 0);
        $angkatan = (int)($_POST['angkatan'] ?? date('Y'));
        $status = $_POST['status'] ?? 'aktif';

        if ($nim === '' || $nama === '' || $email === '' || $prodi_id === 0) {
            header('Location: ' . BASE_PATH . '/mahasiswa/create');
            exit;
        }

        $this->model->create(
            $nim,
            $nama,
            $email,
            $prodi_id,
            $angkatan,
            $status
        );

        header('Location: ' . BASE_PATH . '/mahasiswa');
        exit;
    }

    public function edit(int $id): void
    {
        $mahasiswa = $this->model->find($id);
        $prodi = $this->prodiModel->all();

        if (!$mahasiswa) {
            http_response_code(404);
            echo '<h1>404 - Data mahasiswa tidak ditemukan</h1>';
            return;
        }

        require __DIR__ . '/../Views/mahasiswa/edit.php';
    }

    public function update(int $id): void
    {
        $nim = trim($_POST['nim'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $prodi_id = (int)($_POST['prodi_id'] ?? 0);
        $angkatan = (int)($_POST['angkatan'] ?? date('Y'));
        $status = $_POST['status'] ?? 'aktif';

        if ($nim === '' || $nama === '' || $email === '' || $prodi_id === 0) {
            header('Location: ' . BASE_PATH . '/mahasiswa/edit/' . $id);
            exit;
        }

        $this->model->update(
            $id,
            $nim,
            $nama,
            $email,
            $prodi_id,
            $angkatan,
            $status
        );

        header('Location: ' . BASE_PATH . '/mahasiswa');
        exit;
    }

    public function destroy(int $id): void
    {
        $this->model->delete($id);

        header('Location: ' . BASE_PATH . '/mahasiswa');
        exit;
    }
}