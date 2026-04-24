<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Pengembalian</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nama </th>
    <th>Tanggal Kembali</th>
    <th>Denda</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php foreach($pengembalian as $p): ?>
<tr>
    <td><?= $p['id_pengembalian'] ?></td>
    <td><?= $p['id_peminjaman'] ?></td>
    <td><?= $p['tanggal_dikembalikan'] ?></td>
    <td><?= $p['denda'] ?></td>
    <td>
        <?php if ($pengembalian): ?>
        <span style="color:green;">Dikembalikan</span>
        <?php else: ?>
         <span style="color:red;">Dipinjam</span>
        <?php endif; ?>
    </td>
    <td>
        <a href="pengembalian/detail/<?= $p['id_pengembalian'] ?>">Detail</a>
       <a href="<?= base_url('pengembalian/delete/' . $p['id_pengembalian']) ?>" 
            onclick="return confirm('Yakin mau hapus?')">Hapus</a>
        <?php if($p['status'] == 'belum'): ?>
            <a href="<?= base_url('pengembalian/acc/'.$p['id_pengembalian']) ?>"
             onclick="return confirm('Konfirmasi pengembalian?')">
             Kembalikan
        </a>
<?php endif; ?> 
    </td>
</tr>
<?php endforeach; ?>
</table>

<?= $this->endSection() ?>