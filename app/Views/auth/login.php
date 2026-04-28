<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Lentera Ilmu</title>

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

        /* Background Shape kiri */
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

        .login-wrapper{
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
            z-index:2;
        }

        .login-card{
            width:360px;
            background:#fff;
            border:1px solid #e9ecef;
            border-radius:10px;
            box-shadow:0 8px 25px rgba(0,0,0,.08);
            padding:28px;
        }

        .login-title{
            font-size:30px;
            font-weight:700;
            color:#212529;
        }

        .form-label{
            font-size:13px;
            font-weight:600;
            margin-bottom:6px;
        }

        .form-control{
            height:45px;
            border-radius:6px;
            font-size:14px;
        }

        .btn-login{
            height:45px;
            border-radius:6px;
            font-weight:600;
            background:#0d6efd;
            border:none;
        }

        .btn-login:hover{
            background:#0b5ed7;
        }

        .divider{
            text-align:center;
            position:relative;
            margin:18px 0;
            font-size:13px;
            color:#6c757d;
        }

        .divider::before{
            content:'';
            position:absolute;
            left:0;
            top:50%;
            width:40%;
            height:1px;
            background:#dee2e6;
        }

        .divider::after{
            content:'';
            position:absolute;
            right:0;
            top:50%;
            width:40%;
            height:1px;
            background:#dee2e6;
        }

        .social-btn{
            border:1px solid #dee2e6;
            font-size:13px;
            border-radius:6px;
            width:100%;
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

            .login-card{
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

<div class="login-wrapper">

    <div class="login-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="login-title">Login</div>
        </div>

         <!-- ALERT -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('salahpw')): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-lock"></i>
                    <?= session()->getFlashdata('salahpw') ?>
                </div>
            <?php endif; ?>

            <!-- FORM -->
            <form action="<?= base_url('/proses-login') ?>" method="post">

                <div class="mb-3">
                    <label class="form-label">Username</label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>

                        <input type="text"
                               name="username"
                               class="form-control"
                               placeholder="Masukkan username"
                               required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control"
                               placeholder="Masukkan password"
                               required>

                        <span class="input-group-text show-pass" onclick="togglePassword()">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-3">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label small">
                            Remember me
                        </label>
                    </div>

                    <a href="<?= base_url('restore') ?>" class="mini-link">
                        Restore DB
                    </a>
                </div>

                <button class="btn btn-login text-white w-100">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Sign In
                </button>

            </form>

            <!-- REGISTER -->
            <div class="text-center mt-4">
                <span class="footer-text">Belum punya akun?</span><br>

                <a href="<?= base_url('users/create') ?>"
                   class="btn btn-outline-success btn-sm mt-2">
                    <i class="bi bi-person-plus"></i>
                    Daftar Sekarang
                </a><br>

                <br>

                 <!-- FOOTER -->
                <div class="text-center pb-1 footer-text">
                    © <?= date('Y') ?> Lentera Ilmu App
                </div>
            </div>

        </div>

       

         

        </div>

</div>



<div class="footer-right">
    <a href="#">Home</a>
    <a href="#">Privacy Policy</a>
    <a href="#">Contact</a>
</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>