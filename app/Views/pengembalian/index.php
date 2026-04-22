<h2>Data Pengembalian</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Peminjaman</th>
    <th>Tanggal Kembali</th>
    <th>Denda</th>
    <th>Aksi</th>
</tr>

<?php foreach($pengembalian as $p): ?>
<tr>
    <td><?= $p['id_pengembalian'] ?></td>
    <td><?= $p['id_peminjaman'] ?></td>
    <td><?= $p['tanggal_dikembalikan'] ?></td>
    <td><?= $p['denda'] ?></td>
    <td>
        <a href="/pengembalian/detail/<?= $p['id_pengembalian'] ?>">Detail</a>
        <a href="/pengembalian/delete/<?= $p['id_pengembalian'] ?>">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>