<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Kategori</h2>

<form action="<?= base_url('kategori/store') ?>" method="post">
Nama Kategori: <input type="text" name="nama_kategori"><br>
<button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>