<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-success text-white d-flex align-items-center">
                    <i class="bi bi-person-plus-fill me-2"></i>
                    <h5 class="mb-0">Tambah Petugas</h5>
                </div>

                <div class="card-body">

                    <form method="post" action="<?= base_url('petugas/store') ?>">

                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text"
                                   name="jabatan"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">

                            <a href="<?= base_url('petugas') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>