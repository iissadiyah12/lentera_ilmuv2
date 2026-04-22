<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Penerbit</h2>

<form action="<?= base_url('penerbit/store') ?>" method="post">
    Nama Penerbit: <input type="text" name="nama_penerbit"><br><br>
    Alamat: <input type="text" name="alamat"><br><br>
<button type="submit">Simpan</button>
</form>

<?= $this->endSection() ?>