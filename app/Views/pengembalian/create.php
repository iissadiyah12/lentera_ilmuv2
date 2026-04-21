<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Pengembalian Buku</h2>

<?php if(session()->getFlashdata('error')): ?>
<p style="color:red"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form method="post" action="<?= base_url('pengembalian/store') ?>">

Nama peminjam :<br>
<input type="text" name="nama"><br><br>

<button type="submit">Proses Pengembalian</button>

</form>

<a href="<?= base_url('pengembalian') ?>">Kembali</a>

<?= $this->endSection() ?>