<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <i class="bi bi-pencil-square me-2"></i>
                    <h5 class="mb-0">Edit User</h5>
                </div>

                <div class="card-body">

                    <form action="<?= base_url('users/update/' . $user['id_user']) ?>" 
                          method="post" 
                          enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control"
                                   value="<?= $user['nama'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control"
                                   value="<?= $user['email'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control"
                                   value="<?= $user['username'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak diubah</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="petugas" <?= $user['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                                <option value="anggota" <?= $user['role'] == 'anggota' ? 'selected' : '' ?>>Anggota</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="foto" class="form-control">

                            <div class="mt-2">
                                <small class="text-muted">Foto sekarang:</small><br>

                                <?php if ($user['foto']): ?>
                                    <img src="<?= base_url('uploads/users/' . $user['foto']) ?>"
                                         width="100"
                                         class="rounded border shadow-sm mt-1">
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">

                            <a href="<?= base_url('users') ?>" class="btn btn-secondary">
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