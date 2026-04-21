<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Pengembalian</h2>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari ID Peminjaman">
    <button type="submit">Cari</button>
</form>

<a href="<?= base_url('pengembalian/create') ?>">Tambah</a>

<br><br>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nama Peminjam</th>
    <th>Tanggal Kembali</th>
    <th>Denda</th>
    <th>Aksi</th>
</tr>

<?php foreach($pengembalian as $p): ?>
<tr>
    <td><?= $p['id_pengembalian'] ?></td>
    <td><?= $p['nama'] ?></td>
    <td><?= $p['tanggal_dikembalikan'] ?></td>
    <td>Rp <?= number_format($p['denda']) ?></td>
    <td>
        <a href="<?= base_url('pengembalian/delete/'.$p['id_pengembalian']) ?>">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>