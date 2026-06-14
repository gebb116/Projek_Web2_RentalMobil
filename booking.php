<?php 
// 1. Memanggil koneksi database dan header global
include 'includes/koneksi.php'; 
include 'includes/header.php'; 

// 2. Mengambil ID mobil dari URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_mobil = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Ambil data mobil terpilih
    $query = mysqli_query($koneksi, "SELECT * FROM mobil WHERE id_mobil = '$id_mobil' AND status = 'tersedia'");
    $mobil = mysqli_fetch_assoc($query);
    
    if (!$mobil) {
        // Jika mobil tidak ada atau tidak tersedia, kembalikan ke katalog
        header("Location: armada.php");
        exit;
    }
} else {
    header("Location: armada.php");
    exit;
}
?>

<div style="height: 90px;"></div>

<section class="py-5 bg-light">
    <div class="container font-inter">
        
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm p-4 p-md-5 rounded-3 bg-white">
                    <h3 class="font-montserrat fw-bold text-dark mb-2">Formulir Reservasi</h3>
                    <p class="text-muted small mb-4">Mohon lengkapi data di bawah ini dengan benar untuk mempercepat proses verifikasi.</p>
                    
                    <form action="proses_booking.php" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id_mobil" value="<?= $mobil['id_mobil']; ?>">
                        <input type="hidden" id="harga_dasar_lepas" value="<?= $mobil['harga_lepas_kunci']; ?>">
                        <input type="hidden" id="harga_dasar_sopir" value="<?= $mobil['harga_sopir']; ?>">

                        <h5 class="font-montserrat fw-bold text-dark mb-3"><i class="fa-solid fa-user text-warning me-2"></i>Data Penyewa</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label fw-semibold text-secondary small">NAMA LENGKAP (Sesuai KTP)</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Andi Wijaya" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="whatsapp" class="form-label fw-semibold text-secondary small">NOMOR WHATSAPP (Aktif)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">+62</span>
                                    <input type="tel" class="form-control" id="whatsapp" name="whatsapp" placeholder="8123456789" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold text-secondary small">ALAMAT EMAIL</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="andi@example.com" required>
                        </div>
                        
                        <hr class="my-4">

                        <h5 class="font-montserrat fw-bold text-dark mb-3"><i class="fa-solid fa-route text-warning me-2"></i>Detail Rental</h5>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary small">JENIS LAYANAN</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="layanan" id="lepasKunci" value="lepas-kunci" checked onchange="hitungTotal()">
                                    <label class="form-check-label text-dark" for="lepasKunci">Lepas Kunci</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="layanan" id="denganSopir" value="dengan-sopir" onchange="hitungTotal()">
                                    <label class="form-check-label text-dark" for="denganSopir">Dengan Sopir</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tgl_jemput" class="form-label fw-semibold text-secondary small">TANGGAL JEMPUT</label>
                                <input type="date" class="form-control" id="tgl_jemput" name="tgl_jemput" required onchange="hitungTotal()">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jam_jemput" class="form-label fw-semibold text-secondary small">JAM JEMPUT</label>
                                <input type="time" class="form-control" id="jam_jemput" name="jam_jemput" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tgl_kembali" class="form-label fw-semibold text-secondary small">TANGGAL KEMBALI</label>
                                <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required onchange="hitungTotal()">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jam_kembali" class="form-label fw-semibold text-secondary small">JAM KEMBALI</label>
                                <input type="time" class="form-control" id="jam_kembali" name="jam_kembali" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="font-montserrat fw-bold text-dark mb-3"><i class="fa-solid fa-file-shield text-warning me-2"></i>Verifikasi Dokumen</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="foto_ktp" class="form-label fw-semibold text-secondary small">FOTO KTP ASLI</label>
                                <input class="form-control" type="file" id="foto_ktp" name="foto_ktp" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="foto_sim" class="form-label fw-semibold text-secondary small">FOTO SIM A (Opsional jika dengan sopir)</label>
                                <input class="form-control" type="file" id="foto_sim" name="foto_sim">
                            </div>
                        </div>
                        
                        <hr class="my-4">

                        <h5 class="font-montserrat fw-bold text-dark mb-3"><i class="fa-solid fa-credit-card text-warning me-2"></i>Metode Pembayaran</h5>
                        <div class="mb-4">
                            <div class="form-check p-3 border rounded-3 mb-2 bg-light">
                                <input class="form-check-input ms-1" type="radio" name="pembayaran" id="transfer" value="transfer-bank" checked>
                                <label class="form-check-label text-dark fw-bold ms-3" for="transfer">Transfer Bank (Manual)</label>
                            </div>
                            <div class="form-check p-3 border rounded-3 mb-2 bg-light">
                                <input class="form-check-input ms-1" type="radio" name="pembayaran" id="cod" value="cod">
                                <label class="form-check-label text-dark fw-bold ms-3" for="cod">Bayar di Tempat (COD)</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill font-montserrat fw-bold text-dark text-uppercase shadow-sm">
                            Konfirmasi Pemesanan <i class="fa-solid fa-circle-check ms-2"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 rounded-3 bg-white sticky-top" style="top: 110px; z-index: 10;">
                    <h5 class="font-montserrat fw-bold text-dark mb-3">Ringkasan Sewa</h5>
                    <hr>
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light p-2 rounded-3 me-3" style="width: 80px; height: 60px;">
                            <img src="assets/images/mobil/<?= $mobil['gambar']; ?>" alt="Mobil" class="img-fluid rounded-2" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1 text-dark"><?= $mobil['nama_mobil']; ?></h6>
                            <span class="badge bg-secondary font-montserrat text-uppercase" style="font-size: 0.7rem;"><?= $mobil['transmisi']; ?></span>
                        </div>
                    </div>

                    <div class="mb-3 small">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Durasi Sewa:</span>
                            <span class="fw-bold text-dark" id="display-durasi">0 Hari</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Layanan:</span>
                            <span class="fw-bold text-dark text-capitalize" id="display-layanan">Lepas Kunci</span>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="mb-4 small">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">Total Pembayaran:</span>
                            <h4 class="font-montserrat fw-bold text-warning mb-0" id="display-total">Rp 0</h4>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<script>
