<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-speedometer2"></i> Dashboard
        </h3>
        <p class="text-muted">Selamat datang di <b>Lentera Ilmu</b> App</p>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-3">

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-people text-primary fs-3"></i>
                    <h6>Users</h6>
                    <h4 id="total_users"><?= $total_users ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-book text-success fs-3"></i>
                    <h6>Buku</h6>
                    <h4 id="total_buku"><?= $total_buku ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-journal-arrow-up text-warning fs-3"></i>
                    <h6>Peminjaman</h6>
                    <h4 id="total_peminjaman"><?= $total_peminjaman ?></h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-journal-check text-info fs-3"></i>
                    <h6>Pengembalian</h6>
                    <h4 id="total_pengembalian"><?= $total_pengembalian ?></h4>
                </div>
            </div>
        </div>

    </div>

    <!-- CHART -->
    <div class="row mt-4">

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5>Buku Paling Sering Dipinjam</h5>
                    <canvas id="chartBuku"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5>Info Sistem</h5>
                    <p class="text-muted">
                        Sistem perpustakaan ini berjalan realtime untuk monitoring data.
                    </p>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// REALTIME DASHBOARD
function loadDashboard() {
    fetch("<?= base_url('dashboard/realtime') ?>")
        .then(res => res.json())
        .then(data => {
            document.getElementById('total_users').innerText = data.total_users;
            document.getElementById('total_buku').innerText = data.total_buku;
            document.getElementById('total_peminjaman').innerText = data.total_peminjaman;
            document.getElementById('total_pengembalian').innerText = data.total_pengembalian;
        });
}
setInterval(loadDashboard, 5000);

// CHART BUKU POPULER
const ctx = document.getElementById('chartBuku');

const chartBuku = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($buku_label ?? []) ?>,
        datasets: [{
            label: 'Jumlah Dipinjam',
            data: <?= json_encode($buku_total ?? []) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.6)'
        }]
    }
});
</script>

<?= $this->endSection() ?>