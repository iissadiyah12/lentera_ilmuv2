<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Rak</h2>

<form action="/rak/update/<?= $rak['id_rak'] ?>" method="post">
Nama Rak: <input type="text" name="nama_rak" value="<?= $rak['nama_rak'] ?>"><br>
Lokasi: <input type="text" name="lokasi" value="<?= $rak['lokasi'] ?>"><br>
<button type="submit">Update</button>
</form>
<?= $this->endSection() ?>