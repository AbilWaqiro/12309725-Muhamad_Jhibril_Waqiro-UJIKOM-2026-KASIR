<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #111827, #1f2937);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-landing {
            border: none;
            border-radius: 20px;
            padding: 45px 35px;
            max-width: 520px;
            width: 100%;
            text-align: center;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 25px 60px rgba(0,0,0,0.35);
            backdrop-filter: blur(10px);
        }

        .icon {
            font-size: 40px;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .title {
            font-weight: 800;
            font-size: 30px;
            color: #111827;
        }

        .subtitle {
            color: #6b7280;
            margin-top: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.6;
        }

        .btn-login {
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(13,110,253,0.25);
        }

        .footer-text {
            margin-top: 20px;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>

<body>

    <div class="card-landing">

        <div class="icon">
            <i class="bi bi-box-seam"></i>
        </div>

        <div class="title">Welcome 👋</div>

        <div class="subtitle">
            Sistem Kasir Modern & Manajemen Produk<br>
            Kelola transaksi, produk, dan laporan dengan mudah dalam satu dashboard
        </div>

        <a href="{{ route('login') }}" class="btn btn-primary w-100 btn-login">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login
        </a>

        <div class="footer-text">
            © {{ date('Y') }} Modern POS System
        </div>

    </div>

</body>
</html>