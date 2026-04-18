<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Penulis</h2>


<table border="1">
<tr>
    
<th>Nama Penulis</th>
<th>Aksi</th>
</tr>

<?php foreach($penulis as $p): ?>
<tr>
  
<td><?= $p['nama_penulis'] ?></td>
<td>
<a href="/penulis/edit/<?= $p['id_penulis'] ?>">Edit</a>
<a href="/penulis/delete/<?= $p['id_penulis'] ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>