<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Penerbit</h2>

<form method="get">
    <input type="text" name="keyword" placeholder="Cari penerbit..." value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Cari</button>
    <a href="<?= current_url() ?>">Reset</a>
</form>

<br>

<a href="<?= base_url('penerbit/create') ?>">Tambah</a>

<table border="1">
<tr>
<th>Nama Penerbit</th>
<th>Alamat</th>
<th>Aksi</th>
</tr>

<?php foreach($penerbit as $p): ?>
<tr>
<td><?= $p['nama_penerbit'] ?></td>
<td><?= $p['alamat'] ?></td>
<td>
<a href="<?= base_url('penerbit/edit/'.$p['id_penerbit']) ?>">Edit</a>
<a href="<?= base_url('penerbit/delete/'.$p['id_penerbit']) ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>