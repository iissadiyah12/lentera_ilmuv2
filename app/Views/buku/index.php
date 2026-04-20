<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Buku</h3>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari judul">
    <form enctype="multipart/form-data">
    <button type="submit">Cari</button>
     <a href="<?= base_url('buku') ?>">Reset</a>
</form>

<a href="<?= base_url('buku/create') ?>">Tambah</a>
<a href="<?= base_url('buku/print') ?>" target="_blank">Print</a>

<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>Cover</th>
    <th>Aksi</th>
</tr>

<?php foreach ($buku as $b): ?>
<tr>

    <!-- COVER -->
    <td>
        <?php if ($b['cover']): ?>
            <?php $ext = pathinfo($b['cover'], PATHINFO_EXTENSION); ?>

            <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                
                <!-- Klik cover → ke detail -->
                <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>">
                    <img src="<?= base_url('uploads/buku/'.$b['cover']) ?>" width="150">
                </a>

            <?php else: ?>
                <img src="<?= base_url('uploads/buku/default.png') ?>" width="120">
            <?php endif; ?>

        <?php else: ?>
            -
        <?php endif; ?>
    </td>

    <!-- AKSI -->
    <td>
        <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>">Detail</a> |
        <a href="<?= base_url('buku/edit/'.$b['id_buku']) ?>">Edit</a> |
        <a href="<?= base_url('buku/delete/'.$b['id_buku']) ?>" onclick="return confirm('Yakin hapus?')">Hapus</a> |
        <a href="<?= base_url('buku/wa/'.$b['id_buku']) ?>" target="_blank">WA</a>
    </td>

</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>