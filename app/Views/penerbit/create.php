<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Penerbit</h2>

<form action="/penerbit/save" method="post">
Nama Penerbit: <input type="text" name="nama_penerbit"><br>
Alamat: <input type="text" name="alamat"><br>
<button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>