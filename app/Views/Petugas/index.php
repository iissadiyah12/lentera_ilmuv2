<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Petugas</h2>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari Jabatan">
    <button type="submit">Cari</button>
</form>

<br>
<a href="<?= base_url('petugas/create') ?>">Tambah Petugas</a>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Jabatan</th>
    <th>Aksi</th>
</tr>

<?php foreach($petugas as $p): ?>
<tr>
    <td><?= $p['id_petugas'] ?></td>
    <td><?= $p['jabatan'] ?></td>
    <td>
        <a href="<?= base_url('petugas/edit/'.$p['id_petugas']) ?>">Edit</a>
        <a href="<?= base_url('petugas/delete/'.$p['id_petugas']) ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>