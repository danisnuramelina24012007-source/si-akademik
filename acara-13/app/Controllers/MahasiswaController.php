<?php

namespace App\Controllers;

use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
use App\Services\MahasiswaService;

class MahasiswaController extends BaseController
{
    public function __construct(
        private MahasiswaService $service,
        private MahasiswaRepository $mahasiswaRepo,
        private ProdiRepository $prodiRepo
    ) {
    }

    public function index(): void
    {
        $mahasiswa = $this->mahasiswaRepo->all();
        $flash = $this->getFlash();

        $this->view('mahasiswa/index', [
            'mahasiswa' => $mahasiswa,
            'flash' => $flash,
        ]);
    }

    public function create(): void
    {
        $prodi = $this->prodiRepo->all();
        $flash = $this->getFlash();

        $this->view('mahasiswa/create', [
            'prodi' => $prodi,
            'flash' => $flash,
        ]);
    }

    public function store(): void
    {
        try {
            $result = $this->service->create($_POST);

            if (!$result['success']) {
                $message = $this->getValidationMessage($result['errors']);

                $this->setFlash('danger', $message);
                $this->redirect(BASE_PATH . '/mahasiswa/create');
            }

            $this->setFlash(
                'success',
                'Data berhasil ditambahkan.'
            );

            $this->redirect(BASE_PATH . '/mahasiswa');
        } catch (\Throwable $e) {
            $this->setFlash(
                'danger',
                'Data gagal disimpan.'
            );

            $this->redirect(BASE_PATH . '/mahasiswa/create');
        }
    }

    public function edit(int $id): void
    {
        $mahasiswa = $this->mahasiswaRepo->find($id);

        if ($mahasiswa === null) {
            $this->setFlash(
                'danger',
                'Data mahasiswa tidak ditemukan.'
            );

            $this->redirect(BASE_PATH . '/mahasiswa');
        }

        $prodi = $this->prodiRepo->all();
        $flash = $this->getFlash();

        $this->view('mahasiswa/edit', [
            'mahasiswa' => $mahasiswa,
            'prodi' => $prodi,
            'flash' => $flash,
        ]);
    }

    public function update(int $id): void
    {
        try {
            $result = $this->service->update($id, $_POST);

            if (!$result['success']) {
                $message = $this->getValidationMessage($result['errors']);

                $this->setFlash('danger', $message);
                $this->redirect(BASE_PATH . '/mahasiswa/edit/' . $id);
            }

            $this->setFlash(
                'success',
                'Data berhasil diubah.'
            );

            $this->redirect(BASE_PATH . '/mahasiswa');
        } catch (\Throwable $e) {
            $this->setFlash(
                'danger',
                'Data gagal disimpan.'
            );

            $this->redirect(BASE_PATH . '/mahasiswa/edit/' . $id);
        }
    }

    private function getValidationMessage(array $errors): string
    {
        if (
            isset($errors['nim']) &&
            $errors['nim'] === 'NIM sudah terdaftar'
        ) {
            return 'NIM sudah terdaftar.';
        }

        return 'Data gagal disimpan.';
    }
}