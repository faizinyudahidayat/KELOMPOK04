<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemulihan Akun | Inventaris UNIBA</title>
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

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #94a3b8; /* Warna abu terang agar terbaca */
            margin-bottom: 0.5rem;
        }

        /* PERBAIKAN TEKS DESKRIPSI */
        .description-text {
            color: #cbd5e1; /* Warna putih keabuan agar kontras */
            font-size: 0.9rem;
            line-height: 1.5;
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

        .back-link {
            color: #60a5fa;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .back-link:hover {
            color: #93c5fd;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="login-card">
                    <h3 class="fw-bold mb-2">Pemulihan Akun</h3>

                    <p class="description-text mb-4">
                        Masukkan email Anda untuk menerima link reset password.
                    </p>

                    @if(session('success'))
                        <div class="alert alert-success border-0 small py-2 rounded-3 mb-4">
                            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">EMAIL ADDRESS</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@uniba.ac.id" required autofocus>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 shadow mb-4">
                            KIRIM LINK RESET
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="back-link">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
