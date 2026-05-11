<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Inventaris UNIBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #0f172a; color: white; font-family: 'Inter', sans-serif; height: 100vh; display: flex; align-items: center; }
        .login-card { background: #1e293b; border: 1px solid #334155; border-radius: 20px; padding: 40px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.5); }
        .form-control { background: #0f172a; border: 1px solid #334155; color: white; padding: 12px; }
        .form-control:focus { background: #0f172a; border-color: #3b82f6; color: white; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2); }
        .btn-primary { background: #3b82f6; border: none; padding: 12px; border-radius: 10px; font-weight: bold; }
        .btn-primary:hover { background: #2563eb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="login-card text-center">
                    <i class="bi bi-box-seam-fill text-primary" style="font-size: 3rem;"></i>
                    <h3 class="fw-bold mt-3">INV-UNIBA</h3>
                    <p class="text-muted mb-4">Silakan masuk ke akun Anda</p>

                    @if($errors->any())
                        <div class="alert alert-danger small py-2">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3 text-start">
                            <label class="form-label small">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@uniba.ac.id" required>
                        </div>
                        <div class="mb-4 text-start">
                            <label class="form-label small">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
