<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="fw-bold mb-0">
                <i class="bi bi-building"></i> Data Penerbit
            </h3>
            <small class="text-muted">Kelola data penerbit buku</small>
        </div>

        <a href="<?= base_url('penerbit/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Penerbit
        </a>
    </div>

    <!-- SEARCH -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <form method="get" class="row g-2 align-items-center">

                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text"
                               name="keyword"
                               class="form-control"
                               placeholder="Cari nama penerbit..."
                               value="<?= $_GET['keyword'] ?? '' ?>">
                    </div>
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-success">
                        Cari
                    </button>
                </div>

            </form>

            <div class="mt-2">
                <a href="<?= current_url() ?>" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
            </div>

        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>Nama Penerbit</th>
                            <th>Alamat</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($penerbit)): ?>
                            <?php foreach ($penerbit as $p): ?>
                                <tr>
                                    <td class="fw-semibold">
                                        <i class="bi bi-building text-primary"></i>
                                        <?= $p['nama_penerbit'] ?>
                                    </td>

                                    <td>
                                        <i class="bi bi-geo-alt text-danger"></i>
                                        <?= $p['alamat'] ?>
                                    </td>

                                    <td class="text-nowrap">

                                       

                                        <a href="<?= base_url('penerbit/delete/'.$p['id_penerbit']) ?>"
                                           class="btn btn-sm btn-danger"
                                           onclick="return confirm('Hapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4"></i><br>
                                    Data penerbit tidak ditemukan
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