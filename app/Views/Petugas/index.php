<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-person-badge"></i> Data Petugas
                </h4>

                <a href="<?= base_url('petugas/create') ?>" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah Petugas
                </a>
            </div>

            <!-- FORM SEARCH -->
            <form method="get" action="<?= base_url('petugas') ?>" class="row g-2 mb-3">

                <div class="col-md-4">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari jabatan..."
                           value="<?= $_GET['keyword'] ?? '' ?>">
                </div>

                <div class="col-md-auto">

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="<?= base_url('petugas') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-repeat"></i> Reset
                    </a>

                    <a href="<?= base_url('petugas/print?' . http_build_query($_GET)) ?>"
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
                            <th>Jabatan</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($petugas as $p): ?>
                            <tr>
                                <td><?= $p['id_petugas'] ?></td>
                                <td><?= $p['jabatan'] ?></td>
                                <td>

                                    <a href="<?= base_url('petugas/edit/'.$p['id_petugas']) ?>"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <a href="<?= base_url('petugas/delete/'.$p['id_petugas']) ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin hapus?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>