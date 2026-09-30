<?php

namespace App\Models;

use PDO;

class MahasiswaModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(string $search = ''): array
    {
        $sql = "
            SELECT
                mahasiswa.id,
                mahasiswa.nim,
                mahasiswa.nama,
                mahasiswa.email,
                mahasiswa.angkatan,
                mahasiswa.status,
                mahasiswa.prodi_id,
                prodi.nama AS prodi_nama
            FROM mahasiswa
            INNER JOIN prodi
                ON mahasiswa.prodi_id = prodi.id
        ";

        if ($search !== '') {

            $sql .= "
                WHERE mahasiswa.nama LIKE :search_nama
                OR mahasiswa.nim LIKE :search_nim
            ";
        }

        $sql .= " ORDER BY mahasiswa.nim ASC";

        $stmt = $this->db->prepare($sql);

        if ($search !== '') {

            $keyword = '%' . $search . '%';

            $stmt->execute([
                'search_nama' => $keyword,
                'search_nim' => $keyword
            ]);

        } else {

            $stmt->execute();
        }

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM mahasiswa
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function create(
        string $nim,
        string $nama,
        string $email,
        int $prodi_id,
        int $angkatan,
        string $status
    ): void {
        $stmt = $this->db->prepare("
            INSERT INTO mahasiswa
                (nim, nama, email, prodi_id, angkatan, status)
            VALUES
                (:nim, :nama, :email, :prodi_id, :angkatan, :status)
        ");

        $stmt->execute([
            'nim' => $nim,
            'nama' => $nama,
            'email' => $email,
            'prodi_id' => $prodi_id,
            'angkatan' => $angkatan,
            'status' => $status
        ]);
    }

    public function update(
        int $id,
        string $nim,
        string $nama,
        string $email,
        int $prodi_id,
        int $angkatan,
        string $status
    ): void {
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
            'id' => $id,
            'nim' => $nim,
            'nama' => $nama,
            'email' => $email,
            'prodi_id' => $prodi_id,
            'angkatan' => $angkatan,
            'status' => $status
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