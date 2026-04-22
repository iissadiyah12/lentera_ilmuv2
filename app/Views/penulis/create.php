<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Penulis</h2>

<form action="<?= base_url('penulis/store') ?>" method="post">
Nama Penulis: <input type="text" name="nama_penulis"><br>
<button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>