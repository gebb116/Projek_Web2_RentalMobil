<?php 
// 1. Memanggil koneksi database dan header global
include 'includes/koneksi.php'; 
include 'includes/header.php'; 

// 2. LOGIKA FILTER: Mengambil data filter jika ada yang dipilih oleh pengguna
$where_clauses = [];

// Filter berdasarkan Tipe Mobil
if (isset($_GET['tipe']) && !empty($_GET['tipe'])) {
    $tipe_filter = array_map(function($val) use ($koneksi) {
        return "'" . mysqli_real_escape_string($koneksi, $val) . "'";
    }, $_GET['tipe']);
    $where_clauses[] = "tipe_mobil IN (" . implode(',', $tipe_filter) . ")";
}

// Filter berdasarkan Transmisi
if (isset($_GET['transmisi']) && !empty($_GET['transmisi'])) {
    $trans_filter = array_map(function($val) use ($koneksi) {
        return "'" . mysqli_real_escape_string($koneksi, $val) . "'";
    }, $_GET['transmisi']);
    $where_clauses[] = "transmisi IN (" . implode(',', $trans_filter) . ")";
}

// Menyusun Query SQL Utama
$query_sql = "SELECT * FROM mobil";
if (count($where_clauses) > 0) {
    $query_sql .= " WHERE " . implode(' AND ', $where_clauses);
}

// Menjalankan query ke database
$result = mysqli_query($koneksi, $query_sql);
?>

<div class="position-relative text-white py-5 d-flex align-items-center" style="background: url('assets/images/hero-bg.jpg') no-repeat center center/cover; height: 250px; margin-top: 50px;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.7);"></div>
    <div class="container position-relative z-1 text-center py-4">
        <h1 class="font-montserrat fw-bold display-5">Daftar Armada</h1>
        <p class="font-inter text-white-50">Pilih kendaraan terbaik yang sesuai dengan kebutuhan perjalanan Anda</p>
    </div>
</div>

<section class="py-5 bg-light">
    <div class="container font-inter">
        <div class="row">
            
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm p-4 rounded-3">
                    <h5 class="font-montserrat fw-bold mb-3 text-dark"><i class="fa-solid fa-sliders text-warning me-2"></i>Filter Mobil</h5>
                    <hr>
                    
                    <form action="armada.php" method="GET">
                        <div class="mb-4">
                            <label class="fw-bold text-secondary small mb-2 d-block">TIPE KENDARAAN</label>
                            <?php 
                            $tipes = ['mpv' => 'MPV (Keluarga)', 'suv' => 'SUV (Tangguh)', 'sedan' => 'Sedan Premium', 'city-car' => 'City Car'];
                            foreach ($tipes as $key => $value): 
                                $checked = (isset($_GET['tipe']) && in_array($key, $_GET['tipe'])) ? 'checked' : '';
                            ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="tipe[]" value="<?= $key; ?>" id="tipe<?= $key; ?>" <?= $checked; ?>>
                                <label class="form-check-label text-dark" for="tipe<?= $key; ?>"><?= $value; ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="mb-4">
                            <label class="fw-bold text-secondary small mb-2 d-block">TRANSMISI</label>
                            <?php 
                            $transmissions = ['manual' => 'Manual', 'matic' => 'Automatic (Matic)'];
                            foreach ($transmissions as $key => $value): 
                                $checked = (isset($_GET['transmisi']) && in_array($key, $_GET['transmisi'])) ? 'checked' : '';
                            ?>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="transmisi[]" value="<?= $key; ?>" id="trans<?= $key; ?>" <?= $checked; ?>>
                                <label class="form-check-label text-dark" for="trans<?= $key; ?>"><?= $value; ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="submit" class="btn btn-warning w-100 rounded-pill fw-bold text-dark font-montserrat">Terapkan Filter</button>
                        <?php if (isset($_GET['tipe']) || isset($_GET['transmisi'])): ?>
                            <a href="armada.php" class="btn btn-outline-secondary w-100 rounded-pill fw-bold font-montserrat mt-2 btn-sm">Reset Filter</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                    
                    <?php 
                    // 3. Perulangan PHP untuk menampilkan data dari database
                    if (mysqli_num_rows($result) > 0) {
                        while ($mobil = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col">
                        <div class="card h-100 car-card shadow-sm bg-white">
                            <img src="assets/images/mobil/<?= $mobil['gambar']; ?>" class="card-img-top" alt="<?= $mobil['nama_mobil']; ?>" style="height: 200px; object-fit: cover; background-color: #eee;">
                            <div class="card-body p-4">
                                <span class="badge bg-warning text-dark mb-2 fw-bold font-montserrat text-uppercase"><?= $mobil['tipe_mobil']; ?></span>
                                <h5 class="card-title font-montserrat fw-bold text-dark mb-3"><?= $mobil['nama_mobil']; ?></h5>
                                
                                <div class="d-flex justify-content-between text-muted small mb-4">
                                    <span><i class="fa-solid fa-users text-warning me-1"></i> <?= $mobil['kapasitas']; ?> Kursi</span>
                                    <span><i class="fa-solid fa-gears text-warning me-1"></i> <?= ucfirst($mobil['transmisi']); ?></span>
                                    <span><i class="fa-solid fa-snowflake text-warning me-1"></i> AC</span>
                                </div>
                                
                                <div class="border-top pt-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-muted small mb-0">Harga mulai</p>
                                        <span class="fw-bold text-dark font-montserrat">Rp <?= number_format($mobil['harga_lepas_kunci'], 0, ',', '.'); ?></span> <span class="text-muted small">/hari</span>
                                    </div>
                                    <a href="detail.php?id=<?= $mobil['id_mobil']; ?>" class="btn btn-dark rounded-pill px-3 fw-bold btn-sm">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    } else {
                        // Jika filter tidak menemukan mobil yang cocok
                        echo '<div class="col-12 text-center py-5"><i class="fa-solid fa-car-burst fa-3x text-muted mb-3"></i><p class="text-muted">Maaf, tidak ada armada mobil yang cocok dengan kriteria filter Anda.</p></div>';
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>
</section>

<?php 
include 'includes/footer.php'; 
?>