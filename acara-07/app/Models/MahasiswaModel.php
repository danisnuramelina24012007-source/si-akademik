<?php

namespace App\Models;

class MahasiswaModel extends Model
{
    public function all(): array
    {
        $query = "
            SELECT
                mahasiswa.id,
                mahasiswa.nim,
                mahasiswa.nama,
                mahasiswa.email,
                mahasiswa.angkatan,
                mahasiswa.status,
                prodi.nama AS prodi
            FROM mahasiswa
            INNER JOIN prodi
                ON mahasiswa.prodi_id = prodi.id
            ORDER BY mahasiswa.id ASC
        ";

        $stmt = $this->db->query($query);

        return $stmt->fetchAll();
    }
}