<?php

namespace App\Repositories;

use App\Models\Database;
use App\Models\Mahasiswa;
use PDO;

class MahasiswaRepository
{
    private PDO $db;

    public function __construct(Database $database)
    {
        $this->db = $database->getConnection();
    }

    public function all(): array
    {
        $stmt = $this->db->prepare("
            SELECT
                mahasiswa.id,
                mahasiswa.nim,
                mahasiswa.nama,
                mahasiswa.email,
                mahasiswa.prodi_id,
                mahasiswa.angkatan,
                mahasiswa.status,
                prodi.nama AS prodi_nama
            FROM mahasiswa
            INNER JOIN prodi
                ON mahasiswa.prodi_id = prodi.id
            ORDER BY mahasiswa.nim ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function find(int $id): ?Mahasiswa
    {
        $stmt = $this->db->prepare("
            SELECT
                id,
                nim,
                nama,
                email,
                prodi_id,
                angkatan,
                status
            FROM mahasiswa
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new Mahasiswa(
            (int) $data['id'],
            $data['nim'],
            $data['nama'],
            $data['email'],
            (int) $data['prodi_id'],
            (int) $data['angkatan'],
            $data['status']
        );
    }

    public function create(Mahasiswa $mahasiswa): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO mahasiswa
                (nim, nama, email, prodi_id, angkatan, status)
            VALUES
                (:nim, :nama, :email, :prodi_id, :angkatan, :status)
        ");

        $stmt->execute([
            'nim' => $mahasiswa->getNim(),
            'nama' => $mahasiswa->getNama(),
            'email' => $mahasiswa->getEmail(),
            'prodi_id' => $mahasiswa->getProdiId(),
            'angkatan' => $mahasiswa->getAngkatan(),
            'status' => $mahasiswa->getStatus()
        ]);
    }

    public function update(Mahasiswa $mahasiswa): void
    {
        $stmt = $this->db->prepare("
            UPDATE mahasiswa
            SET
                nim = :nim,
                nama = :nama,
                email = :email,
                prodi_id = :prodi_id,
                angkatan = :angkatan,
                status = :status
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $mahasiswa->getId(),
            'nim' => $mahasiswa->getNim(),
            'nama' => $mahasiswa->getNama(),
            'email' => $mahasiswa->getEmail(),
            'prodi_id' => $mahasiswa->getProdiId(),
            'angkatan' => $mahasiswa->getAngkatan(),
            'status' => $mahasiswa->getStatus()
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("
            DELETE FROM mahasiswa
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);
    }
}