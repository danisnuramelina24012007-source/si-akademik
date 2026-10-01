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
        $this->nim = $nim;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function setNama(string $nama): void
    {
        $this->nama = $nama;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getProdiId(): int
    {
        return $this->prodiId;
    }

    public function setProdiId(int $prodiId): void
    {
        $this->prodiId = $prodiId;
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
        $this->status = $status;
    }
}