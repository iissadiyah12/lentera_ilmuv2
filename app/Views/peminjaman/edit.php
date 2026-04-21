<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Peminjaman</h2>

<form action="<?= base_url('peminjaman/update/'.$peminjaman['id_peminjaman']) ?>" method="post">

    <!-- ANGGOTA -->
    <div>
        <label>Anggota</label><br>
        <select name="id_anggota" required>
            <?php foreach ($users as $u): ?>
                <option value="<?= $u['id_user'] ?>"
                    <?= ($u['id_user'] == $peminjaman['id_anggota']) ? 'selected' : '' ?>>
                    <?= $u['nama'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>

    <!-- TANGGAL -->
    <div>
        <label>Tanggal Pinjam</label><br>
        <input type="date" name="tanggal_pinjam"
            value="<?= $peminjaman['tanggal_pinjam'] ?>" required>
    </div>

    <br>

    <div>
        <label>Tanggal Kembali</label><br>
        <input type="date" name="tanggal_kembali"
            value="<?= $peminjaman['tanggal_kembali'] ?>" required>
    </div>

    <br>

    <!-- BUKU -->
    <h4>Data Buku</h4>

    <?php foreach ($buku as $b): ?>

        <?php
        // ambil qty lama dari detail
        $qty = 0;
        foreach ($detail as $d) {
            if ($d['id_buku'] == $b['id_buku']) {
                $qty = $d['jumlah'];
            }
        }
        ?>

        <div>
            <?= $b['judul'] ?> (Stok: <?= $b['jumlah'] ?>)<br>
            <input type="number"
                name="buku[<?= $b['id_buku'] ?>]"
                value="<?= $qty ?>"
                min="0">
        </div>

        <br>

    <?php endforeach; ?>

    <br>

    <!-- STATUS -->
    <div>
        <label>Status</label><br>
        <select name="status">
            <option value="dipinjam" <?= $peminjaman['status']=='dipinjam'?'selected':'' ?>>Dipinjam</option>
            <option value="dikembalikan" <?= $peminjaman['status']=='dikembalikan'?'selected':'' ?>>Dikembalikan</option>
            <option value="terlambat" <?= $peminjaman['status']=='terlambat'?'selected':'' ?>>Terlambat</option>
        </select>
    </div>

    <br>

    <button type="submit">Update</button>
    <a href="<?= base_url('peminjaman') ?>">Kembali</a>

</form>

<?= $this->endSection() ?>