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

<table border="1" cellpadding="10" width="100%">

<div style="display:flex; flex-wrap:wrap; gap:20px;">

<?php foreach ($buku as $b): ?>

<div style="border:1px solid #ccc; padding:15px; width:200px; text-align:center; border-radius:10px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">

    <!-- COVER -->
    <?php if ($b['cover']): ?>
        <?php $ext = pathinfo($b['cover'], PATHINFO_EXTENSION); ?>

        <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
            <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>">
                <img src="<?= base_url('uploads/buku/'.$b['cover']) ?>" width="120" style="border-radius:5px;">
            </a>
        <?php else: ?>
            <img src="<?= base_url('uploads/buku/default.png') ?>" width="120">
        <?php endif; ?>
    <?php else: ?>
        -
    <?php endif; ?>

    <br><br>

    <!-- AKSI -->
    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>

        <a href="<?= base_url('buku/baca/'.$b['id_buku']) ?>" target="_blank">
            <i class="bi bi-book"></i>
        </a>

        <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>">
            <i class="bi bi-info-circle"></i>
        </a>

        <a href="<?= base_url('buku/edit/'.$b['id_buku']) ?>">
            <i class="bi bi-pencil-square"></i>
        </a>

        <a href="<?= base_url('buku/delete/'.$b['id_buku']) ?>" onclick="return confirm('Yakin hapus?')">
            <i class="bi bi-trash"></i>
        </a>

        <a href="<?= base_url('buku/wa/'.$b['id_buku']) ?>" target="_blank">
            <i class="bi bi-whatsapp"></i>
        </a>

    <?php endif; ?>

    <br><br>
    <?php if (session()->get('role') == 'anggota') : ?>

    <a href="<?= base_url('buku/baca/'.$b['id_buku']) ?>" target="_blank">
        <i class="bi bi-book"></i>
    </a>

    <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>">
        <i class="bi bi-info-circle"></i>
    </a>
    <?php endif; ?>

</div>

<?php endforeach; ?>

</div>
</table>

<?= $this->endSection() ?>