<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Buku</h2>

<form action="/buku/save" method="post" enctype="multipart/form-data">

ISBN: <input type="text" name="isbn"><br>
Judul: <input type="text" name="judul"><br>

Kategori:
<select name="id_kategori">
<?php foreach($kategori as $k): ?>
<option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
<?php endforeach; ?>
</select><br>

Penulis:
<select name="id_penulis">
<?php foreach($penulis as $p): ?>
<option value="<?= $p['id_penulis'] ?>"><?= $p['nama_penulis'] ?></option>
<?php endforeach; ?>
</select><br>

Tahun: <input type="number" name="tahun_terbit"><br>
Jumlah: <input type="number" name="jumlah"><br>

Deskripsi:<br>
<textarea name="deskripsi"></textarea><br>

Cover:
<input type="file" name="cover"><br>

<button type="submit">Simpan</button>
</form>
<?= $this->endSection() ?>