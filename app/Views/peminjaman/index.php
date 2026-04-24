<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Data Peminjaman</h3>

<?php if (session()->getFlashdata('success')): ?>
    <div style="color:green;">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div style="color:red;">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->get('role') == 'anggota') : ?>
    <a href="<?= base_url('peminjaman/create') ?>">Tambah</a>
<?php endif; ?>

<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Anggota</th>
        <th>Petugas</th>
        <th>Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

<?php if (!empty($peminjaman)) : ?>
    <?php foreach ($peminjaman as $p): ?>
        <tr>
            <td><?= $p['nama_anggota'] ?? '-' ?></td>
            <td><?= $p['nama_petugas'] ?? '-' ?></td>
            <td><?= $p['judul_buku'] ?? '-' ?></td>
            <td><?= $p['tanggal_pinjam'] ?></td>
            <td><?= $p['tanggal_kembali'] ?></td>
            <td><?= $p['status'] ?></td>
            <td>
            <?php if (session()->get('role') == 'anggota'): ?>

            <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">
                Detail
            </a><br>
            <a href="<?= base_url('peminjaman/ajukan/'.$p['id_peminjaman']) ?>">
                Perpanjang
            </a><br>

            <?php endif; ?>
            </td>
            <td>
            <?php if (session()->get('role') == 'petugas'): ?>

            <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">
                Detail
            </a><br>

            <a href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>">
                Hapus
            </a><br>
            <a href="<?= base_url('peminjaman/setujui/'.$p['id_peminjaman']) ?>">
                Setujui
            </a><br>               
            </td>
            <?php endif; ?>

        </tr>
        <?php endforeach; ?>
        <?php else : ?>
        <tr>
            <td colspan="7" style="text-align:center;">Data tidak ada</td>
        </tr>
    <?php endif; ?>
</table>

<?= $this->endSection() ?>