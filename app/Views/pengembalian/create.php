<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2> Pengembalian Buku</h2>

<form action="<?= base_url('pengembalian/store') ?>" method="post">

    <!-- ID PEMINJAMAN -->
    <input type="hidden" name="id_peminjaman" value="<?= $peminjaman['id_peminjaman'] ?>">

    <table border="1" cellpadding="5">
        <tr>
            <th>Nama Anggota</th>
            <td><?= $peminjaman['nama_anggota'] ?></td>
        </tr>

        <tr>
            <th>Tanggal Pinjam</th>
            <td><?= $peminjaman['tanggal_pinjam'] ?></td>
        </tr>

        <tr>
            <th>Tanggal Kembali</th>
            <td><?= $peminjaman['tanggal_kembali'] ?></td>
        </tr>

        <tr>
            <th>Status Peminjaman</th>
            <td><?= $peminjaman['status'] ?></td>
        </tr>
    </table>

    <br>

    <!-- INFO AUTO -->
    <p><b>Tanggal Dikembalikan:</b> Akan otomatis hari ini</p>
    <p><b>Status:</b> menunggu</p>
    <p><b>Denda:</b> akan dihitung otomatis</p>

    <br>

    <button type="submit" onclick="return confirm('Yakin ingin mengembalikan buku?')">
        Kembalikan Buku
    </button>

</form>

<?= $this->endSection() ?>