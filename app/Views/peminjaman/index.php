<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-journal-arrow-up"></i> Data Peminjaman Buku
                </h4>

                <?php if (session()->get('role') == 'anggota') : ?>
                    <a href="<?= base_url('peminjaman/create') ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>
                <?php endif; ?>
            </div>

            <!-- ALERT -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- SEARCH -->
            <form method="get" action="<?= base_url('peminjaman') ?>" class="row g-2 mb-3">

                <div class="col-md-4">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari peminjam..."
                           value="<?= $_GET['keyword'] ?? '' ?>">
                </div>

                <div class="col-md-auto">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="<?= base_url('peminjaman') ?>" class="btn btn-secondary">
                        Reset
                    </a>

                    <a href="<?= base_url('peminjaman/print?' . http_build_query($_GET)) ?>"
                       target="_blank"
                       class="btn btn-outline-dark">
                        <i class="bi bi-printer"></i> Print
                    </a>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Anggota</th>
                            <th>Petugas</th>
                            <th>Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status Perpanjang</th>
                            <th>Status</th>
                           <?php if (session()->get('role') == 'petugas' || session()->get('role') == 'anggota'): ?>
                            <th width="250">Aksi</th>
                           <?php endif; ?>


                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($peminjaman)) : ?>
                            <?php foreach ($peminjaman as $p): ?>
                                <tr>
                                    <td><?= $p['id_peminjaman'] ?></td>
                                    <td><?= $p['nama_anggota'] ?? '-' ?></td>
                                    <td><?= $p['nama_petugas'] ?? '-' ?></td>
                                    <td><?= $p['judul_buku'] ?? '-' ?></td>
                                    <td><?= $p['tanggal_pinjam'] ?></td>
                                    <td><?= $p['tanggal_kembali'] ?></td>

                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?= $p['status_perpanjang'] ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?php if ($p['status'] == 'menunggu'): ?>
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        <?php elseif ($p['status'] == 'dipinjam'): ?>
                                            <span class="badge bg-success">Dipinjam</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= $p['status'] ?></span>
                                        <?php endif; ?>
                                    </td>

                                     <td class="text-nowrap">

                                        <!-- ANGGOTA -->
                                        <?php if (session()->get('role') == 'anggota'): ?>

                                            <?php if ($p['status_perpanjang'] != 'menunggu'): ?>

                                                <?php if ($p['jumlah_perpanjang'] < 2): ?>
                                                    <a href="<?= base_url('peminjaman/requestPerpanjang/' . $p['id_peminjaman']) ?>"
                                                    class="btn btn-sm btn-primary"
                                                    title="Perpanjang">
                                                        <i class="bi bi-arrow-repeat"></i> Perpanjang
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">
                                                        <i class="bi bi-x-circle"></i> Habis
                                                    </span>
                                                <?php endif; ?>

                                            <?php else: ?>
                                                <span class="text-warning">
                                                    <i class="bi bi-hourglass-split"></i> Menunggu persetujuan
                                                </span>
                                            <?php endif; ?>

                                        <?php endif; ?>

                                        <!-- PETUGAS -->
                                        <?php if (session()->get('role') == 'petugas' ): ?>

                                            <!-- SETUJUI -->
                                            <?php if ($p['status'] == 'menunggu'): ?>
                                                <a href="<?= base_url('peminjaman/setujui/'.$p['id_peminjaman']) ?>"
                                                class="btn btn-sm btn-success"
                                                onclick="return confirm('Setujui peminjaman ini?')"
                                                title="Setujui">
                                                    <i class="bi bi-check-circle"></i> Setujui
                                                </a>
                                            <?php endif; ?>

                                            <!-- PERPANJANG -->
                                            <a href="<?= base_url('peminjaman/approvePerpanjang/' . $p['id_peminjaman']) ?>"
                                            class="btn btn-sm btn-info"
                                            title="Perpanjang">
                                                <i class="bi bi-calendar-plus"></i> Perpanjang
                                            </a>

                                            <!-- HAPUS -->
                                            <a href="<?= base_url('peminjaman/delete/'.$p['id_peminjaman']) ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus?')"
                                            title="Hapus">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>

                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else : ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">
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