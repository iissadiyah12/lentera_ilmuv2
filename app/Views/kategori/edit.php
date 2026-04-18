<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Kategori</h2>

<form action="/kategori/update/<?= $rak['id_kategori'] ?>" method="post">
Nama Kategori: 
<input type="text" name="nama_kategori" value="<?= $rak['nama_kategori'] ?>"><br>
<button type="submit">Update</button>
</form>
<?= $this->endSection() ?>