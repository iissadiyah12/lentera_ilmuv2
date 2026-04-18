<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Penerbit</h2>
<a href="/penerbit/create">Tambah</a>

<table border="1">
<tr>
<th>No</th>    
<th>Nama Penerbit</th>
<th>Alamat</th>
<th>Aksi</th>
</tr>

<?php foreach($rak as $r): ?>
<tr>
<td><?= $no++ ?></td>    
<td><?= $r['nama_penerbit'] ?></td>
<td><?= $r['alamat'] ?></td>
<td>
<a href="/penerbit/edit/<?= $r['id_penerbit'] ?>">Edit</a>
<a href="/penerbit/delete/<?= $r['id_penerbit'] ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>