<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Detail Peminjaman</h3>

<p>Total Buku Dipinjam: <b><?= $total_buku ?></b></p>

<table border="1" cellpadding="10">
<tr>
    <th>Judul Buku</th>
    <th>Cover</th>
    <th>Jumlah Dipinjam</th>
</tr>

<?php foreach ($detail as $d): ?>
<tr>
    <td><?= $d['judul'] ?></td>

    <td>
        <?php if (!empty($d['cover'])): ?>
            <img src="<?= base_url('uploads/buku/'.$d['cover']) ?>" width="80">
        <?php else: ?>
            -
        <?php endif; ?>
    </td>

    <td><?= $d['jumlah'] ?></td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>