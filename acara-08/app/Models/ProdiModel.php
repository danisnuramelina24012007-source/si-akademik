<?php

namespace App\Models;

use PDO;

class ProdiModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM prodi
            ORDER BY kode ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM prodi
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function create(string $kode, string $nama): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO prodi (kode, nama)
            VALUES (:kode, :nama)
        ");

        $stmt->execute([
            'kode' => $kode,
            'nama' => $nama
        ]);
    }

    public function update(int $id, string $kode, string $nama): void
    {
        $stmt = $this->db->prepare("
            UPDATE prodi
            SET
                kode = :kode,
                nama = :nama
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id,
            'kode' => $kode,
            'nama' => $nama
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("
            DELETE FROM prodi
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);
    }
}