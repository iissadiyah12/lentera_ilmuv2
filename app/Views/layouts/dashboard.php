<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1">
            <i class="bi bi-speedometer2"></i> Dashboard
        </h3>
        <p class="text-muted mb-0">
            Selamat datang di Sistem Perpustakaan Lentera Ilmu
        </p>
    </div>

    <!-- CARD -->
    <div class="row g-3">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Total Buku</small>
                    <h3 class="fw-bold mt-2" id="total_buku"><?= $total_buku ?? 0 ?></h3>
                </div>
            </div>
        </div>

        <?php if(session()->get('role') == 'admin' || session()->get('role') == 'petugas'): ?>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Total Users</small>
                    <h3 class="fw-bold mt-2" id="total_users"><?= $total_users ?? 0 ?></h3>
                </div>
            </div>
        </div>

        <?php endif; ?>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Total Peminjaman</small>
                    <h3 class="fw-bold mt-2" id="total_peminjaman"><?= $total_peminjaman ?? 0 ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <small class="text-muted">Total Pengembalian</small>
                    <h3 class="fw-bold mt-2" id="total_pengembalian"><?= $total_pengembalian ?? 0 ?></h3>
                </div>
            </div>
        </div>

    </div>

    <!-- CHART -->
    <div class="row mt-4">

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Statistik Perpustakaan</h5>
                    <canvas id="chartDashboard" height="120"></canvas>
                </div>
            </div>
        </div>

        <?php if(session()->get('role') == 'admin' || session()->get('role') == 'petugas'): ?>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <small class="text-muted">Total Kategori</small>
                    <h3 class="fw-bold mt-2" id="total_kategori"><?= $total_kategori ?? 0 ?></h3>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Total Rak</small>
                    <h3 class="fw-bold mt-2" id="total_rak"><?= $total_rak ?? 0 ?></h3>
                </div>
            </div>

        </div>

        <?php endif; ?>

    </div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartDashboard');

const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Users','Buku','Pinjam','Kembali'],
        datasets: [{
            data: [
                <?= $total_users ?? 0 ?>,
                <?= $total_buku ?? 0 ?>,
                <?= $total_peminjaman ?? 0 ?>,
                <?= $total_pengembalian ?? 0 ?>
            ],
            borderRadius: 8
        }]
    },
    options:{
        responsive:true,
        plugins:{
            legend:{display:false}
        },
        scales:{
            y:{beginAtZero:true}
        }
    }
});

function loadRealtime()
{
    fetch("<?= base_url('home/realtime') ?>")
    .then(res => res.json())
    .then(data => {

        if(document.getElementById('total_users'))
            document.getElementById('total_users').innerHTML = data.total_users;

        document.getElementById('total_buku').innerHTML = data.total_buku;
        document.getElementById('total_peminjaman').innerHTML = data.total_peminjaman;
        document.getElementById('total_pengembalian').innerHTML = data.total_pengembalian;

        if(document.getElementById('total_kategori'))
            document.getElementById('total_kategori').innerHTML = data.total_kategori;

        if(document.getElementById('total_rak'))
            document.getElementById('total_rak').innerHTML = data.total_rak;

        myChart.data.datasets[0].data = [
            data.total_users,
            data.total_buku,
            data.total_peminjaman,
            data.total_pengembalian
        ];

        myChart.update();
    });
}

setInterval(loadRealtime, 5000);
</script>

<?= $this->endSection() ?>