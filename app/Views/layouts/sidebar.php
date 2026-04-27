<div class="sidebar">

    <!-- LOGO -->
    <div class="logo">
        <i class="bi bi-book-half"></i>
        <span>Lentera Ilmu</span>
    </div>

    <!-- MENU -->
    <ul class="menu">

        <li>
            <a href="<?= base_url('/') ?>">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="<?= base_url('/buku') ?>">
                <i class="bi bi-book"></i>
                Buku
            </a>
        </li>

        <li>
            <a href="<?= base_url('/peminjaman') ?>">
                <i class="bi bi-journal-arrow-up"></i>
                Peminjaman
            </a>
        </li>

<?php if(session()->get('role') != 'anggota'): ?>

        <li>
            <a href="<?= base_url('/pengembalian') ?>">
                <i class="bi bi-journal-check"></i>
                Pengembalian
            </a>
        </li>

        <li>
            <a href="<?= base_url('/users') ?>">
                <i class="bi bi-people"></i>
                Users
            </a>
        </li>

        <li>
            <a href="<?= base_url('/kategori') ?>">
                <i class="bi bi-tags"></i>
                Kategori
            </a>
        </li>

        <li>
            <a href="<?= base_url('/rak') ?>">
                <i class="bi bi-grid"></i>
                Rak
            </a>
        </li>

<?php endif; ?>

    </ul>

</div>