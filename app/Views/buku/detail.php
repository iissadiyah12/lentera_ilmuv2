<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-book me-2"></i>
            <h5 class="mb-0">Detail Buku</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <tr>
                        <th class="bg-light w-25">ID</th>
                        <td><?= $buku['id_buku'] ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Judul</th>
                        <td><?= $buku['judul'] ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">ISBN</th>
                        <td><?= $buku['isbn'] ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Kategori</th>
                        <td><?= $buku['nama_kategori'] ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Penulis</th>
                        <td><?= $buku['nama_penulis'] ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Penerbit</th>
                        <td><?= $buku['nama_penerbit'] ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Rak</th>
                        <td><?= str_replace(',', '<br>', $buku['nama_rak']) ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Tahun</th>
                        <td><?= $buku['tahun_terbit'] ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Jumlah</th>
                        <td><?= $buku['jumlah'] ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Tersedia</th>
                        <td><?= $buku['tersedia'] ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Deskripsi</th>
                        <td><?= $buku['deskripsi'] ?></td>
                    </tr>

                    <!-- COVER -->
                    <tr>
                        <th class="bg-light">Cover</th>
                        <td>
                            <?php if (!empty($buku['cover'])): ?>
                                <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>"
                                     width="150"
                                     class="rounded border shadow-sm">
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <!-- PDF -->
                    <tr>
                        <th class="bg-light">File PDF</th>
                        <td>
                            <?php if (!empty($buku['file_pdf'])): ?>
                                <a href="<?= base_url('buku/baca/' . $buku['id_buku']) ?>"
                                   target="_blank"
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-book-half"></i> Baca Buku
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Tidak tersedia</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                </table>

            </div>

            <!-- BUTTON -->
            <div class="d-flex justify-content-between mt-3">

                <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <a href="<?= base_url('buku/wa/' . $buku['id_buku']) ?>"
                   target="_blank"
                   class="btn btn-success">
                    <i class="bi bi-whatsapp"></i> Kirim WA
                </a>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>