<h2>Edit Petugas</h2>

<form method="post" action="<?= base_url('petugas/update/'.$petugas['id_petugas']) ?>">

Jabatan:<br>
<input type="text" name="jabatan" value="<?= $petugas['jabatan'] ?>"><br><br>

<button type="submit">Update</button>
<a href="<?= base_url('petugas') ?>">Kembali</a>

</form>