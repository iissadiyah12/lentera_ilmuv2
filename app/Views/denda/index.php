<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Denda</h3>

<?php if(session()->getFlashdata('success')): ?>
    <p style="color:green"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>Hari Terlambat</th>
    <th>Jumlah Buku</th>
    <th>Total Denda</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php foreach ($denda as $d): ?>
<tr>
    <td><?= $d['nama'] ?></td>
    <td><?= $d['hari_terlambat'] ?> hari</td>
    <td><?= $d['jumlah_buku'] ?></td>
    <td>Rp <?= number_format($d['total_denda']) ?></td>
    <td><?= $d['status_bayar'] ?></td>
    <td>

        <?php if ($d['status_bayar'] == 'belum'): ?>
        
        <!-- 💳 FORM BAYAR -->
        <form method="post" action="<?= base_url('denda/bayar/'.$d['id_denda']) ?>">
            <select name="metode" required>
                <option value="dana">DANA</option>
                <option value="gopay">GoPay</option>
                <option value="qris">QRIS</option>
            </select>

            <button type="submit">Bayar</button>
        </form>

        <?php else: ?>
            Lunas (<?= $d['metode_bayar'] ?>)
        <?php endif; ?>

    </td>
</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>