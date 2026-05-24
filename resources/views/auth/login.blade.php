<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Inventaris UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --accent-color: #3b82f6;
            --bg-dark: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
        }

        body {
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .bg-decoration {
            position: absolute;
            width: 300px;
            height: 300px;
            background: var(--accent-color);
            filter: blur(120px);
            opacity: 0.15;
            z-index: -1;
            border-radius: 50%;
        }

        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .brand-logo {
            width: 64px;
            height: 64px;
            background: rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            margin: 0 auto 1.5rem;
            color: var(--accent-color);
            font-size: 2rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #64748b;
            border-radius: 12px 0 0 12px;
        }

        .form-control {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 12px 16px;
            border-radius: 0 12px 12px 0;
            font-size: 0.95rem;
        }

        /* Penyesuaian khusus untuk input password agar tidak terpotong tombol mata */
        .input-password-custom {
            border-radius: 0 !important;
        }

        .form-control:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: var(--accent-color);
            color: white;
            box-shadow: none;
        }

        .btn-primary {
            background: var(--accent-color);
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-primary:hover {
            background: #2563eb;
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4);
            transform: scale(1.02);
        }

        .forgot-link {
            color: #60a5fa;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .forgot-link:hover {
            color: #93c5fd;
            text-decoration: underline;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body>
    <div class="bg-decoration" style="top: 10%; right: 20%;"></div>
    <div class="bg-decoration" style="bottom: 10%; left: 20%;"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                <div class="login-card">
                    <div class="brand-logo">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>

                    <div class="text-center mb-4">
                        <h3 class="fw-bold m-0">INVENTARIS</h3>
                        <p class="text-muted small mt-1">Sistem Inventaris Kelompok 04</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success small py-2 rounded-3 mb-4">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger border-0 small py-2 rounded-3 mb-4" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                            <i class="bi bi-exclamation-circle me-2"></i> {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">EMAIL ADDRESS</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="admin@uniba.ac.id" value="{{ old('email') }}" required autofocus style="border-radius: 0 12px 12px 0;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label mb-0">PASSWORD</label>
                                <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password?</a>
                            </div>
                            <div class="input-group mt-1">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <!-- Tambahkan sedikit CSS inline untuk merapikan border radius tengah -->
                                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required style="border-radius: 0;">
                                <!-- Tombol Mata yang sudah diperbaiki -->
                                <button class="btn btn-outline-secondary border-start-0 text-white" type="button" onclick="togglePassword()" style="border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 0 12px 12px 0; background: rgba(255, 255, 255, 0.1);">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 shadow">
                            SUBMIT<i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted small">&copy; 2026 Informatika - <strong>UNIBA Madura</strong></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>
</html>
