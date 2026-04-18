<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Penulis</h2>

<form action="/penulis/update/<?= $rak['id_penulis'] ?>" method="post">
Nama Penulis: <input type="text" name="nama_penulis" value="<?= $rak['nama_penulis'] ?>"><br>
<button type="submit">Update</button>
</form>
<?= $this->endSection() ?>