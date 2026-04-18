<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Rak</h2>


<table border="1">
<tr>
  
<th>Nama Rak</th>
<th>Lokasi</th>
<th>Aksi</th>
</tr>

<?php foreach($rak as $r): ?>
<tr>
  
<td><?= $r['nama_rak'] ?></td>
<td><?= $r['lokasi'] ?></td>
<td>
<a href="/rak/edit/<?= $r['id_rak'] ?>">Edit</a>
<a href="/rak/delete/<?= $r['id_rak'] ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>