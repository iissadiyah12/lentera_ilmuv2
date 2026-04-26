<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <h4 class="mb-3">
                <i class="bi bi-cash-coin"></i> Data Denda
            </h4>

            <!-- SEARCH -->
            <form method="get" class="row g-2 mb-3">

                <div class="col-md-4">
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Cari ID Pengembalian"
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
                            <th>ID Pengembalian</th>
                            <th>Hari Terlambat</th>
                            <th>Total Denda</th>
                            <th>Status</th>
                            <th>Metode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($denda)): ?>
                            <?php foreach ($denda as $d): ?>
                                <tr>
                                    <td><?= $d['id_denda'] ?></td>
                                    <td><?= $d['id_pengembalian'] ?></td>
                                    <td><?= $d['hari_terlambat'] ?></td>
                                    <td>Rp <?= number_format($d['total_denda']) ?></td>

                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?= $d['status_bayar'] ?>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            <?= $d['metode_bayar'] ?>
                                        </span>
                                    </td>

                                    <td>

                                        <!-- UPDATE -->
                                        <form method="post"
                                              action="/denda/update/<?= $d['id_denda'] ?>"
                                              class="d-flex flex-column gap-1">

                                            <select name="status_bayar" class="form-select form-select-sm">
                                                <option value="belum">Belum</option>
                                                <option value="lunas">Lunas</option>
                                            </select>

                                            <select name="metode_bayar" class="form-select form-select-sm">
                                                <option value="cash">Cash</option>
                                                <option value="dana">Dana</option>
                                                <option value="qris">QRIS</option>
                                            </select>

                                            <button type="submit" class="btn btn-sm btn-warning mt-1">
                                                <i class="bi bi-check-circle"></i> Update
                                            </button>

                                        </form>

                                        <!-- DELETE -->
                                        <a href="/denda/delete/<?= $d['id_denda'] ?>"
                                           class="btn btn-sm btn-danger mt-2"
                                           onclick="return confirm('Hapus data?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Tidak Ada Denda
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