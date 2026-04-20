<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Kategori</h2>

<form method="get" action="">
    <input type="text" name="keyword" placeholder="Cari..." value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Cari</button>
    <a href="<?= current_url() ?>">Reset</a>
</form>
<br>
<table border="1">
<tr>

<th>Kategori</th>
<th>Aksi</th>
</tr>

<?php foreach($kategori as $k): ?>
<tr>  
<td><?= $k['nama_kategori'] ?></td>
<td>
    <a href="<?= base_url('kategori/edit/'.$k['id_kategori']) ?>">Edit</a>
    <a href="<?= base_url('kategori/delete/'.$k['id_kategori']) ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>

</table>
<?= $this->endSection() ?>