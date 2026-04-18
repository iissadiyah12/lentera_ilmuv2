<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Rak</h2>

<form action="/rak/save" method="post">
Nama Rak: <input type="text" name="nama_rak"><br>
Lokasi: <input type="text" name="lokasi"><br>
<button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>