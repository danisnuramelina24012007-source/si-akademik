<?php

namespace App\Models;

class Mahasiswa
{
    private int $id;
    private string $nim;
    private string $nama;
    private string $email;
    private int $prodi_id;
    private int $angkatan;
    private string $status;

    public function __construct(
        int $id = 0,
        string $nim = '',
        string $nama = '',
        string $email = '',
        int $prodi_id = 0,
        int $angkatan = 0,
        string $status = 'aktif'
    ) {
        $this->id = $id;
        $this->setNim($nim);
        $this->setNama($nama);
        $this->setEmail($email);
        $this->setProdiId($prodi_id);
        $this->setAngkatan($angkatan);
        $this->setStatus($status);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNim(): string
    {
        return $this->nim;
    }

    public function setNim(string $nim): void
    {
        if ($nim !== '' && !ctype_digit($nim)) {
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
        $nama = trim($nama);

        if ($nama === '') {
            throw new \InvalidArgumentException('Nama mahasiswa tidak boleh kosong.');
        }

        $this->nama = $nama;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = trim($email);
    }

    public function getProdiId(): int
    {
        return $this->prodi_id;
    }

    public function setProdiId(int $prodi_id): void
    {
        $this->prodi_id = $prodi_id;
    }

    public function getAngkatan(): int
    {
        return $this->angkatan;
    }

    public function setAngkatan(int $angkatan): void
    {
        $this->angkatan = $angkatan;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $allowedStatus = ['aktif', 'cuti', 'lulus'];

        if (!in_array($status, $allowedStatus, true)) {
            throw new \InvalidArgumentException('Status mahasiswa tidak valid.');
        }

        $this->status = $status;
    }
}