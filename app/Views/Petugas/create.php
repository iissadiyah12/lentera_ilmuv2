<h2>Tambah Petugas</h2>

<form method="post" action="<?= base_url('petugas/store') ?>">

Jabatan:<br>
<input type="text" name="jabatan"><br><br>

<button type="submit">Simpan</button>
<a href="<?= base_url('petugas') ?>">Kembali</a>

</form>