<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="main-content">

    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="bi bi-building text-primary me-2"></i>
                Edit Penerbit
            </h2>

            <a href="<?= base_url('penerbit') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

            <form action="<?= base_url('penerbit/update/' . $p['id_penerbit']) ?>" method="post">    
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Nama Penerbit
                </label>
                <input type="text"
                       name="nama_penerbit"
                       class="form-control"
                       value="<?= $penerbit['nama_penerbit'] ?>"
                       placeholder="Masukkan nama penerbit"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Alamat
                </label>
                <input type="text"
                       name="alamat"
                       class="form-control"
                       value="<?= $penerbit['alamat'] ?>"
                       placeholder="Masukkan alamat penerbit"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Update
            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>