<!-- FILE: app/Views/dashboard/index.php -->

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Dashboard</h3>
        <p class="text-muted">Selamat datang di Sistem Perpustakaan Lentera Ilmu</p>
    </div>

    <!-- CARD STATISTIK -->
    <div class="row g-4">

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Total Users</small>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <h3 id="total_users"><?= $total_users ?? 0 ?></h3>
                    <i class="bi bi-people fs-3 text-primary"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Total Buku</small>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <h3 id="total_buku"><?= $total_buku ?? 0 ?></h3>
                    <i class="bi bi-book fs-3 text-success"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Peminjaman</small>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <h3 id="total_peminjaman"><?= $total_peminjaman ?? 0 ?></h3>
                    <i class="bi bi-journal-arrow-up fs-3 text-warning"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Pengembalian</small>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <h3 id="total_pengembalian"><?= $total_pengembalian ?? 0 ?></h3>
                    <i class="bi bi-journal-check fs-3 text-info"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- CHART -->
    <div class="row mt-4">

        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Buku Paling Banyak Dipinjam</h5>
                <canvas id="chartBuku"></canvas>
            </div>
        </div>

        <div class="col-md-4">

            <div class="card shadow-sm p-3 mb-3">
                <small class="text-muted">Denda Belum Lunas</small>
                <h3 id="denda_belum"><?= $denda_belum ?? 0 ?></h3>
            </div>

            <div class="card shadow-sm p-3 mb-3">
                <small class="text-muted">Kategori</small>
                <h3 id="total_kategori"><?= $total_kategori ?? 0 ?></h3>
            </div>

            <div class="card shadow-sm p-3">
                <small class="text-muted">Rak Buku</small>
                <h3 id="total_rak"><?= $total_rak ?? 0 ?></h3>
            </div>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartBuku');

const chartBuku = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($chart_label ?? []) ?>,
        datasets: [{
            label: 'Jumlah Dipinjam',
            data: <?= json_encode($chart_data ?? []) ?>,
            borderRadius: 8,
            borderWidth: 1
        }]
    },
    options: {
        responsive:true,
        plugins:{
            legend:{display:false}
        },
        scales:{
            y:{beginAtZero:true}
        }
    }
});


// REALTIME
function loadRealtime(){
    fetch("<?= base_url('dashboard/realtime') ?>")
    .then(res => res.json())
    .then(data => {

        document.getElementById('total_users').innerHTML = data.total_users;
        document.getElementById('total_buku').innerHTML = data.total_buku;
        document.getElementById('total_peminjaman').innerHTML = data.total_peminjaman;
        document.getElementById('total_pengembalian').innerHTML = data.total_pengembalian;
        document.getElementById('denda_belum').innerHTML = data.denda_belum;
        document.getElementById('total_kategori').innerHTML = data.total_kategori;
        document.getElementById('total_rak').innerHTML = data.total_rak;

        chartBuku.data.labels = data.chart_label;
        chartBuku.data.datasets[0].data = data.chart_data;
        chartBuku.update();

    });
}

setInterval(loadRealtime, 5000);
</script>

<?= $this->endSection() ?>