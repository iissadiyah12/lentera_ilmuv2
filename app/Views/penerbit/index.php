<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Penerbit</h2>


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
<a href="/penerbit/edit/<?= $p['id_penerbit'] ?>">Edit</a>
<a href="/penerbit/delete/<?= $p['id_penerbit'] ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>