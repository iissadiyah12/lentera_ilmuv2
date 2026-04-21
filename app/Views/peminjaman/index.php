<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h3>Data Peminjaman</h3>

<?php if (session()->get('role') == 'anggota') : ?>
<a href="<?= base_url('peminjaman/create') ?>">Tambah</a>
 <?php endif; ?>
<table border="1">
<tr>
    <th>Anggota</th>
    <th>Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php foreach ($peminjaman as $p): ?>
<tr>
    <td><?= $p['nama'] ?></td>
    <td><?= $p['judul'] ?></td>
    <td><?= $p['tanggal_pinjam'] ?></td>
    <td><?= $p['tanggal_kembali'] ?></td>
    <script>
    function perpanjang(id) {
    let hari = prompt("Masukkan jumlah hari perpanjangan:");

    if (hari != null && hari != "") {
        window.location.href = "<?= base_url('peminjaman/perpanjang/') ?>" + id + "/" + hari;
    }
}
</script>
    <td><?= $p['status'] ?></td>
    <td>
        <a href="<?= base_url('peminjaman/edit/'.$p['id_peminjaman']) ?>">Edit</a>
        <a href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>">Hapus</a>
        <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">Detail</a>
        <a href="#" onclick="perpanjang(<?= $p['id_peminjaman'] ?>)">Perpanjang</a>
        
    </td>
</tr>
<?php endforeach; ?>
</table>
<?= $this->endSection() ?>