<?php 
// Memanggil bagian header global
include 'includes/header.php'; 
?>

<!-- Jarak aman dari top navbar fixed -->
<div style="height: 90px;"></div>

<section class="py-5 bg-light">
    <div class="container font-inter" style="max-width: 800px;">
        
        <!-- Kartu Utama Status Sukses -->
        <div class="card border-0 shadow-sm text-center p-4 p-md-5 mb-4 rounded-3 bg-white">
            <div class="mb-4">
                <i class="fa-solid fa-circle-check text-success display-1 animate__animated animate__bounceIn"></i>
            </div>
            <h2 class="font-montserrat fw-bold text-dark mb-2">Pesanan Anda Berhasil Dibuat!</h2>
            <p class="text-muted">Terima kasih telah memercayakan perjalanan Anda kepada kami. Mohon selesaikan pembayaran agar armada Anda segera disiapkan.</p>
            
            <!-- Kode Booking -->
            <div class="bg-light p-3 rounded-3 d-inline-block mx-auto my-3 border border-dashed" style="min-width: 250px;">
                <small class="text-secondary d-block fw-semibold mb-1">KODE BOOKING ANDA</small>
                <h4 class="font-montserrat fw-bold text-dark tracking-wider mb-0">DE-2026060901</h4>
            </div>
            
            <div class="mt-2">
                <span class="badge bg-warning text-dark px-3 py-2 fw-bold font-montserrat"><i class="fa-solid fa-clock me-2"></i>MENUNGGU VERIFIKASI PEMBAYARAN</span>
            </div>
        </div>

        <!-- Rincian Rekening & Total Pembayaran -->
        <div class="card border-0 shadow-sm p-4 p-md-5 mb-4 rounded-3 bg-white">
            <h5 class="font-montserrat fw-bold text-dark mb-3"><i class="fa-solid fa-credit-card text-warning me-2"></i>Instruksi Pembayaran</h5>
            <p class="text-muted small mb-4">Silakan transfer nominal yang tertera ke salah satu rekening resmi perusahaan kami di bawah ini:</p>
            
            <div class="row g-3 mb-4">
                <!-- Pilihan Bank 1 -->
                <div class="col-md-6">
                    <div class="p-3 border rounded-3 bg-light d-flex align-items-center">
                        <div class="me-3 fw-bold text-primary font-montserrat fs-4" style="width: 60px;">BCA</div>
                        <div>
                            <small class="text-muted d-block">Nomor Rekening</small>
                            <span class="fw-bold text-dark font-montserrat">872-0941-233</span>
                            <small class="text-muted d-block">a.n PT DriveEase Rental</small>
                        </div>
                    </div>
                </div>
                <!-- Pilihan Bank 2 -->
                <div class="col-md-6">
                    <div class="p-3 border rounded-3 bg-light d-flex align-items-center">
                        <div class="me-3 fw-bold text-dark font-montserrat fs-4" style="width: 60px;">MANDIRI</div>
                        <div>
                            <small class="text-muted d-block">Nomor Rekening</small>
                            <span class="fw-bold text-dark font-montserrat">132-00-9481-232</span>
                            <small class="text-muted d-block">a.n PT DriveEase Rental</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total yang harus dibayarkan -->
            <div class="p-4 rounded-3 text-center text-md-start d-md-flex align-items-center justify-content-between mb-2" style="background-color: rgba(255, 193, 7, 0.08); border: 1px solid rgba(255, 193, 7, 0.3);">
                <div class="mb-3 mb-md-0">
                    <h6 class="fw-bold text-dark mb-1">Total Tagihan Yang Harus Ditransfer:</h6>
                    <small class="text-muted">*Mohon transfer sesuai angka tepat agar sistem mendeteksi otomatis.</small>
                </div>
                <div>
                    <h3 class="font-montserrat fw-bold text-warning mb-0">Rp 1.050.000</h3>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi Tambahan -->
        <div class="text-center font-montserrat">
            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20konfirmasi%20booking%20dengan%20kode%20DE-2026060901" target="_blank" class="btn btn-success rounded-pill px-4 py-2 fw-bold text-white shadow-sm me-2 mb-2">
                <i class="fa-brands fa-whatsapp me-2"></i>Konfirmasi via WhatsApp
            </a>
            <a href="index.php" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold mb-2">
                Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

<?php 
// Memanggil bagian footer global
include 'includes/footer.php'; 
?>