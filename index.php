<?php 
// Memanggil bagian header global yang sudah kita buat sebelumnya
include 'includes/header.php'; 
?>

<section class="hero-section">
    <div class="hero-overlay"></div>
    
    <div class="container hero-content">
        <div class="row align-items-center min-vh-100 pt-5">
            
            <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                <h1 class="font-montserrat fw-bold display-4 mb-3 text-white">
                    Perjalanan Nyaman, <br>
                    Tanpa Hambatan.
                </h1>
                <p class="lead text-white-50 mb-4 font-inter">
                    Sewa mobil pilihan Anda dengan proses cepat, armada prima, dan pelayanan profesional 24 jam. Tersedia layanan lepas kunci maupun dengan sopir.
                </p>
                <a href="armada.php" class="btn btn-outline-warning btn-lg rounded-pill px-4 font-montserrat fw-semibold">
                    Lihat Semua Armada <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>
            
            <div class="col-lg-6">
                <div class="search-widget p-4 p-md-5">
                    <h4 class="font-montserrat fw-bold mb-4 text-dark text-center text-lg-start">
                        <i class="fa-solid fa-calendar-days text-warning me-2"></i>Cari Mobil Sewaan
                    </h4>
                    
                    <form action="armada.php" method="GET">
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small">JENIS LAYANAN</label>
                            <div class="d-flex gap-3">
                                <div class="form-check font-inter">
                                    <input class="form-check-input" type="radio" name="layanan" id="lepasKunci" value="lepas-kunci" checked>
                                    <label class="form-check-label text-dark" for="lepasKunci">Lepas Kunci</label>
                                </div>
                                <div class="form-check font-inter">
                                    <input class="form-check-input" type="radio" name="layanan" id="denganSopir" value="dengan-sopir">
                                    <label class="form-check-label text-dark" for="denganSopir">Dengan Sopir</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tgl_jemput" class="form-label fw-semibold text-secondary small">TANGGAL JEMPUT</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted"><i class="fa-solid fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="tgl_jemput" name="tgl_jemput" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jam_jemput" class="form-label fw-semibold text-secondary small">JAM JEMPUT</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted"><i class="fa-solid fa-clock"></i></span>
                                    <input type="time" class="form-control" id="jam_jemput" name="jam_jemput" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="tgl_kembali" class="form-label fw-semibold text-secondary small">TANGGAL KEMBALI</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted"><i class="fa-solid fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="jam_kembali" class="form-label fw-semibold text-secondary small">JAM KEMBALI</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-muted"><i class="fa-solid fa-clock"></i></span>
                                    <input type="time" class="form-control" id="jam_kembali" name="jam_kembali" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill font-montserrat fw-bold text-dark text-uppercase shadow">
                            Cari Mobil Sekarang <i class="fa-solid fa-magnifying-glass ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h6 class="text-warning fw-bold text-uppercase font-montserrat">Mengapa Kami?</h6>
            <h2 class="fw-bold font-montserrat text-dark">Keunggulan Layanan Rental Kami</h2>
        </div>
        
        <div class="row text-center font-inter">
            <div class="col-md-4 mb-4">
                <div class="p-3">
                    <i class="fa-solid fa-shield-halved text-warning display-4 mb-3"></i>
                    <h5 class="fw-bold text-dark">Armada Terawat & Aman</h5>
                    <p class="text-muted small">Semua unit mobil kami selalu melalui inspeksi rutin dan servis berkala demi kenyamanan Anda.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-3">
                    <i class="fa-solid fa-tags text-warning display-4 mb-3"></i>
                    <h5 class="fw-bold text-dark">Harga Transparan</h5>
                    <p class="text-muted small">Harga sewa yang jujur tanpa ada biaya tersembunyi. Apa yang Anda lihat adalah apa yang Anda bayar.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-3">
                    <i class="fa-solid fa-headset text-warning display-4 mb-3"></i>
                    <h5 class="fw-bold text-dark">Layanan Pelanggan 24/7</h5>
                    <p class="text-muted small">Tim dukungan kami siap membantu dan melayani Anda kapan pun dibutuhkan sepanjang perjalanan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
// Memanggil bagian footer global
include 'includes/footer.php'; 
?>