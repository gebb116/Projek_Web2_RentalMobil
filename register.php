<?php
session_start();
include 'includes/koneksi.php';

$pesan = '';
$status = '';

if (isset($_POST['register'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $whatsapp = mysqli_real_escape_string($koneksi, $_POST['whatsapp']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Cek apakah email sudah pernah terdaftar
    $cek_email = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek_email) > 0) {
        $pesan = "Email sudah terdaftar! Silakan gunakan email lain.";
        $status = "danger";
    } else {
        // Simpan data user baru ke database
        $query = mysqli_query($koneksi, "INSERT INTO users (nama_lengkap, email, whatsapp, password) VALUES ('$nama', '$email', '$whatsapp', '$password')");
        
        if ($query) {
            $pesan = "Pendaftaran berhasil! Silakan login.";
            $status = "success";
        } else {
            $pesan = "Gagal mendaftar, coba lagi.";
            $status = "danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | DriveEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; }
        .register-card { width: 450px; background: #ffffff; border-radius: 15px; box-shadow: 0px 10px 25px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="card register-card border-0 p-4">
    <div class="card-body">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark mb-1"><i class="fa-solid fa-car-rear text-warning me-2"></i>DRIVEEASE</h3>
            <p class="text-muted small">Buat akun untuk mulai memesan armada premium</p>
        </div>

        <?php if (!empty($pesan)) : ?>
            <div class="alert alert-<?= $status; ?> py-2 small text-center" role="alert">
                <?= $pesan; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama sesuai KTP" required>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Email</label>
                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Nomor WhatsApp</label>
                <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input type="number" name="whatsapp" class="form-control" placeholder="812345678" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Buat password unik" required>
            </div>
            <button type="submit" name="register" class="btn btn-warning w-100 fw-bold text-dark rounded-3 py-2 mb-3">
                Daftar Akun
            </button>
            <p class="text-center small text-muted mb-0">Sudah punya akun? <a href="login_user.php" class="text-warning fw-bold text-decoration-none">Login di sini</a></p>
        </form>
    </div>
</div>

</body>
</html>