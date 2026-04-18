<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Kategori</h2>
<a href="/rak/create">Tambah</a>

<table border="1">
<tr>
<th>No</th>    
<th>Kategori</th>
<th>Aksi</th>
</tr>

<?php foreach($rak as $r): ?>
<tr>
<td><?= $no++ ?></td>    
<td><?= $r['nama_kategori'] ?></td>
<td>
<a href="/rak/edit/<?= $r['id_rak'] ?>">Edit</a>
<a href="/rak/delete/<?= $r['id_rak'] ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>