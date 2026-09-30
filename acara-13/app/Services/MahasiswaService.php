<?php

namespace App\Services;

use App\Models\Mahasiswa;
use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;

class MahasiswaService
{
    public function __construct(
        private MahasiswaRepository $repo,
        private ProdiRepository $prodiRepo
    ) {
    }

    public function create(array $input): array
    {
        $errors = $this->validate($input);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $mahasiswa = new Mahasiswa(
            0,
            trim($input['nim']),
            trim($input['nama']),
            trim($input['email']),
            (int) $input['prodi_id'],
            (int) $input['angkatan'],
            $input['status'] ?? 'aktif'
        );

        $id = $this->repo->create($mahasiswa);

        return [
            'success' => true,
            'id' => $id
        ];
    }

    public function update(int $id, array $input): array
    {
        $errors = $this->validate($input, $id);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $mahasiswa = new Mahasiswa(
            $id,
            trim($input['nim']),
            trim($input['nama']),
            trim($input['email']),
            (int) $input['prodi_id'],
            (int) $input['angkatan'],
            $input['status'] ?? 'aktif'
        );

        $this->repo->update($mahasiswa);

        return [
            'success' => true,
            'id' => $id
        ];
    }

    private function validate(array $input, ?int $id = null): array
    {
        $errors = [];

        $nim = trim($input['nim'] ?? '');
        $nama = trim($input['nama'] ?? '');
        $email = trim($input['email'] ?? '');
        $prodiId = (int) ($input['prodi_id'] ?? 0);
        $angkatan = (int) ($input['angkatan'] ?? 0);

        if ($nim === '') {
            $errors['nim'] = 'NIM wajib diisi';
        } elseif (!ctype_digit($nim)) {
            $errors['nim'] = 'NIM harus berupa angka';
        } elseif ($this->repo->existsByNim($nim, $id)) {
            $errors['nim'] = 'NIM sudah terdaftar';
        }

        if ($nama === '') {
            $errors['nama'] = 'Nama wajib diisi';
        }

        if ($email === '') {
            $errors['email'] = 'Email wajib diisi';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Format email tidak valid';
        }

        if ($prodiId <= 0 || !$this->prodiRepo->exists($prodiId)) {
            $errors['prodi_id'] = 'Program studi tidak tersedia';
        }

        if ($angkatan <= 0) {
            $errors['angkatan'] = 'Angkatan wajib diisi';
        }

        return $errors;
    }
}