<?php

namespace App\Models;

class Mahasiswa
{
    private int $id;
    private string $nim;
    private string $nama;
    private string $email;
    private int $prodiId;
    private int $angkatan;
    private string $status;

    public function __construct(
        int $id,
        string $nim,
        string $nama,
        string $email,
        int $prodiId,
        int $angkatan,
        string $status = 'aktif'
    ) {
        $this->id = $id;
        $this->setNim($nim);
        $this->setNama($nama);
        $this->setEmail($email);
        $this->setProdiId($prodiId);
        $this->setAngkatan($angkatan);
        $this->setStatus($status);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNim(): string
    {
        return $this->nim;
    }

    public function setNim(string $nim): void
    {
        if ($nim === '') {
            throw new \InvalidArgumentException('NIM wajib diisi.');
        }

        if (!ctype_digit($nim)) {
            throw new \InvalidArgumentException('NIM harus berupa angka.');
        }

        $this->nim = $nim;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function setNama(string $nama): void
    {
        if (trim($nama) === '') {
            throw new \InvalidArgumentException('Nama wajib diisi.');
        }

        $this->nama = $nama;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Format email tidak valid.');
        }

        $this->email = $email;
    }

    public function getProdiId(): int
    {
        return $this->prodiId;
    }

    public function setProdiId(int $prodiId): void
    {
        if ($prodiId <= 0) {
            throw new \InvalidArgumentException('Program studi wajib dipilih.');
        }

        $this->prodiId = $prodiId;
    }

    public function getAngkatan(): int
    {
        return $this->angkatan;
    }

    public function setAngkatan(int $angkatan): void
    {
        if ($angkatan <= 0) {
            throw new \InvalidArgumentException('Angkatan wajib diisi.');
        }

        $this->angkatan = $angkatan;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $allowed = ['aktif', 'cuti', 'lulus'];

        if (!in_array($status, $allowed, true)) {
            throw new \InvalidArgumentException('Status tidak valid.');
        }

        $this->status = $status;
    }
}