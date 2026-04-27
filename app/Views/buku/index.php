<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-book"></i> Data Buku
                </h4>

                <div class="d-flex gap-2">
                    <a href="<?= base_url('buku/create') ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </a>

                    <a href="<?= base_url('buku/print') ?>" target="_blank" class="btn btn-outline-dark">
                        <i class="bi bi-printer"></i> Print
                    </a>
                </div>
            </div>

            <!-- SEARCH -->
            <form method="get" class="row g-2 mb-3">

                <div class="col-md-4">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari judul..."
                           value="<?= $_GET['keyword'] ?? '' ?>">
                </div>

                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>ISBN</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Rak</th>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th>Tersedia</th>
                            <th>Cover</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($buku) && is_array($buku)): ?>

                            <?php if (isset($pager)) : ?>
                                <?php $no = 1 + (5 * ($pager->getCurrentPage() - 1)); ?>
                            <?php else: ?>
                                <?php $no = 1; ?>
                            <?php endif; ?>

                            <?php foreach ($buku as $b): ?>
                                <tr>
                                    <td><?= $b['id_buku'] ?? '-' ?></td>
                                    <td><?= $b['isbn'] ?? '-' ?></td>
                                    <td><?= $b['judul'] ?? '-' ?></td>
                                    <td><?= $b['nama_kategori'] ?? '-' ?></td>
                                    <td><?= $b['nama_penulis'] ?? '-' ?></td>
                                    <td><?= $b['nama_penerbit'] ?? '-' ?></td>
                                    <td><?= $b['nama_rak'] ?? '-' ?></td>
                                    <td><?= $b['tahun_terbit'] ?? '-' ?></td>
                                    <td><?= $b['jumlah'] ?? '0' ?></td>
                                    <td><?= $b['tersedia'] ?? '0' ?></td>

                                    <td>
                                        <?php if (!empty($b['cover'])): ?>

                                            <?php $ext = pathinfo($b['cover'], PATHINFO_EXTENSION); ?>

                                            <?php if (in_array(strtolower($ext), ['jpg','jpeg','png','gif'])): ?>
                                                <img src="<?= base_url('uploads/buku/' . $b['cover']) ?>"
                                                     width="60"
                                                     class="rounded shadow-sm">
                                            <?php else: ?>
                                                <a href="<?= base_url('uploads/buku/' . $b['cover']) ?>" target="_blank">
                                                    <i class="bi bi-file-earmark"></i> File
                                                </a>
                                            <?php endif; ?>

                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>

                                   <td class="text-nowrap">

                                        <?php if (session()->get('role') == 'anggota') : ?>
                                            <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>"
                                            class="btn btn-sm btn-info"
                                            title="Detail">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>

                                            <a href="<?= base_url('buku/wa/' . $b['id_buku']) ?>"
                                            target="_blank"
                                            class="btn btn-sm btn-success"
                                            title="WhatsApp">
                                                <i class="bi bi-whatsapp"></i> WA
                                            </a>
                                        <?php endif; ?>

                                        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                                            <a href="<?= base_url('buku/detail/' . $b['id_buku']) ?>"
                                            class="btn btn-sm btn-info"
                                            title="Detail">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>

                                            <a href="<?= base_url('buku/edit/' . $b['id_buku']) ?>"
                                            class="btn btn-sm btn-warning"
                                            title="Edit">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>

                                            <a href="<?= base_url('buku/delete/' . $b['id_buku']) ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Yakin hapus?')"
                                            title="Hapus">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>

                                            <a href="<?= base_url('buku/wa/' . $b['id_buku']) ?>"
                                            target="_blank"
                                            class="btn btn-sm btn-success"
                                            title="WhatsApp">
                                                <i class="bi bi-whatsapp"></i> WA
                                            </a>
                                        <?php endif; ?>

                                    </td>
                                                                    </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="12" class="text-center text-muted">
                                    Data tidak tersedia
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                <?php if (isset($pager)) : ?>
                    <?= $pager->links() ?>
                <?php endif; ?>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>