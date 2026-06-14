<?php
session_start();
include 'includes/koneksi.php';

$error = '';

if (isset($_POST['login'])) {
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Cocokkan data ke tabel users
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    
    if (mysqli_num_rows($query) === 1) {
        $user = mysqli_fetch_assoc($query);
        
        // Bikin session penanda user sukses login
        $_SESSION['user_logged_in'] = true;
        $_SESSION['id_user']        = $user['id_user'];
        $_SESSION['nama_user']      = $user['nama_lengkap'];
        
        // Tendang user kembali ke halaman utama (index.php) setelah sukses login
        header("Location: index.php");
        exit();
    } else {
        $error = 'Email atau Password Anda salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan | DriveEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; }
        .login-card { width: 400px; background: #ffffff; border-radius: 15px; box-shadow: 0px 10px 25px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="card login-card border-0 p-4">
    <div class="card-body">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark mb-1"><i class="fa-solid fa-car-rear text-warning me-2"></i>DRIVEEASE</h3>
            <p class="text-muted small">Silakan masuk untuk menikmati layanan kami</p>
        </div>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger py-2 small text-center" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
            </div>
            <button type="submit" name="login" class="btn btn-warning w-100 fw-bold text-dark rounded-3 py-2 mb-3">
                Masuk
            </button>
            <p class="text-center small text-muted mb-0">Belum punya akun? <a href="register.php" class="text-warning fw-bold text-decoration-none">Daftar sekarang</a></p>
        </form>
    </div>
</div>

</body>
</html>