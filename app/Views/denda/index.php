<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Denda</h3>

<!-- SEARCH -->
<form method="get">
    <input type="text" name="keyword" placeholder="Cari ID Pengembalian">
    <button type="submit">Cari</button>
</form>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>ID Pengembalian</th>
        <th>Hari Terlambat</th>
        <th>Total Denda</th>
        <th>Status</th>
        <th>Metode</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($denda as $d): ?>
    <tr>
        <td><?= $d['id_denda'] ?></td>
        <td><?= $d['id_pengembalian'] ?></td>
        <td><?= $d['hari_terlambat'] ?></td>
        <td>Rp <?= number_format($d['total_denda']) ?></td>
        <td><?= $d['status_bayar'] ?></td>
        <td><?= $d['metode_bayar'] ?></td>

        <td>
            <!-- UPDATE -->
            <form method="post" action="/denda/update/<?= $d['id_denda'] ?>">
                <select name="status_bayar">
                    <option value="belum">Belum</option>
                    <option value="lunas">Lunas</option>
                </select>

                <select name="metode_bayar">
                    <option value="cash">Cash</option>
                    <option value="dana">Dana</option>
                    <option value="qris">QRIS</option>
                </select>

                <button type="submit">Update</button>
            </form>

            <!-- DELETE -->
            <a href="/denda/delete/<?= $d['id_denda'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>

<?= $this->endSection() ?>