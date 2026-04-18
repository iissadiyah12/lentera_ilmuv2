<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Kategori</h2>


<table border="1">
<tr>

<th>Kategori</th>
<th>Aksi</th>
</tr>

<?php foreach($kategori as $k): ?>
<tr>  
<td><?= $k['nama_kategori'] ?></td>
<td>
<a href="/kategori/edit/<?= $k['id_kategori'] ?>">Edit</a>
<a href="/kategori/delete/<?= $k['id_kategori'] ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>