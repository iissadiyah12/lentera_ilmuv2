<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-speedometer2"></i> Dashboard
        </h3>
        <p class="text-muted">Selamat datang di Sistem Perpustakaan</p>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-3">

        <!-- USERS -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary text-white rounded p-3 me-3">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Users</h6>
                        <h4 class="fw-bold mb-0"><?= $total_users ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- BUKU -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success text-white rounded p-3 me-3">
                        <i class="bi bi-book fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Buku</h6>
                        <h4 class="fw-bold mb-0"><?= $total_buku ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- PEMINJAMAN -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning text-dark rounded p-3 me-3">
                        <i class="bi bi-journal-arrow-up fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Peminjaman</h6>
                        <h4 class="fw-bold mb-0"><?= $total_peminjaman ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- PENGEMBALIAN -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-info text-white rounded p-3 me-3">
                        <i class="bi bi-journal-check fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Pengembalian</h6>
                        <h4 class="fw-bold mb-0"><?= $total_pengembalian ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- SECOND ROW -->
    <div class="row mt-4 g-3">

        <!-- DENDA -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-danger text-white rounded p-3 me-3">
                        <i class="bi bi-cash-coin fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Denda Belum Lunas</h6>
                        <h4 class="fw-bold mb-0"><?= $denda_belum ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- KATEGORI -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-secondary text-white rounded p-3 me-3">
                        <i class="bi bi-tags fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Kategori</h6>
                        <h4 class="fw-bold mb-0"><?= $total_kategori ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- RAK -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-dark text-white rounded p-3 me-3">
                        <i class="bi bi-archive fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Rak Buku</h6>
                        <h4 class="fw-bold mb-0"><?= $total_rak ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- INFO BOX -->
    <div class="card mt-4 shadow-sm border-0">
        <div class="card-body">
            <h5 class="mb-2">
                <i class="bi bi-info-circle"></i> Info Sistem
            </h5>
            <p class="mb-0 text-muted">
                Sistem Perpustakaan ini digunakan untuk mengelola data buku, peminjaman, pengembalian, dan denda secara digital.
            </p>
        </div>
    </div>

</div>

<?= $this->endSection() ?>