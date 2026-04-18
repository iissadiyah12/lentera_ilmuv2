<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Edit Buku</h3>

<form method="post" action="<?= base_url('buku/update/' . $buku['id_buku']) ?>" enctype="multipart/form-data">

    Judul:<br>
    <input type="text" name="judul" value="<?= $buku['judul'] ?>"><br><br>

    ISBN:<br>
    <input type="text" name="isbn" value="<?= $buku['isbn'] ?>"><br><br>

    <!-- KATEGORI -->
    Kategori:<br>
        <input list="list_kategori" id="kategori_input" placeholder="Pilih / ketik kategori">
        <input type="hidden" name="id_kategori" id="kategori_id">

        <datalist id="list_kategori">
        <?php foreach($kategori as $k): ?>
        <option data-id="<?= $k['id_kategori'] ?>" value="<?= $k['nama_kategori'] ?>">
        <?php endforeach; ?>
        </datalist><br><br>

    <!-- PENULIS -->
   Penulis:<br>
        <input list="list_penulis" id="penulis_input" placeholder="Pilih / ketik penulis">
        <input type="hidden" name="id_penulis" id="penulis_id">

        <datalist id="list_penulis">
        <?php foreach($penulis as $p): ?>
        <option data-id="<?= $p['id_penulis'] ?>" value="<?= $p['nama_penulis'] ?>">
        <?php endforeach; ?>
        </datalist><br><br>

    <!-- PENERBIT -->
    Penerbit:<br>
        <input list="list_penerbit" id="penerbit_input" placeholder="Pilih / ketik penerbit">
        <input type="hidden" name="id_penerbit" id="penerbit_id">

        <datalist id="list_penerbit">
        <?php foreach($penerbit as $p): ?>
        <option data-id="<?= $p['id_penerbit'] ?>" value="<?= $p['nama_penerbit'] ?>">
        <?php endforeach; ?>
        </datalist><br><br>

    <!-- RAK -->
    Rak:<br>
        <input list="list_rak" id="rak_input" placeholder="Pilih / ketik rak">
        <input type="hidden" name="id_rak" id="rak_id">

        <datalist id="list_rak">
        <?php foreach($rak as $r): ?>
        <option data-id="<?= $r['id_rak'] ?>" value="<?= $r['nama_rak'] ?>">
        <?php endforeach; ?>
        </datalist><br><br>

    Tahun:<br>
    <input type="number" name="tahun_terbit" value="<?= $buku['tahun_terbit'] ?>"><br><br>

    Jumlah:<br>
    <input type="number" name="jumlah" value="<?= $buku['jumlah'] ?>"><br><br>

    Tersedia:<br>
    <input type="number" name="tersedia" value="<?= $buku['tersedia'] ?>"><br><br>

    Deskripsi:<br>
    <textarea name="deskripsi"><?= $buku['deskripsi'] ?></textarea><br><br>

    Cover:<br>
    <input type="file" name="cover"><br><br>

    Cover Saat Ini:<br>
    <?php if ($buku['cover']): ?>
        <?php $ext = pathinfo($buku['cover'], PATHINFO_EXTENSION); ?>

        <?php if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
            <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" width="100"><br>
        <?php else: ?>
            <a href="<?= base_url('uploads/buku/' . $buku['cover']) ?>" target="_blank">Lihat File</a><br>
        <?php endif; ?>
    <?php else: ?>
        -
    <?php endif; ?>

    <br>
    <button type="submit">Update</button>
    <a href="<?= base_url('buku') ?>">Kembali</a>

</form>

<?= $this->endSection() ?>