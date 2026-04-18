<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Penerbit</h2>

<form action="/penerbit/update/<?= $rak['id_penerbit'] ?>" method="post">
Nama Penerbit: <input type="text" name="nama_penerbit" value="<?= $rak['nama_penerbit'] ?>"><br>
Nama Alamat: <input type="text" name="alamat" value="<?= $rak['alamat'] ?>"><br>
<button type="submit">Update</button>
</form>
<?= $this->endSection() ?>