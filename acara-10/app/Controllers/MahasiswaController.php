<?php

namespace App\Controllers;

use App\Models\Mahasiswa;
use App\Repositories\MahasiswaRepository;

class MahasiswaController extends BaseController
{
    private MahasiswaRepository $repo;

    public function __construct(MahasiswaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(): void
    {
        $mahasiswa = $this->repo->all();

        $this->view('mahasiswa/index', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function create(): void
    {
        $this->view('mahasiswa/create');
    }

    public function store(): void
    {
        try {
            $mahasiswa = new Mahasiswa(
                0,
                trim($_POST['nim'] ?? ''),
                trim($_POST['nama'] ?? ''),
                trim($_POST['email'] ?? ''),
                (int) ($_POST['prodi_id'] ?? 0),
                (int) ($_POST['angkatan'] ?? date('Y')),
                $_POST['status'] ?? 'aktif'
            );

            $this->repo->create($mahasiswa);

            $this->redirect(BASE_PATH . '/mahasiswa');

        } catch (\InvalidArgumentException $e) {

            echo '<h1>Data tidak valid</h1>';
            echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '<a href="' . BASE_PATH . '/mahasiswa/create">Kembali</a>';
        }
    }

    public function edit(int $id): void
    {
        $mahasiswa = $this->repo->find($id);

        if (!$mahasiswa) {
            http_response_code(404);

            echo '<h1>404 - Data mahasiswa tidak ditemukan</h1>';

            return;
        }

        $this->view('mahasiswa/edit', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function update(int $id): void
    {
        try {
            $mahasiswa = new Mahasiswa(
                $id,
                trim($_POST['nim'] ?? ''),
                trim($_POST['nama'] ?? ''),
                trim($_POST['email'] ?? ''),
                (int) ($_POST['prodi_id'] ?? 0),
                (int) ($_POST['angkatan'] ?? date('Y')),
                $_POST['status'] ?? 'aktif'
            );

            $this->repo->update($mahasiswa);

            $this->redirect(BASE_PATH . '/mahasiswa');

        } catch (\InvalidArgumentException $e) {

            echo '<h1>Data tidak valid</h1>';
            echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '<a href="' . BASE_PATH . '/mahasiswa/edit/' . $id . '">Kembali</a>';
        }
    }

    public function destroy(int $id): void
    {
        $this->repo->delete($id);

        $this->redirect(BASE_PATH . '/mahasiswa');
    }
}