<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Pinjam Buku</h3>
<?php if (session()->getFlashdata('error')): ?>
    <div style="color:red;">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('peminjaman/store') ?>">

<!-- PILIH ANGGOTA -->
<label>Nama Peminjam</label><br>
<input type="text" value="<?= session()->get('nama') ?>" readonly>

<input type="hidden" name="id_user" value="<?= session()->get('id_user') ?>">
<br><br>

<br>

<!-- LIST BUKU -->
<div style="display:flex; flex-wrap:wrap; gap:20px;">

<?php foreach ($buku as $b): ?>
<div style="border:1px solid #ccc; padding:10px; width:180px; text-align:center;">

    <!-- COVER -->
    <?php if ($b['cover']): ?>
        <img src="<?= base_url('uploads/buku/'.$b['cover']) ?>" width="120">
    <?php else: ?>
        <div style="width:120px;height:160px;background:#eee;line-height:160px;">
            No Cover
        </div>
    <?php endif; ?>

    <br><br>

    <!-- JUDUL -->
    <b><?= $b['judul'] ?></b>

    <br>

    <!-- STOK -->
    Stok: <?= $b['jumlah'] ?>

    <br><br>

    <!-- CHECKBOX PILIH BUKU -->
    <?php if ($b['jumlah'] > 0): ?>
        <label>
            <input type="checkbox" class="pilihBuku" name="buku[]" value="<?= $b['id_buku'] ?>">
            Pilih
        </label>
    <?php else: ?>
        <span style="color:red;">Stok Habis</span>
    <?php endif; ?>

    <br><br>

    <!-- DETAIL -->
    <a href="<?= base_url('buku/detail/'.$b['id_buku']) ?>">Detail</a>

</div>
<?php endforeach; ?>

</div>
<br>
<button type="submit">Pinjam Buku</button>
<br>
<!-- PILIH METODE -->
        <label>Metode Pengambilan</label><br>
        <select name="metode" id="metode" required>
            <option value="">-- Pilih --</option>
            <option value="ambil">Ambil di Perpustakaan</option>
            <option value="antar">Kirim ke Rumah</option>
        </select>

        <br><br>

        <!-- ALAMAT -->
        <div id="alamatBox" style="display:none;">
            <label>Alamat Pengiriman</label><br>
            <textarea name="alamat" placeholder="Masukkan alamat lengkap"></textarea>
        </div>

</form>

<!-- ================= JAVASCRIPT ================= -->
<script>

// BATAS MAX 2 BUKU
let checkboxes = document.querySelectorAll('.pilihBuku');

checkboxes.forEach(cb => {
    cb.addEventListener('change', function() {
        let checked = document.querySelectorAll('.pilihBuku:checked');

        if (checked.length > 2) {
            alert('Maksimal pinjam 2 buku!');
            this.checked = false;
        }
    });
});

// TAMPILKAN ALAMAT
document.getElementById('metode').addEventListener('change', function() {
    let alamatBox = document.getElementById('alamatBox');

    if (this.value === 'antar') {
        alamatBox.style.display = 'block';
    } else {
        alamatBox.style.display = 'none';
    }
});

</script>

<?= $this->endSection() ?>