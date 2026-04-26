<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <i class="bi bi-pencil-square me-2"></i>
                    <h5 class="mb-0">Edit Kategori</h5>
                </div>

                <div class="card-body">

                    <form action="/kategori/update/<?= $kategori['id_kategori'] ?>" method="post">

                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text"
                                   name="nama_kategori"
                                   class="form-control"
                                   value="<?= $kategori['nama_kategori'] ?>"
                                   required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">

                            <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Update
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>