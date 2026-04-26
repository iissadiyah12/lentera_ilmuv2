<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/bootstrap-icons/font/bootstrap-icons.css') ?>">

<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="bi bi-people-fill"></i> Data Users
                </h4>
            </div>

            <!-- FORM PENCARIAN & FILTER -->
            <form method="get" action="" class="row g-2 align-items-center mb-3">

                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Cari nama..."
                        value="<?= $_GET['keyword'] ?? '' ?>">
                </div>

                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">-- Semua Role --</option>
                        <option value="admin" <?= (($_GET['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= (($_GET['role'] ?? '') == 'petugas') ? 'selected' : '' ?>>Petugas</option>
                        <option value="anggota" <?= (($_GET['role'] ?? '') == 'anggota') ? 'selected' : '' ?>>Anggota</option>
                    </select>
                </div>

                <div class="col-md-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-repeat"></i> Reset
                    </a>

                    <a href="<?= base_url('users/print?' . http_build_query($_GET)) ?>"
                        target="_blank" class="btn btn-success">
                        <i class="bi bi-printer"></i> Print
                    </a>
                </div>

            </form>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table border="1" cellpadding="5" cellspacing="0"
                    class="table table-bordered table-striped table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Foto</th>
                            <?php if (session()->get('role') == 'admin') : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php $no = 1 + (5 * ($pager->getCurrentPage() - 1)); ?>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $u['nama'] ?></td>
                                    <td><?= $u['email'] ?></td>
                                    <td><?= $u['username'] ?></td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?= ucfirst($u['role']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($u['foto']): ?>
                                            <img src="<?= base_url('uploads/users/' . $u['foto']) ?>"
                                                width="60" class="rounded-circle border">
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                   </td>

                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <td class="text-nowrap">

                                                <!-- DETAIL -->
                                                <a class="btn btn-sm btn-info"
                                                href="<?= base_url('users/detail/' . $u['id_user']) ?>"
                                                title="Detail">
                                                    <i class="bi bi-eye"></i> Detail
                                                </a>

                                                <!-- EDIT -->
                                                <a class="btn btn-sm btn-warning"
                                                href="<?= base_url('users/edit/' . $u['id_user']) ?>"
                                                title="Edit">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>

                                                <!-- WHATSAPP -->
                                                <a class="btn btn-sm btn-success"
                                                href="<?= base_url('users/wa/' . $u['id_user']) ?>"
                                                target="_blank"
                                                title="WhatsApp">
                                                    <i class="bi bi-whatsapp"></i> WA
                                                </a>

                                                <!-- HAPUS -->
                                                <a class="btn btn-sm btn-danger"
                                                href="<?= base_url('users/delete/' . $u['id_user']) ?>"
                                                onclick="return confirm('Hapus user ini?')"
                                                title="Hapus">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>

                                            </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada data user
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                <?= $pager->links() ?>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>