<h2>Proses Pengembalian</h2>

<form action="/pengembalian/store" method="post">

<input type="hidden" name="id_peminjaman" value="<?= $peminjaman['id_peminjaman'] ?>">

<p>Status peminjaman: <?= $peminjaman['status'] ?></p>

<button type="submit">Kembalikan Buku</button>

</form>