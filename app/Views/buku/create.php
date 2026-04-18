<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h2>Tambah Buku</h2>

<form action="/buku/save" method="post" enctype="multipart/form-data">

ISBN: <input type="text" name="isbn"><br>
Judul: <input type="text" name="judul"><br>

Kategori:
<input list="list_kategori" name="kategori_nama">

<datalist id="list_kategori">
<?php foreach($kategori as $k): ?>
<option value="<?= $k['nama_kategori'] ?>">
<?php endforeach; ?>
</datalist>

Penulis:
<input list="list_penulis" name="penulis_nama">

<datalist id="list_penulis">
<?php foreach($penulis as $p): ?>
<option value="<?= $p['nama_penulis'] ?>">
<?php endforeach; ?>
</datalist>

Penerbit:
<input list="list_penerbit" name="penerbit_nama">
<datalist id="list_penerbit">
<?php foreach($penerbit as $p): ?>
<option value="<?= $p['nama_penerbit'] ?>">
<?php endforeach; ?>
</datalist>

Rak:
<input list="list_rak" name="rak_nama">

<datalist id="list_rak">
<?php foreach($rak as $r): ?>
<option value="<?= $r['nama_rak'] ?>">
<?php endforeach; ?>
</datalist>

Tahun: <input type="number" name="tahun_terbit"><br>
Jumlah: <input type="number" name="jumlah"><br>

Deskripsi:<br>
<textarea name="deskripsi"></textarea><br>

Cover:
<input type="file" name="cover"><br>

<button type="submit">Simpan</button>
</form>
<?= $this->endSection() ?>