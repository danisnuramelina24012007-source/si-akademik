<?php

namespace App\Services;

use App\Models\Mahasiswa;
use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
use InvalidArgumentException;

class MahasiswaService
{
    public function __construct(
        private MahasiswaRepository $repo,
        private ProdiRepository $prodiRepo
    ) {
    }

    public function create(array $input): int
    {
        $this->validate($input);

        $mahasiswa = new Mahasiswa(
            0,
            trim($input['nim']),
            trim($input['nama']),
            trim($input['email']),
            (int) $input['prodi_id'],
            (int) $input['angkatan'],
            $input['status'] ?? 'aktif'
        );

        return $this->repo->create($mahasiswa);
    }

    public function update(int $id, array $input): void
    {
        $this->validate($input, $id);

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
    }

    public function delete(int $id): void
    {
        $mahasiswa = $this->repo->find($id);

        if ($mahasiswa === null) {
            throw new InvalidArgumentException(
                'Data mahasiswa tidak ditemukan.'
            );
        }

        $this->repo->delete($id);
    }

    private function validate(
        array $input,
        ?int $excludeId = null
    ): void {
        $nim = trim($input['nim'] ?? '');
        $nama = trim($input['nama'] ?? '');
        $email = trim($input['email'] ?? '');
        $prodiId = (int) ($input['prodi_id'] ?? 0);
        $angkatan = (int) ($input['angkatan'] ?? 0);
        $status = $input['status'] ?? 'aktif';

        if ($nim === '') {
            throw new InvalidArgumentException(
                'NIM wajib diisi.'
            );
        }

        if (!ctype_digit($nim)) {
            throw new InvalidArgumentException(
                'NIM harus berupa angka.'
            );
        }

        if ($this->repo->existsByNim($nim, $excludeId)) {
            throw new InvalidArgumentException(
                'NIM sudah terdaftar.'
            );
        }

        if ($nama === '') {
            throw new InvalidArgumentException(
                'Nama wajib diisi.'
            );
        }

        if ($email === '') {
            throw new InvalidArgumentException(
                'Email wajib diisi.'
            );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                'Format email tidak valid.'
            );
        }

        if (
            $prodiId <= 0 ||
            !$this->prodiRepo->exists($prodiId)
        ) {
            throw new InvalidArgumentException(
                'Program studi tidak tersedia.'
            );
        }

        if ($angkatan <= 0) {
            throw new InvalidArgumentException(
                'Angkatan wajib diisi.'
            );
        }

        $allowedStatus = [
            'aktif',
            'cuti',
            'lulus'
        ];

        if (!in_array($status, $allowedStatus, true)) {
            throw new InvalidArgumentException(
                'Status tidak valid.'
            );
        }
    }
}