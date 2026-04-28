<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-person-vcard-fill me-2"></i>
            <h5 class="mb-0">Detail User</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered align-middle">

                    <tr>
                        <th class="w-25 bg-light">Nama</th>
                        <td><?= $user['nama'] ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Email</th>
                        <td><?= $user['email'] ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Username</th>
                        <td><?= $user['username'] ?></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Password</th>
                        <td><span class="text-muted">***</span></td>
                    </tr>

                    <tr>
                        <th class="bg-light">Role</th>
                        <td>
                            <span class="badge bg-info text-dark">
                                <?= ucfirst($user['role']) ?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th class="bg-light">Foto</th>
                        <td>
                            <?php if ($user['foto']): ?>
                                <img src="<?= base_url('uploads/user/' . $user['foto']) ?>"
                                     width="120"
                                     class="rounded-circle border shadow-sm">
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>

                </table>
            </div>

            <div class="d-flex gap-2 mt-3">

                <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <?php if (session()->get('role') == 'admin') : ?>
                    <a href="<?= base_url('users/edit/' . $user['id_user']) ?>" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                <?php endif; ?>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>