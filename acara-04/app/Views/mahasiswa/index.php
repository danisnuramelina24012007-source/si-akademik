<h1 class="mb-4">Daftar Mahasiswa</h1>

<table class="table table-bordered table-striped">

    <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Angkatan</th>
        </tr>
    </thead>

    <tbody>

        <?php $no = 1; ?>

        <?php foreach ($mahasiswa as $mhs): ?>

            <tr>
                <td><?= $no++ ?></td>

                <td>
                    <?= htmlspecialchars($mhs->getNim()) ?>
                </td>

                <td>
                    <?= htmlspecialchars($mhs->getNama()) ?>
                </td>

                <td>
                    <?= htmlspecialchars($mhs->getProdi()) ?>
                </td>

                <td>
                    <?= htmlspecialchars($mhs->getAngkatan()) ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </tbody>

</table>