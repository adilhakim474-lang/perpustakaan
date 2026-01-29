<!DOCTYPE html>
<html>
<head>
    <title>Register Perpustakaan</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h3 class="text-center mb-3">📝 Register Akun</h3>

        <form method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button class="btn btn-success w-100">Register</button>
        </form>

        <p class="text-center mt-3">
            Sudah punya akun?  
            <a href="<?= base_url('auth/login') ?>">Login</a>
        </p>
    </div>
</div>

</body>
</html>
