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

<div class="container-fluid">

<h2 class="mb-3">📊 Dashboard LENTERA ILMU </h2>

<!-- CARD ROW -->
<div class="row g-3">

    <div class="col-md-3">
        <div class="card bg-primary text-white card-pro">
            <div class="card-body">
                <div class="counter"><?= $total_buku ?? 0 ?></div>
                <div class="small-text">📚 Total Buku</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white card-pro">
            <div class="card-body">
                <div class="counter"><?= $total_anggota ?? 0 ?></div>
                <div class="small-text">👥 Anggota</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-white card-pro">
            <div class="card-body">
                <div class="counter"><?= $dipinjam ?? 0 ?></div>
                <div class="small-text">📖 Dipinjam</div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white card-pro">
            <div class="card-body">
                <div class="counter"><?= $terlambat ?? 0 ?></div>
                <div class="small-text">⚠️ Terlambat</div>
            </div>
        </div>
    </div>

</div>

<!-- DENDA -->
<div class="card mt-3 shadow-sm card-pro">
    <div class="card-body">
        <h5>💰 Total Denda</h5>
        <h3 class="text-danger">
            Rp <?= number_format($total_denda ?? 0, 0, ',', '.') ?>
        </h3>
    </div>
</div>

<!-- BOTTOM SECTION -->
<div class="row mt-4">

<!-- RECENT -->
<div class="col-md-7">
    <div class="card card-pro shadow-sm">

        <div class="card-header bg-dark text-white">
            📝 Recent Peminjaman
        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($recent ?? [] as $r): ?>
                    <tr>
                        <td><?= $r['nis'] ?></td>
                        <td><?= $r['nama'] ?></td>
                        <td>
                            <span class="badge bg-info badge-soft">
                                <?= $r['status'] ?? 'dipinjam' ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>
</div>

<!-- CHART -->
<div class="col-md-5">
    <div class="card card-pro shadow-sm">
        <div class="card-header bg-primary text-white">
            📈 Grafik Peminjaman
        </div>

        <div class="card-body">
            <canvas id="chartPinjam"></canvas>
        </div>
    </div>
</div>

</div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('chartPinjam'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
        datasets: [{
            label: 'Peminjaman',
            data: <?= json_encode($chart ?? []) ?>,
            borderColor: '#0d6efd',
            backgroundColor: 'rgba(13,110,253,0.1)',
            tension: 0.4,
            fill: true,
            pointRadius: 5
        }]
    }
});
</script>

<?= $this->endSection() ?>