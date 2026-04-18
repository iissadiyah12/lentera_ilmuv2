<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Penulis</h2>
<a href="/penulis/create">Tambah</a>

<table border="1">
<tr>
<th>No</th>    
<th>Nama Penulis</th>
<th>Aksi</th>
</tr>

<?php foreach($rak as $r): ?>
<tr>
<td><?= $no++ ?></td>    
<td><?= $r['nama_penulis'] ?></td>
<td>
<a href="/penulis/edit/<?= $r['id_penulis'] ?>">Edit</a>
<a href="/penulis/delete/<?= $r['id_penulis'] ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>