<?php 
// 1. Memanggil koneksi database dan header global
include 'includes/koneksi.php'; 
include 'includes/header.php'; 

// 2. Mengambil ID mobil dari URL dan melindunginya dari SQL Injection
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_mobil = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Query untuk mengambil data mobil berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM mobil WHERE id_mobil = '$id_mobil'");
    $mobil = mysqli_fetch_assoc($query);
    
    // Jika ID mobil tidak ditemukan di database, alihkan kembali ke katalog
    if (!$mobil) {
        header("Location: armada.php");
        exit;
    }
} else {
    // Jika tidak ada ID di URL, alihkan ke katalog
    header("Location: armada.php");
    exit;
}
?>

<!-- Jarak aman dari top navbar fixed -->
<div style="height: 90px;"></div>

<section class="py-5 bg-light">
    <div class="container font-inter">
        
        <!-- Tombol Kembali Ke Daftar Armada -->
        <div class="mb-4">
            <a href="armada.php" class="text-secondary text-decoration-none small fw-bold">
                <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Daftar Armada
            </a>
        </div>

        <div class="row">
            
            <!-- SISI KIRI: Foto & Spesifikasi Lengkap Mobil (Dinamis) -->
            <div class="col-lg-8 mb-4">
                
                <!-- Foto Utama -->
                <div class="card border-0 shadow-sm overflow-hidden mb-4 rounded-3">
                    <img src="assets/images/mobil/<?= $mobil['gambar']; ?>" class="img-fluid" alt="<?= $mobil['nama_mobil']; ?>" style="width: 100%; max-height: 450px; object-fit: cover; background-color: #eee;">
                </div>
                
                <!-- Detail & Fitur Mobil -->
                <div class="card border-0 shadow-sm p-4 rounded-3 bg-white">
                    <h2 class="font-montserrat fw-bold text-dark mb-2"><?= $mobil['nama_mobil']; ?></h2>
                    <span class="badge bg-warning text-dark mb-4 fw-bold font-montserrat text-uppercase px-3 py-2" style="width: max-content;">
                        Tipe: <?= strtoupper($mobil['tipe_mobil']); ?>
                    </span>
                    
                    <h5 class="fw-bold mb-3 text-dark font-montserrat">Deskripsi Kendaraan</h5>
                    <p class="text-muted leading-relaxed mb-4">
                        Unit <?= $mobil['nama_mobil']; ?> kami selalu berada dalam kondisi prima, melalui proses pembersihan intensif dan wangi sebelum diserahterimakan kepada Anda. Sangat ideal untuk menunjang segala aktivitas perjalanan Anda, baik untuk keperluan logistik keluarga, operasional bisnis, maupun liburan premium.
                    </p>
                    
                    <h5 class="fw-bold mb-3 text-dark font-montserrat">Fasilitas & Spesifikasi Teknis</h5>
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-4">
                            <div class="p-3 border rounded-3 bg-light d-flex align-items-center">
                                <i class="fa-solid fa-users text-warning fa-2x me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Kapasitas</small>
                                    <span class="fw-bold text-dark"><?= $mobil['kapasitas']; ?> Kursi</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="p-3 border rounded-3 bg-light d-flex align-items-center">
                                <i class="fa-solid fa-gears text-warning fa-2x me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Transmisi</small>
                                    <span class="fw-bold text-dark"><?= ucfirst($mobil['transmisi']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="p-3 border rounded-3 bg-light d-flex align-items-center">
                                <i class="fa-solid fa-gas-pump text-warning fa-2x me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Bahan Bakar</small>
                                    <span class="fw-bold text-dark">Bensin/Diesel</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="p-3 border rounded-3 bg-light d-flex align-items-center">
                                <i class="fa-solid fa-snowflake text-warning fa-2x me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Pendingin</small>
                                    <span class="fw-bold text-dark">AC Dingin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="p-3 border rounded-3 bg-light d-flex align-items-center">
                                <i class="fa-solid fa-circle-check text-warning fa-2x me-3"></i>
                                <div>
                                    <small class="text-muted d-block">Status Unit</small>
                                    <span class="fw-bold text-success"><?= strtoupper($mobil['status']); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- SISI KANAN: Detail Tarif & Tombol Booking -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 rounded-3 bg-white sticky-top" style="top: 110px; z-index: 10;">
                    <h5 class="font-montserrat fw-bold text-dark mb-3">Informasi Tarif Sewa</h5>
                    <hr>
                    
                    <!-- Paket Lepas Kunci -->
                    <div class="p-3 border rounded-3 mb-3 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark small"><i class="fa-solid fa-key text-warning me-2"></i>Lepas Kunci</span>
                            <span class="text-muted small">Per 24 Jam</span>
                        </div>
                        <h4 class="font-montserrat fw-bold text-warning mb-0">
                            Rp <?= number_format($mobil['harga_lepas_kunci'], 0, ',', '.'); ?> <small class="text-muted fs-6">/hari</small>
                        </h4>
                    </div>

                    <!-- Paket Dengan Sopir -->
                    <div class="p-3 border rounded-3 mb-4 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark small"><i class="fa-solid fa-user-tie text-warning me-2"></i>Dengan Sopir</span>
                            <span class="text-muted small">Per 12 Jam</span>
                        </div>
                        <h4 class="font-montserrat fw-bold text-dark mb-0">
                            Rp <?= number_format($mobil['harga_sopir'], 0, ',', '.'); ?> <small class="text-muted fs-6">/hari</small>
                        </h4>
                        <small class="text-muted" style="font-size: 0.75rem;">*Belum termasuk operasional BBM & Tol.</small>
                    </div>

                    <!-- Status Ketersediaan Tombol Sewa -->
                    <?php if ($mobil['status'] == 'tersedia'): ?>
                        <div class="alert alert-warning border-0 small text-dark mb-4" style="background-color: rgba(255, 193, 7, 0.1);">
                            <i class="fa-solid fa-circle-info me-2 text-warning"></i> Unit tersedia! Klik tombol di bawah untuk mengisi form reservasi tanggal.
                        </div>
                        <!-- Mengirimkan ID mobil ke halaman formulir sewa -->
                        <a href="booking.php?id=<?= $mobil['id_mobil']; ?>" class="btn btn-warning w-100 py-3 rounded-pill font-montserrat fw-bold text-dark text-uppercase shadow-sm">
                            Lanjut Sewa Mobil <i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    <?php else: ?>
                        <div class="alert alert-danger border-0 small text-danger mb-4" style="background-color: rgba(220, 53, 69, 0.1);">
                            <i class="fa-solid fa-circle-xmark me-2"></i> Maaf, armada ini sedang tidak tersedia (sedang disewa/servis).
                        </div>
                        <button class="btn btn-secondary w-100 py-3 rounded-pill font-montserrat fw-bold text-white text-uppercase" disabled>
                            Tidak Dapat Disewa
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</section>

<?php 
include 'includes/footer.php'; 
?>