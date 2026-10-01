<?php

namespace App\Controllers;

use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
use App\Services\MahasiswaService;
use Throwable;

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

        $this->view(
            'mahasiswa/index',
            [
                'mahasiswa' => $mahasiswa,
                'flash' => $flash,
            ]
        );
    }

    public function create(): void
    {
        $prodi = $this->prodiRepo->all();

        $flash = $this->getFlash();

        $this->view(
            'mahasiswa/create',
            [
                'prodi' => $prodi,
                'flash' => $flash,
            ]
        );
    }

    public function store(): void
    {
        try {
            $this->service->create($_POST);

            $this->setFlash(
                'success',
                'Data mahasiswa berhasil ditambahkan.'
            );
        } catch (Throwable $e) {

            $this->logError($e);

            if (
                $e->getMessage() ===
                'NIM sudah terdaftar.'
            ) {
                $message = 'NIM sudah terdaftar.';
            } else {
                $message = 'Data gagal disimpan.';
            }

            $this->setFlash(
                'danger',
                $message
            );
        }

        $this->redirect(
            BASE_PATH . '/mahasiswa'
        );
    }

    public function edit(int $id): void
    {
        $mahasiswa = $this->mahasiswaRepo->find($id);

        if ($mahasiswa === null) {

            $this->setFlash(
                'danger',
                'Data mahasiswa tidak ditemukan.'
            );

            $this->redirect(
                BASE_PATH . '/mahasiswa'
            );
        }

        $prodi = $this->prodiRepo->all();

        $flash = $this->getFlash();

        $this->view(
            'mahasiswa/edit',
            [
                'mahasiswa' => $mahasiswa,
                'prodi' => $prodi,
                'flash' => $flash,
            ]
        );
    }

    public function update(int $id): void
    {
        try {
            $this->service->update(
                $id,
                $_POST
            );

            $this->setFlash(
                'success',
                'Data mahasiswa berhasil diubah.'
            );
        } catch (Throwable $e) {

            $this->logError($e);

            if (
                $e->getMessage() ===
                'NIM sudah terdaftar.'
            ) {
                $message = 'NIM sudah terdaftar.';
            } else {
                $message = 'Data gagal disimpan.';
            }

            $this->setFlash(
                'danger',
                $message
            );
        }

        $this->redirect(
            BASE_PATH . '/mahasiswa'
        );
    }

    public function delete(int $id): void
    {
        try {
            $this->service->delete($id);

            $this->setFlash(
                'success',
                'Data mahasiswa berhasil dihapus.'
            );
        } catch (Throwable $e) {

            $this->logError($e);

            $this->setFlash(
                'danger',
                'Data gagal disimpan.'
            );
        }

        $this->redirect(
            BASE_PATH . '/mahasiswa'
        );
    }

    private function logError(Throwable $e): void
    {
        $logDirectory =
            __DIR__ . '/../../storage/logs';

        $logFile =
            $logDirectory . '/app.log';

        if (!is_dir($logDirectory)) {
            mkdir(
                $logDirectory,
                0777,
                true
            );
        }

        error_log(
            date('Y-m-d H:i:s') .
            ' - ' .
            $e->getMessage() .
            PHP_EOL,
            3,
            $logFile
        );
    }
}