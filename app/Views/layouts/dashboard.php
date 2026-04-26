<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

    <!-- STYLE PRO -->
<style>
.card-pro {
    border-radius: 12px;
    transition: 0.25s;
    overflow: hidden;
}
.card-pro:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 25px rgba(0,0,0,0.15);
}
.counter {
    font-size: 28px;
    font-weight: bold;
}
.small-text {
    opacity: 0.9;
}
.badge-soft {
    border-radius: 20px;
    padding: 5px 10px;
}
</style>
<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-speedometer2"></i> Dashboard
        </h3>
        <p class="text-muted">
            Selamat datang di Sistem Perpustakaan
            <span class="badge bg-success ms-2">Realtime</span>
        </p>
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
                        <h4 class="fw-bold mb-0" id="total_users"><?= $total_users ?? 0 ?></h4>
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
                        <h4 class="fw-bold mb-0" id="total_buku"><?= $total_buku ?? 0 ?></h4>
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
                        <h4 class="fw-bold mb-0" id="total_peminjaman"><?= $total_peminjaman ?? 0 ?></h4>
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
                        <h4 class="fw-bold mb-0" id="total_pengembalian"><?= $total_pengembalian ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- SECOND ROW -->
    <div class="row mt-4 g-3">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-danger text-white rounded p-3 me-3">
                        <i class="bi bi-cash-coin fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Denda Belum Lunas</h6>
                        <h4 class="fw-bold mb-0" id="denda_belum"><?= $denda_belum ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-secondary text-white rounded p-3 me-3">
                        <i class="bi bi-tags fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Kategori</h6>
                        <h4 class="fw-bold mb-0" id="total_kategori"><?= $total_kategori ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-dark text-white rounded p-3 me-3">
                        <i class="bi bi-archive fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">Rak Buku</h6>
                        <h4 class="fw-bold mb-0" id="total_rak"><?= $total_rak ?? 0 ?></h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- 🔥 REALTIME SCRIPT -->
<script>
function loadDashboard() {
    fetch("<?= base_url('dashboard/realtime') ?>")
        .then(res => res.json())
        .then(data => {
            document.getElementById('total_users').innerText = data.total_users;
            document.getElementById('total_buku').innerText = data.total_buku;
            document.getElementById('total_peminjaman').innerText = data.total_peminjaman;
            document.getElementById('total_pengembalian').innerText = data.total_pengembalian;
            document.getElementById('denda_belum').innerText = data.denda_belum;
            document.getElementById('total_kategori').innerText = data.total_kategori;
            document.getElementById('total_rak').innerText = data.total_rak;
        });
}

// refresh tiap 5 detik
setInterval(loadDashboard, 5000);
</script>

<?= $this->endSection() ?>