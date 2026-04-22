<a href="#">
    <i class="bi bi-book-half"></i> 
    <b>lentera ilmu</b> App
</a><br>

<a href="<?= base_url('/') ?>">
    <i class="bi bi-speedometer2"></i> Dashboard
</a><br>
<a href="<?= base_url('/buku') ?>">
        <i class="bi bi-book"></i> Buku
    </a><br>

<a href="<?= base_url('/peminjaman') ?>">
    <i class="bi bi-journal-arrow-up"></i> Peminjaman
</a><br>

<?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>

 
<?php $idu = session('id'); ?>
    <a href="<?= base_url('/pengembalian') ?>">
        <i class="bi bi-journal-check"></i> Pengembalian
    </a><br>
    <a href="<?= base_url('/users') ?>">
        <i class="bi bi-people"></i> Users
    </a><br>

    <a href="<?= base_url('/rak') ?>">
        <i class="bi bi-archive"></i> Rak
    </a><br>

    <a href="<?= base_url('/kategori') ?>">
        <i class="bi bi-tags"></i> Kategori
    </a><br>

    <a href="<?= base_url('/penerbit') ?>">
        <i class="bi bi-building"></i> Penerbit
    </a><br>

    <a href="<?= base_url('/penulis') ?>">
        <i class="bi bi-person"></i> Penulis
    </a><br>
    <a href="<?= base_url('users/edit/' . $idu) ?>">
        <i class="bi bi-gear"></i> Setting
    </a><br>
<?php endif; ?>

<?php $idu = session('id'); ?>


<br>

<i class="bi bi-person-circle"></i> 
Masuk sebagai: <b><?= session('nama'); ?> (<?= session('role'); ?>)</b>

<br>

<img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80" />

<li>
    <a href="<?= base_url('/logout') ?>">
        <i class="bi bi-box-arrow-right"></i> Log Out
    </a>
</li>

<?php if (session()->get('role') == 'admin') : ?>
    <a href="<?= base_url('/backup') ?>" class="btn btn-success">
        <i class="bi bi-database-down"></i> Backup Database
    </a>
<?php endif; ?>