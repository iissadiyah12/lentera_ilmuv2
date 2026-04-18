   <a href="#">
        <b>lentera ilmu</b>App
    </a><br>

    <a href="<?= base_url('/') ?>">
        Dashboard
    </a><br>
    <?php $idu = session('id'); ?>
    <a href="<?= base_url('/buku') ?>">
        Buku
    </a><br>

    <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
        <a href="<?= base_url('/users') ?>">
            Users
        </a><br>
        <a href="<?= base_url('/rak') ?>">
            Rak
        </a><br>
        <a href="<?= base_url('/kategori') ?>">
            Kategori
        </a><br>
        <a href="<?= base_url('/penerbit') ?>">
            Penerbit
        </a><br>
        <a href="<?= base_url('/penulis') ?>">
            Penulis
        </a><br>
    <?php endif; ?>
     
        <?php $idu = session('id'); ?>
    <a href="<?= base_url('users/edit/' . $idu) ?>">
        Setting
    </a><br>
    <br>
    Masuk sebagai: <b><?= session('nama'); ?> (<?= session('role'); ?>)</b>
    <br>
    <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80" />
    <li>
        <a href="<?= base_url('/logout') ?>">Log Out</a>
    </li>