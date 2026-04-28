<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-5">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Lentera Ilmu</title>

<link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

</head>
<body>

<?= $this->include('layouts/sidebar') ?>

<div class="main-content">

    <div class="topbar shadow-sm">

        <div class="dropdown ms-auto">

            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown">

                <img src="<?= base_url('uploads/users/' . session('foto')) ?>"
                     class="profile-img me-2">

                <span><?= session('nama') ?></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item"
                       href="<?= base_url('users/detail/' . session('id')) ?>">
                       <i class="bi bi-person"></i> Profile
                    </a>
                </li>
                
                <li>
                    <a class="dropdown-item text-danger"
                       href="<?= base_url('logout') ?>">
                       <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>

                


            </ul>

        </div>

    </div>

    <div class="content-area">
        <?= $this->renderSection('content') ?>
    </div>

</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>