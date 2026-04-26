<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Pengembalian</h2>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Nama </th>
    <th>Tanggal Kembali</th>
    <th>Denda</th>
    <th>Status</th>
    <th>Pembayaran</th>
    <th>Aksi</th>
</tr>

<?php foreach($pengembalian as $p): ?>
<tr>
    <td><?= $p['id_pengembalian'] ?></td>
    <td><?= $p['id_peminjaman'] ?></td>
    <td><?= $p['tanggal_dikembalikan'] ?></td>
    <td>
    <?php if ($p['denda'] > 3000 * 3): ?>
        <b style="color:red;">
            Rp <?= number_format($p['denda']) ?>
        </b><br>

        <?php if ($p['status_bayar'] == 'lunas'): ?>
            <span style="color:green; font-weight:bold;">✔ Lunas</span>
        <?php else: ?>

        <?php endif; ?>

    <?php else: ?>
        -
    <?php endif; ?>
    </td>   
    <td>
        <?php if ($p['status'] == 'disetujui'): ?>
            <span style="color:green;">Dikembalikan</span>
        <?php else: ?>
            <span style="color:red;">Dipinjam</span>
        <?php endif; ?>
    </td>
   <td>
<?php if ($p['denda'] > 0): ?>

    Rp <?= number_format($p['denda']) ?><br>

    <?php if ($p['status_bayar'] == 'lunas'): ?>
        <span style="color:green;">✔ Lunas</span>
    <?php else: ?>
        <a href="<?= base_url('pengembalian/lunas/'.$p['id_pengembalian']) ?>"
           style="background:green;color:white;padding:5px 10px;border-radius:5px;text-decoration:none;">
           Lunas
        </a>
    <?php endif; ?>

<?php else: ?>
    -
<?php endif; ?>
</td>

    <td>
       <a href="<?= base_url('pengembalian/delete/' . $p['id_pengembalian']) ?>" 
            onclick="return confirm('Yakin mau hapus?')">Hapus</a>
    
            <?php if ($p['status'] != 'disetujui'): ?>
    <a href="<?= base_url('pengembalian/acc/'.$p['id_peminjaman']) ?>"
       onclick="return confirm('Yakin buku dikembalikan?')">
       Kembalikan
            </a>

        <?php endif; ?> 
    </td>
</tr>
<?php endforeach; ?>
</table>

<?= $this->endSection() ?>