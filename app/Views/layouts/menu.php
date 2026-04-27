<div class="p-3">

    <!-- BRAND -->
    <a href="#" class="d-flex align-items-center mb-3 text-decoration-none">
        <i class="bi bi-book-half fs-4 me-2"></i>
        <span class="fs-5 fw-bold">Lentera Ilmu App</span>
    </a>

    <hr>

    <!-- MENU -->
    <ul class="nav flex-column">

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('/') ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('/buku') ?>">
                <i class="bi bi-book me-2"></i> Buku
            </a>
        </li>

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('/peminjaman') ?>">
                <i class="bi bi-journal-arrow-up me-2"></i> Peminjaman
            </a>
        </li>


        <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>

        <hr>

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('/pengembalian') ?>">
                <i class="bi bi-journal-check me-2"></i> Pengembalian
            </a>
        </li>

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('/users') ?>">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('/rak') ?>">
                <i class="bi bi-archive me-2"></i> Rak
            </a>
        </li>

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('/kategori') ?>">
                <i class="bi bi-tags me-2"></i> Kategori
            </a>
        </li>

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('/penerbit') ?>">
                <i class="bi bi-building me-2"></i> Penerbit
            </a>
        </li>

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('/penulis') ?>">
                <i class="bi bi-person me-2"></i> Penulis
            </a>
        </li>

        <li class="nav-item mb-1">
            <a class="nav-link" href="<?= base_url('users/edit/' . session('id')) ?>">
                <i class="bi bi-gear me-2"></i> Setting
            </a>
        </li>

        <?php endif; ?>

    </ul>

    <hr>

    <!-- USER INFO -->
    <div class="mb-3">
        <i class="bi bi-person-circle"></i>
        <div class="mt-1">
            Masuk sebagai:<br>
            <b><?= session('nama'); ?> (<?= session('role'); ?>)</b>
        </div>

        <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>"<!-- STEP 6 = AUTO ACTIVE MENU -->
<!-- Tambahkan class active otomatis -->
<!-- JANGAN UBAH STRUKTUR KODE KAMU, hanya tambah class -->

<!-- CONTOH PAKAI DI SIDEBAR / LIST MENU -->

<li class="nav-item mb-1">
    <a class="nav-link <?= uri_string() == '' ? 'active' : '' ?>"
       href="<?= base_url('/') ?>">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>
</li>

<li class="nav-item mb-1">
    <a class="nav-link <?= uri_string() == 'buku' ? 'active' : '' ?>"
       href="<?= base_url('/buku') ?>">
        <i class="bi bi-book me-2"></i> Buku
    </a>
</li>

<li class="nav-item mb-1">
    <a class="nav-link <?= uri_string() == 'peminjaman' ? 'active' : '' ?>"
       href="<?= base_url('/peminjaman') ?>">
        <i class="bi bi-journal-arrow-up me-2"></i> Peminjaman
    </a>
</li>

<li class="nav-item mb-1">
    <a class="nav-link <?= uri_string() == 'pengembalian' ? 'active' : '' ?>"
       href="<?= base_url('/pengembalian') ?>">
        <i class="bi bi-journal-check me-2"></i> Pengembalian
    </a>
</li>

<li class="nav-item mb-1">
    <a class="nav-link <?= uri_string() == 'users' ? 'active' : '' ?>"
       href="<?= base_url('/users') ?>">
        <i class="bi bi-people me-2"></i> Users
    </a>
</li>

<li class="nav-item mb-1">
    <a class="nav-link <?= uri_string() == 'rak' ? 'active' : '' ?>"
       href="<?= base_url('/rak') ?>">
        <i class="bi bi-grid me-2"></i> Rak
    </a>
</li>

<li class="nav-item mb-1">
    <a class="nav-link <?= uri_string() == 'kategori' ? 'active' : '' ?>"
       href="<?= base_url('/kategori') ?>">
        <i class="bi bi-tags me-2"></i> Kategori
    </a>
</li>

<li class="nav-item mb-1">
    <a class="nav-link <?= uri_string() == 'penerbit' ? 'active' : '' ?>"
       href="<?= base_url('/penerbit') ?>">
        <i class="bi bi-building me-2"></i> Penerbit
    </a>
</li>

<li class="nav-item mb-1">
    <a class="nav-link <?= uri_string() == 'penulis' ? 'active' : '' ?>"
       href="<?= base_url('/penulis') ?>">
        <i class="bi bi-pencil-square me-2"></i> Penulis
    </a>
</li>
             class="img-thumbnail mt-2"
             style="width:80px;height:80px;object-fit:cover;">
    </div>

    <!-- LOGOUT -->
    <a href="<?= base_url('/logout') ?>" class="btn btn-outline-danger w-100 mb-2">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>

    <!-- BACKUP -->
    <?php if (session()->get('role') == 'admin') : ?>
        <a href="<?= base_url('/backup') ?>" class="btn btn-success w-100">
            <i class="bi bi-database-down"></i> Backup Database
        </a>
    <?php endif; ?>

</div>