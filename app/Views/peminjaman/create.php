<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Tambah Peminjaman</h3>

<form method="post" action="<?= base_url('peminjaman/store') ?>">

User ID:
<input type="number" name="id_user"><br><br>

Pilih Buku:<br>
<?php foreach ($buku as $b): ?>
    <input type="checkbox" name="buku[]" value="<?= $b['id_buku'] ?>">
    <?= $b['judul'] ?> (stok: <?= $b['jumlah'] ?>)<br>
<?php endforeach; ?>

<br>
<button type="submit">Pinjam</button>
</form>

<?= $this->endSection() ?>