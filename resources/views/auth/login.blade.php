<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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

        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 20px;
            padding: 35px 30px;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 25px 60px rgba(0,0,0,0.35);
            backdrop-filter: blur(10px);
        }

        .icon {
            font-size: 40px;
            color: #0d6efd;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-title {
            font-weight: 800;
            font-size: 26px;
            text-align: center;
            color: #111827;
        }

        .login-subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 25px;
            font-size: 13px;
        }

        label {
            font-weight: 600;
            color: #374151;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-login {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(13,110,253,0.25);
        }

        .error-box {
            border-radius: 12px;
        }

        .footer-text {
            margin-top: 15px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <div class="icon">
            <i class="bi bi-shield-lock"></i>
        </div>

        <div class="login-title">Welcome Back</div>

        <div class="login-subtitle">
            Login ke sistem kasir modern kamu
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn btn-primary w-100 btn-login">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </button>
        </form>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="alert alert-danger mt-3 error-box">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="footer-text">
            © {{ date('Y') }} Modern POS System
        </div>

    </div>

</body>
</html>