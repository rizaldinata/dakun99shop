<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Dakun99 Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            min-height: 100vh;
            padding: 15px;
        }

        .login-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            margin: auto;
            border: 1px solid #e5e7eb;
            width: 100%;
        }

        .logo-section {
            background-color: #fef3c7;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .logo-section img {
            max-width: 180px;
            height: auto;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .logo-title {
            font-size: 26px;
            font-weight: bold;
            color: #78350f;
            margin-bottom: 8px;
        }

        .logo-subtitle {
            font-size: 14px;
            color: #92400e;
            line-height: 1.4;
        }

        .form-section {
            padding: 60px 40px;
            background-color: #ffffff;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            color: #92400e;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-control {
            background-color: #fefce8;
            border: 1px solid #d1d5db;
            color: #111827;
            padding: 12px 16px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
            background-color: #fefce8;
        }

        .btn-login {
            background-color: #f59e0b;
            color: #fff;
            font-weight: bold;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 6px;
        }

        .btn-login:hover {
            background-color: #d97706;
            color: #fff;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: none;
            font-size: 14px;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border: none;
            font-size: 14px;
        }

        .copyright {
            text-align: center;
            color: #6b7280;
            margin-top: 40px;
            font-size: 12px;
            line-height: 1.4;
        }

        .register-link {
            color: #92400e;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link:hover {
            color: #78350f;
            text-decoration: underline;
        }

        /* Responsive Styles for Mobile */
        @media (max-width: 768px) {
            .login-container {
                padding: 10px;
                min-height: 100vh;
            }

            .login-card {
                flex-direction: column !important;
                margin: 0;
                border-radius: 8px;
                min-height: calc(100vh - 20px);
            }

            .logo-section {
                padding: 30px 20px;
                order: 1;
            }

            .logo-section img {
                max-width: 100px;
                margin-bottom: 15px;
            }

            .logo-title {
                font-size: 20px;
                margin-bottom: 6px;
            }

            .logo-subtitle {
                font-size: 12px;
            }

            .form-section {
                padding: 30px 20px;
                order: 2;
                flex: 1;
            }

            .form-title {
                font-size: 20px;
                margin-bottom: 25px;
                text-align: center;
            }

            .form-control {
                font-size: 16px;
                padding: 14px 16px;
                border-radius: 6px;
            }

            .btn-login {
                font-size: 16px;
                padding: 14px 24px;
                width: 100%;
            }

            .copyright {
                font-size: 11px;
                margin-top: 20px;
                padding-bottom: 10px;
            }

            .mb-3,
            .mb-4 {
                margin-bottom: 1.5rem !important;
            }

            .alert {
                font-size: 13px;
                padding: 10px 15px;
            }
        }

        /* Extra small devices */
        @media (max-width: 480px) {
            .login-container {
                padding: 5px;
            }

            .login-card {
                border-radius: 6px;
                margin: 0;
            }

            .logo-section {
                padding: 25px 15px;
            }

            .form-section {
                padding: 25px 15px;
            }

            .logo-title {
                font-size: 18px;
            }

            .logo-subtitle {
                font-size: 11px;
            }

            .form-title {
                font-size: 18px;
            }

            .form-control {
                font-size: 16px;
                padding: 12px 14px;
            }

            .btn-login {
                padding: 12px 20px;
            }
        }

        /* Landscape orientation on mobile */
        @media (max-width: 768px) and (orientation: landscape) {
            .login-container {
                min-height: 100vh;
            }

            .logo-section {
                padding: 20px;
            }

            .form-section {
                padding: 20px;
            }

            .logo-section img {
                max-width: 80px;
            }

            .logo-title {
                font-size: 18px;
            }

            .logo-subtitle {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid login-container d-flex align-items-center justify-content-center">
        <div class="login-card d-flex flex-column-reverse flex-md-row">
            <!-- Logo & Brand -->
            <div class="col-md-5 logo-section">
                <img src="{{ asset('images/dakun99shop.png') }}" alt="Logo Dakun99 Shop">
                <div class="logo-title">Dakun99 Shop</div>
                <div class="logo-subtitle">E-Commerce Senjata Api Terpercaya</div>
            </div>

            <!-- Login Form -->
            <div class="col-md-7 form-section">
                <h2 class="form-title">Masuk ke Akun Anda</h2>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control" required autofocus
                            placeholder="admin@dakun99.com" value="{{ old('email') }}">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" name="password" id="password" class="form-control" required
                            placeholder="********">
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-login">Masuk</button>
                    </div>

                    <div class="text-center">
                        <span class="text-muted">Belum punya akun?</span>
                        <a href="{{ route('register') }}" class="register-link">
                            Daftar sekarang
                        </a>
                    </div>
                </form>

                <div class="copyright">
                    &copy; {{ date('Y') }} Dakun99 Shop - Hak Cipta Dilindungi
                </div>
            </div>
        </div>
    </div>

</body>

</html>
