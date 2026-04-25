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

<table border="1" cellpadding="2" cellspacing="0">
    <tr>
        <th>Anggota</th>
        <th>Petugas</th>
        <th>Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status Perpanjang</th>
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
            <td><?= $p['status_perpanjang'] ?></td>
            <td><?= $p['status'] ?></td>
            <td>
            <?php if (session()->get('role') == 'anggota'): ?>

            <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">
                Detail
            </a><br>
           <?php if ($p['status_perpanjang'] != 'menunggu'): ?>

                <?php if ($p['jumlah_perpanjang'] < 2): ?>
                    <a href="<?= base_url('peminjaman/requestPerpanjang/' . $p['id_peminjaman']) ?>">
                        Perpanjang
                    </a>
                <?php else: ?>
                    <span>perpanjang habis</span>
                <?php endif; ?>

            <?php else: ?>
                <span>Menunggu persetujuan</span>
            <?php endif; ?>

            <?php endif; ?>

            
            </td>
           
                            <td>
                <?php if (session()->get('role') == 'petugas'): ?>

                    <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">
                        Detail
                    </a><br>

                    <?php if ($p['status'] == 'menunggu'): ?>
                        <a href="<?= base_url('peminjaman/setujui/'.$p['id_peminjaman']) ?>"
                        onclick="return confirm('Setujui peminjaman ini?')">
                        Setujui Pinjam
                        </a><br>
                    <?php endif; ?>

                    <a href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>"
                    onclick="return confirm('Yakin hapus?')">
                    Hapus
                    </a>

                <?php endif; ?>
                   
                <a href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>">
                    Hapus
                </a><br>
                <a href="<?= base_url('peminjaman/approvePerpanjang/' . $p['id_peminjaman']) ?>">
                    setujui
                    </a>          
                </td>
        
                        
        </tr>
        <?php endforeach; ?>
        <?php else : ?>
        <tr>
            <td colspan="7" style="text-align:center;">Data tidak ada</td>
        </tr>
    <?php endif; ?>
</table>

<?= $this->endSection() ?>