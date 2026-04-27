<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <i class="bi bi-pencil-square me-2"></i>
                    <h5 class="mb-0">Edit Buku</h5>
                </div>

                <div class="card-body">

                    <form method="post"
                          action="<?= base_url('buku/update/' . $buku['id_buku']) ?>"
                          enctype="multipart/form-data">

                        <div class="row">

                            <!-- JUDUL -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control"
                                       value="<?= $buku['judul'] ?>">
                            </div>

                            <!-- ISBN -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ISBN</label>
                                <input type="text" name="isbn" class="form-control"
                                       value="<?= $buku['isbn'] ?>">
                            </div>

                            <!-- KATEGORI -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="id_kategori" class="form-select">
                                    <?php foreach ($kategori as $k): ?>
                                        <option value="<?= $k['id_kategori'] ?>"
                                            <?= $buku['id_kategori'] == $k['id_kategori'] ? 'selected' : '' ?>>
                                            <?= $k['nama_kategori'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- PENULIS -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penulis</label>
                                <select name="id_penulis" class="form-select">
                                    <?php foreach ($penulis as $p): ?>
                                        <option value="<?= $p['id_penulis'] ?>"
                                            <?= $buku['id_penulis'] == $p['id_penulis'] ? 'selected' : '' ?>>
                                            <?= $p['nama_penulis'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- PENERBIT -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penerbit</label>
                                <select name="id_penerbit" class="form-select">
                                    <?php foreach ($penerbit as $p): ?>
                                        <option value="<?= $p['id_penerbit'] ?>"
                                            <?= $buku['id_penerbit'] == $p['id_penerbit'] ? 'selected' : '' ?>>
                                            <?= $p['nama_penerbit'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- RAK -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rak</label>
                                <select name="id_rak" class="form-select">
                                    <?php foreach ($rak as $r): ?>
                                        <option value="<?= $r['id_rak'] ?>"
                                            <?= isset($buku['id_rak']) && $buku['id_rak'] == $r['id_rak'] ? 'selected' : '' ?>>
                                            <?= $r['nama_rak'] ?> - <?= $r['lokasi'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- TAHUN -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tahun</label>
                                <input type="number" name="tahun_terbit" class="form-control"
                                       value="<?= $buku['tahun_terbit'] ?>">
                            </div>

                            <!-- JUMLAH -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control"
                                       value="<?= $buku['jumlah'] ?>">
                            </div>

                            <!-- TERSEDIA -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tersedia</label>
                                <input type="number" name="tersedia" class="form-control"
                                       value="<?= $buku['tersedia'] ?>">
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="3"><?= $buku['deskripsi'] ?></textarea>
                            </div>

                            <!-- COVER -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cover</label>
                                <input type="file" name="cover" class="form-control">

                                <div class="mt-2">
                                    <?php if ($buku['cover']): ?>
                                        <?php $ext = pathinfo($buku['cover'], PATHINFO_EXTENSION); ?>

                                        <?php if (in_array($ext, ['jpg','jpeg','png','gif'])): ?>
                                            <img src="<?= base_url('uploads/buku/' . $buku['cover']) ?>"
                                                 width="100"
                                                 class="rounded border">
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- FILE PDF -->
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