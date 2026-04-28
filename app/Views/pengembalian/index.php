<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-journal-check"></i> Data Pengembalian
                </h4>
            </div>

            <!-- SEARCH + ACTION -->
            <form method="get" action="<?= base_url('pengembalian') ?>" class="row g-2 mb-3">

                <div class="col-md-5">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari id peminjaman / nama..."
                           value="<?= $_GET['keyword'] ?? '' ?>">
                </div>

                <div class="col-md-auto d-flex gap-1">

                    <!-- SEARCH -->
                    <button type="submit" class="btn btn-primary btn-sm" title="Cari">
                        <i class="bi bi-search"></i>
                    </button>

                    <!-- RESET -->
                    <a href="<?= base_url('pengembalian') ?>" class="btn btn-secondary btn-sm" title="Reset">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>

                    <!-- PRINT -->
                    <a href="<?= base_url('pengembalian/print?' . http_build_query($_GET)) ?>"
                       target="_blank"
                       class="btn btn-dark btn-sm"
                       title="Print">
                        <i class="bi bi-printer"></i>
                    </a>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th width="140" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (!empty($pengembalian)) : ?>

                        <?php $no = 1; ?>

                        <?php foreach($pengembalian as $p): ?>
                            <tr>

                                <!-- NOMOR URUT -->
                                <td><?= $no++ ?></td>

                                <td><?= $p['nama_anggota'] ?? '-' ?></td>
                                <td><?= $p['tanggal_dikembalikan'] ?? '-' ?></td>

                                <td>
                                    <?php if ($p['status_peminjaman'] == 'dikembalikan'): ?>
                                        <span class="badge bg-success">Dikembalikan</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Dipinjam</span>
                                    <?php endif; ?>
                                </td>

                                <!-- AKSI -->
                                <td class="text-center">

                                    <!-- HAPUS -->
                                    <a href="<?= base_url('pengembalian/delete/' . $p['id_pengembalian']) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin mau hapus?')"
                                       title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <!-- KEMBALIKAN -->
                                    <?php if ($p['status_peminjaman'] != 'dikembalikan'): ?>
                                        <a href="<?= base_url('pengembalian/acc/'.$p['id_peminjaman']) ?>"
                                           class="btn btn-sm btn-success"
                                           onclick="return confirm('Yakin buku dikembalikan?')"
                                           title="Kembalikan">
                                            <i class="bi bi-check-circle"></i>
                                        </a>
                                    <?php endif; ?>

                                    <!-- WA -->
                                    <a href="https://wa.me/62xxxxxxxxxx"
                                       target="_blank"
                                       class="btn btn-sm btn-success"
                                       title="WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>

                                </td>

                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Data tidak ada
                            </td>
                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>