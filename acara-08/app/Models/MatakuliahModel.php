<?php

namespace App\Models;

use PDO;

class MatakuliahModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        $stmt = $this->db->prepare("
            SELECT
                matakuliah.*,
                prodi.nama AS prodi_nama
            FROM matakuliah
            INNER JOIN prodi
                ON matakuliah.prodi_id = prodi.id
            ORDER BY matakuliah.kode ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM matakuliah
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function create(
        string $kode,
        string $nama,
        int $sks,
        int $prodi_id
    ): void {
        $stmt = $this->db->prepare("
            INSERT INTO matakuliah
                (kode, nama, sks, prodi_id)
            VALUES
                (:kode, :nama, :sks, :prodi_id)
        ");

        $stmt->execute([
            'kode' => $kode,
            'nama' => $nama,
            'sks' => $sks,
            'prodi_id' => $prodi_id
        ]);
    }

    public function update(
        int $id,
        string $kode,
        string $nama,
        int $sks,
        int $prodi_id
    ): void {
        $stmt = $this->db->prepare("
            UPDATE matakuliah
            SET
                kode = :kode,
                nama = :nama,
                sks = :sks,
                prodi_id = :prodi_id
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
            'kode' => $kode,
            'nama' => $nama,
            'sks' => $sks,
            'prodi_id' => $prodi_id
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("
            DELETE FROM matakuliah
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);
    }
}