<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Data Penulis</h2>

<form method="get" action="">
    <input type="text" name="keyword" placeholder="Cari..." value="<?= $_GET['keyword'] ?? '' ?>">
    <button type="submit">Cari</button>
    <a href="<?= current_url() ?>">Reset</a>
    <a href="<?= base_url('penulis/create') ?>">Tambah</a>

</form>
<br>
<table border="1">
<tr>
    
<th>Nama Penulis</th>
<th>Aksi</th>
</tr>

<?php foreach($penulis as $p): ?>
<tr>
  
<td><?= $p['nama_penulis'] ?></td>
<td>
    <a href="<?= base_url('penulis/edit/'.$p['id_penulis']) ?>">Edit</a>
    <a href="<?= base_url('penulis/delete/'.$p['id_penulis']) ?>">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>