<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password Baru | UNIBA</title>
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

        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .brand-logo {
            width: 50px;
            height: 50px;
            background: rgba(59, 130, 246, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin: 0 auto 1rem;
            color: var(--accent-color);
            font-size: 1.5rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            color: #94a3b8;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .form-control {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.95rem;
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
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="login-card">
                    <div class="brand-logo">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>

                    <h3 class="fw-bold mb-1 text-center">Password Baru</h3>
                    <p class="text-center text-muted small mb-4">Buat password yang kuat untuk keamanan akun Anda.</p>

                    @if($errors->any())
                        <div class="alert alert-danger border-0 small py-2 rounded-3 mb-4">
                            <i class="bi bi-exclamation-circle me-2"></i> {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label class="form-label">Email Konfirmasi</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ session('email') ?? old('email') }}"
                                   placeholder="Masukkan email Anda" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 shadow">
                            UPDATE PASSWORD <i class="bi bi-check-circle ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
