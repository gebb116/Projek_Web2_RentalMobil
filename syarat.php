<?php 
// Memanggil bagian header global
include 'includes/header.php'; 
?>

<!-- Banner Atas -->
<div class="position-relative text-white py-5 d-flex align-items-center" style="background: url('assets/images/hero-bg.jpg') no-repeat center center/cover; height: 220px; margin-top: 50px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.75);"></div>
    <div class="container position-relative z-1 text-center py-3">
        <h1 class="font-montserrat fw-bold display-5">Syarat & Ketentuan</h1>
        <p class="font-inter text-white-50">Aturan dan kebijakan layanan rental demi kenyamanan bersama</p>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container font-inter" style="max-width: 900px;">
        <div class="card border-0 shadow-sm p-4 p-md-5 rounded-3 bg-white">
            
            <div class="mb-4">
                <h5 class="fw-bold text-dark font-montserrat mb-3"><i class="fa-solid fa-key text-warning me-2"></i> 1. Ketentuan Lepas Kunci (Tanpa Sopir)</h5>
                <ul class="text-muted ps-3 mb-0" style="line-height: 1.8;">
                    <li>Penyewa wajib memiliki dan menunjukkan **KTP asli** serta **SIM A aktif**.</li>
                    <li>Bersedia menjaminkan sepeda motor beserta STNK asli atas nama sendiri (atau dokumen pendukung lain sesuai kebijakan internal).</li>
                    <li>Bersedia difoto bersama kendaraan saat proses serah terima unit armada.</li>
                    <li>Durasi sewa minimal adalah 1 hari (24 Jam) dihitung sejak waktu serah terima kendaraan.</li>
                </ul>
            </div>

            <hr class="my-4">

            <div class="mb-4">
                <h5 class="fw-bold text-dark font-montserrat mb-3"><i class="fa-solid fa-user-tie text-warning me-2"></i> 2. Ketentuan Dengan Sopir</h5>
                <ul class="text-muted ps-3 mb-0" style="line-height: 1.8;">
                    <li>Durasi penggunaan harian maksimal adalah **12 jam per hari**.</li>
                    <li>Tarif dasar belum termasuk biaya operasional lapangan seperti Bahan Bakar Minyak (BBM), tol, parkir, serta uang makan sopir.</li>
                    <li>Penggunaan rute luar kota yang melebihi batas kesepakatan awal akan dikenakan biaya tambahan (*overtime*).</li>
                </ul>
            </div>

            <hr class="my-4">

            <div class="mb-4">
                <h5 class="fw-bold text-dark font-montserrat mb-3"><i class="fa-solid fa-triangle-exclamation text-warning me-2"></i> 3. Batas Waktu & Denda (Overtime)</h5>
                <ul class="text-muted ps-3 mb-0" style="line-height: 1.8;">
                    <li>Keterlambatan pengembalian armada akan dikenakan denda *overtime* sebesar **10% per jam** dari tarif sewa harian.</li>
                    <li>Jika keterlambatan melebihi batas waktu **3 jam**, maka penyewa akan dihitung secara otomatis membayar tarif sewa penuh 1 hari penuh.</li>
                    <li>Penyewa diwajibkan mengembalikan kondisi bahan bakar (bensin) sesuai dengan posisi indikator saat pertama kali mobil diserahterimakan.</li>
                </ul>
            </div>

        </div>
    </div>
</section>

<?php 
include 'includes/footer.php'; 
?>