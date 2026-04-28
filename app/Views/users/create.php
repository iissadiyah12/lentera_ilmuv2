<!-- app/Views/users/create.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - Lentera Ilmu</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body{
            margin:0;
            padding:0;
            min-height:100vh;
            background:#f8f9fa;
            overflow:hidden;
            font-family:Segoe UI, sans-serif;
            position:relative;
        }

        body::before{
            content:'';
            position:absolute;
            left:-180px;
            top:0;
            width:420px;
            height:100%;
            background:linear-gradient(180deg,#0d6efd,#20c997);
            clip-path:polygon(0 0,100% 0,65% 50%,100% 100%,0 100%);
            opacity:.9;
        }

        body::after{
            content:'';
            position:absolute;
            left:-120px;
            top:0;
            width:320px;
            height:100%;
            background:rgba(255,255,255,.15);
            clip-path:polygon(0 0,100% 0,65% 50%,100% 100%,0 100%);
        }

        .brand{
            position:absolute;
            top:18px;
            left:22px;
            z-index:5;
            font-size:22px;
            font-weight:700;
            color:#0d6efd;
        }

        .register-wrapper{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
            z-index:2;
        }

        .register-card{
            width:430px;
            max-height:95vh;
            overflow-y:auto;
            background:#fff;
            border:1px solid #e9ecef;
            border-radius:10px;
            box-shadow:0 8px 25px rgba(0,0,0,.08);
            padding:28px;
        }

        .register-title{
            font-size:28px;
            font-weight:700;
        }

        .form-label{
            font-size:13px;
            font-weight:600;
            margin-bottom:6px;
        }

        .form-control,
        .form-select{
            height:45px;
            border-radius:6px;
            font-size:14px;
        }

        .btn-save{
            height:45px;
            border-radius:6px;
            font-weight:600;
        }

        .footer-left{
            position:absolute;
            left:20px;
            bottom:18px;
            font-size:12px;
            color:#6c757d;
            z-index:5;
        }

        .footer-right{
            position:absolute;
            right:20px;
            bottom:18px;
            font-size:12px;
            z-index:5;
        }

        .footer-right a{
            text-decoration:none;
            color:#0d6efd;
            margin-left:10px;
        }

        @media(max-width:768px){
            body::before,
            body::after{
                display:none;
            }

            .register-card{
                width:95%;
            }

            .footer-left,
            .footer-right{
                display:none;
            }
        }
    </style>
</head>

<body>

<div class="brand">
    <i class="bi bi-book-half"></i> Lentera Ilmu
</div>

<div class="register-wrapper">

    <div class="register-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="register-title">Daftar</div>

            <a href="<?= base_url('login') ?>" class="small text-decoration-none">
                Sudah punya akun?
            </a>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger py-2">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="hidden" name="role" value="anggota">
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Profil</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak upload foto</small>
            </div>

            <button type="submit" class="btn btn-primary btn-save w-100">
                <i class="bi bi-person-plus"></i> Daftar Sekarang
            </button>

        </form>

    </div>

</div>

<div class="footer-left">
    Copyright © <?= date('Y') ?> Lentera Ilmu
</div>

<div class="footer-right">
    <a href="#">Home</a>
    <a href="#">Privacy</a>
    <a href="#">Contact</a>
</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>