function hitungTotal() {
    const tglJemputInput = document.getElementById('tgl_jemput').value;
    const tglKembaliInput = document.getElementById('tgl_kembali').value;
    
    const hargaLepas = parseInt(document.getElementById('harga_dasar_lepas').value) || 0;
    const hargaSopir = parseInt(document.getElementById('harga_dasar_sopir').value) || 0;
    
    const layananElement = document.querySelector('input[name="layanan"]:checked');
    const layanan = layananElement ? layananElement.value : 'lepas-kunci';
    document.getElementById('display-layanan').innerText = layanan.replace('-', ' ');

    if (tglJemputInput && tglKembaliInput) {
        const tglJemput = new Date(tglJemputInput);
        const tglKembali = new Date(tglKembaliInput);
        
        if (tglKembali >= tglJemput) {
            const selisihWaktu = tglKembali.getTime() - tglJemput.getTime();
            let durasiHari = Math.ceil(selisihWaktu / (1000 * 3600 * 24));
            
            if(durasiHari === 0) durasiHari = 1;

            document.getElementById('display-durasi').innerText = durasiHari + " Hari";
            
            const hargaPerHari = (layanan === 'lepas-kunci') ? hargaLepas : hargaSopir;
            const totalBayar = durasiHari * hargaPerHari;
            
            document.getElementById('display-total').innerText = "Rp " + totalBayar.toLocaleString('id-ID');
            return;
        }
    }
    document.getElementById('display-durasi').innerText = "0 Hari";
    document.getElementById('display-total').innerText = "Rp 0";
}
</script>

<?php 
include 'includes/footer.php'; 
?>