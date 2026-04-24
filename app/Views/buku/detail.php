<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h3>Detail Buku</h3>

<table border="1" cellpadding="8">
    <tr>
        <td>ID</td>
        <td><?= $buku['id_buku'] ?></td>
    </tr>
    <tr>
        <td>Judul</td>
        <td><?= $buku['judul'] ?></td>
    </tr>
    <tr>
        <td>ISBN</td>
        <td><?= $buku['isbn'] ?></td>
    </tr>
    <tr>
        <td>Kategori</td>
        <td><?= $buku['nama_kategori'] ?? '-' ?></td>
    </tr>
    <tr>
        <td>Penulis</td>
        <td><?= $buku['nama_penulis'] ?? '-' ?></td>
    </tr>
    <tr>
        <td>Penerbit</td>
        <td><?= $buku['nama_penerbit'] ?? '-' ?></td>
    </tr>
    <tr>
        <td>Rak</td>
        <td>
            <?= str_replace(',', '<br>', $buku['nama_rak']) ?> </td>
    </tr>
    <tr>
        <td>Tahun</td>
        <td><?= $buku['tahun_terbit'] ?></td>
    </tr>
    <tr>
        <td>Jumlah</td>
        <td><?= $buku['jumlah'] ?></td>
    </tr>
    <tr>
        <td>Tersedia</td>
        <td><?= $buku['tersedia'] ?></td>
    </tr>
    <tr>
        <td>Deskripsi</td>
        <td><?= $buku['deskripsi'] ?></td>
    </tr>

    <!-- COVER -->
    <tr>
        <td>Cover</td>
        <td>
            <?php if (!empty($buku['cover'])): ?>
                <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>" width="150">
            <?php else: ?>
                -
            <?php endif; ?>
        </td>
    </tr>

    <!-- PDF -->
    <tr>
        <td>File PDF</td>
        <td>
            <?php if (!empty($buku['file_pdf'])): ?>
                <a href="<?= base_url('buku/baca/' . $buku['id_buku']) ?>" target="_blank">Baca Buku</a>

            <?php else: ?>
                Tidak tersedia
            <?php endif; ?>
        </td>
    </tr>

</table>

<br>
<a href="<?= base_url('buku') ?>">Kembali</a>
<a href="<?= base_url('buku/wa/' . $buku['id_buku']) ?>" target="_blank">Kirim WA</a>

<?= $this->endSection() ?>