<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Pengembalian</h2>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Nama </th>
    <th>Tanggal Dikembalikan</th>
    <th>Denda</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php foreach($pengembalian as $p): ?>
<tr>
    <td><?= $p['id_pengembalian'] ?></td>
    <td><?= $p['nama_anggota'] ?></td>
    <td><?= $p['tanggal_dikembalikan'] ?></td>
    <td><?= $p['denda'] ?></td>
    <td>
        <?php if ($p['status'] == 'disetujui'): ?>
            <span style="color:green;">Dikembalikan</span>
        <?php else: ?>
            <span style="color:red;">Dipinjam</span>
        <?php endif; ?>
    </td>
    <td>
        <?php if ($p['denda'] > 0): ?>

        <b style="color:red;">
            Rp <?= number_format($p['denda']) ?>
        </b><br>

        <?php if ($p['status_bayar'] == 'belum'): ?>
            <form method="post" action="<?= base_url('pengembalian/bayar/'.$p['id_pengembalian']) ?>">
                <select name="metode" required>
                    <option value="cash">Cash</option>
                    <option value="dana">DANA</option>
                    <option value="qris">QRIS</option>
                </select>

                <?php if ($p['status_bayar'] == 'belum'): ?>
                <span style="color:red;">Belum Bayar</span>
            <?php else: ?>
                <span style="color:green;">Lunas</span>
            <?php endif; ?>
        <?php endif; ?>

        <?php else: ?>
      
        <?php endif; ?>
    </td>
    <td>
       <?php if (session()->get('role') == 'petugas'): ?>

       <a href="<?= base_url('pengembalian/delete/' . $p['id_pengembalian']) ?>" 
            onclick="return confirm('Yakin mau hapus?')">Hapus</a>
        <?php if($p['status'] == 'belum'): ?>
            <a href="<?= base_url('pengembalian/acc/'.$p['id_pengembalian']) ?>"
             onclick="return confirm('Konfirmasi pengembalian?')">
             Kembalikan
        </a>
        
         <?php endif; ?>
        <?php endif; ?> 
    </td>
</tr>
<?php endforeach; ?>
</table>

<?= $this->endSection() ?>