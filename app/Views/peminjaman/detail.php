<h3>Detail Peminjaman</h3>

<?php if ($notif): ?>
    <div style="color:red; font-weight:bold;">
        <?= $notif ?>
    </div>
<?php endif; ?>

<p>Total Buku Dipinjam: <b><?= $total_buku ?></b></p>

<table border="1" cellpadding="10">
<tr>
    <th>Judul</th>
    <th>Cover</th>
    <th>Dipinjam</th>
    <th>Dikembalikan</th>
    <th>Sisa</th>
    <th>Aksi</th>
</tr>

<?php foreach ($detail as $d): ?>
<tr>
    <td><?= $d['judul'] ?></td>

    <td>
        <?php if ($d['cover']): ?>
            <img src="<?= base_url('uploads/buku/'.$d['cover']) ?>" width="80">
        <?php endif; ?>
    </td>

    <td><?= $d['jumlah'] ?></td>
    <td><?= $d['dikembalikan'] ?></td>
    <td><?= $d['jumlah'] - $d['dikembalikan'] ?></td>

    <td>
        <a href="<?= base_url('peminjaman/detail/'.$p['id_peminjaman']) ?>">
    Detail
</a>
        <?php if ($d['jumlah'] > $d['dikembalikan']): ?>
            <a href="<?= base_url('peminjaman/kembalikan/'.$d['id_detail']) ?>">
                Kembalikan 1
            </a>
        <?php else: ?>
            Selesai
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>