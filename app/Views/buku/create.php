<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-success text-white d-flex align-items-center">
                    <i class="bi bi-book-half me-2"></i>
                    <h5 class="mb-0">Tambah Buku</h5>
                </div>

                <div class="card-body">

                    <!-- ERROR -->
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('buku/store') ?>"
                          method="post"
                          enctype="multipart/form-data">

                        <div class="row">

                            <!-- JUDUL -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>

                            <!-- ISBN -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ISBN</label>
                                <input type="text" name="isbn" class="form-control">
                            </div>

                            <!-- KATEGORI -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="id_kategori" class="form-select">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori as $k): ?>
                                        <option value="<?= $k['id_kategori'] ?>">
                                            <?= $k['nama_kategori'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- PENULIS -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penulis</label>
                                <select name="id_penulis" class="form-select">
                                    <?php foreach($penulis as $p): ?>
                                        <option value="<?= $p['id_penulis'] ?>">
                                            <?= $p['nama_penulis'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- PENERBIT -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penerbit</label>
                                <select name="id_penerbit" class="form-select">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($penerbit as $p): ?>
                                        <option value="<?= $p['id_penerbit'] ?>">
                                            <?= $p['nama_penerbit'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- RAK -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rak</label>
                                <select name="id_rak" class="form-select">
                                    <option value="">-- Pilih Rak --</option>
                                    <?php foreach ($rak as $r): ?>
                                        <option value="<?= $r['id_rak'] ?>">
                                            <?= $r['nama_rak'] ?> - <?= $r['lokasi'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- TAHUN -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tahun Terbit</label>
                                <input type="number" name="tahun_terbit" class="form-control">
                            </div>

                            <!-- JUMLAH -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control">
                            </div>

                            <!-- TERSEDIA -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tersedia</label>
                                <input type="number" name="tersedia" class="form-control">
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>

                            <!-- COVER -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cover</label>
                                <input type="file" name="cover" class="form-control">
                            </div>

                            <!-- PDF -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">File Buku (PDF)</label>
                                <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex justify-content-between mt-3">

                            <a href="<?= base_url('buku') ?>" class="btn btn-secondary">
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