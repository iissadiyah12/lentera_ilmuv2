<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Detail Peminjaman</h2>

<table border="1" cellpadding="10">

<tr>
    <td>Anggota</td>
    <td><?= $peminjaman['nama_anggota'] ?? '-' ?></td>
</tr>

<tr>
    <td>Petugas</td>
    <td><?= $peminjaman['nama_petugas'] ?? '-' ?></td>
</tr>

<tr>
    <td>Buku</td>
    <td>
        <?php if (!empty($detail)): ?>
            <?php foreach ($detail as $d): ?>
                <?= $d['judul'] ?> (<?= $d['jumlah'] ?>)<br>
            <?php endforeach; ?>
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
</tr>
<tr>
    <td>Status</td>
    <td>
        <?php if(isset($peminjaman['status']) && $peminjaman['status'] == 'dipinjam'): ?>
            <span style="color:red;">Dipinjam</span>
        <?php else: ?>
            <span style="color:green;">Dikembalikan</span>
        <?php endif; ?>

    </td>
</tr>

<tr>
    <td>Tanggal Pinjam</td>
    <td><?= $peminjaman['tanggal_pinjam'] ?></td>
</tr>

<tr>
    <td>Tanggal Kembali</td>
    <td><?= $peminjaman['tanggal_kembali'] ?></td>
</tr>

</table>

<br>

<a href="<?= base_url('peminjaman') ?>">Kembali</a>

<?= $this->endSection() ?>