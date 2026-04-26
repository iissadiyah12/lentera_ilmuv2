<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd 0%, #6f42c1 50%, #20c997 100%);
            height: 100vh;
            overflow: hidden;
        }

        .login-card {
            border: none;
            border-radius: 18px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            text-align: center;
            padding: 25px;
        }

        .login-header h3 {
            margin: 0;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .btn-login {
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            border: none;
        }

        .btn-login:hover {
            opacity: 0.9;
        }

        .small-links a {
            text-decoration: none;
            font-size: 13px;
        }

        .floating-icon {
            font-size: 40px;
            color: white;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="col-md-4">

        <div class="text-center mb-3 text-white">
            <i class="bi bi-book-half floating-icon"></i>
            <h4 class="fw-bold">Lentera Ilmu</h4>
            <small>Sistem Perpustakaan Digital</small>
        </div>

        <div class="card login-card">

            <div class="login-header">
                <h3><i class="bi bi-box-arrow-in-right"></i> Login</h3>
            </div>

            <div class="card-body p-4">

                <!-- ALERT -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('salahpw') ?></div>
                <?php endif; ?>

                <!-- FORM -->
                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>

                    <button class="btn btn-login w-100 text-white">
                        <i class="bi bi-box-arrow-in-right"></i> Sign In
                    </button>

                </form>

                <!-- LINKS -->
                <div class="text-center mt-3 small-links">

                    <a href="<?= base_url('users/create') ?>" class="text-success me-2">
                        <i class="bi bi-person-plus"></i> Daftar
                    </a>

                    <a href="<?= base_url('restore') ?>" class="text-danger">
                        <i class="bi bi-database"></i> Restore DB
                    </a>

                </div>

            </div>
        </div>

        <div class="text-center mt-3 text-white" style="font-size: 12px;">
            © <?= date('Y') ?> Lentera Ilmu - All Rights Reserved
        </div>

    </div>

</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>