<?php
include 'includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_mobil     = mysqli_real_escape_string($koneksi, $_POST['id_mobil']);
    $nama         = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $whatsapp     = mysqli_real_escape_string($koneksi, $_POST['whatsapp']);
    $email        = mysqli_real_escape_string($koneksi, $_POST['email']);
    $layanan      = mysqli_real_escape_string($koneksi, $_POST['layanan']);
    $tgl_jemput   = mysqli_real_escape_string($koneksi, $_POST['tgl_jemput']);
    $jam_jemput   = mysqli_real_escape_string($koneksi, $_POST['jam_jemput']);
    $tgl_kembali  = mysqli_real_escape_string($koneksi, $_POST['tgl_kembali']);
    $jam_kembali  = mysqli_real_escape_string($koneksi, $_POST['jam_kembali']);
    $pembayaran   = mysqli_real_escape_string($koneksi, $_POST['pembayaran']);

    // 1. Membuat Kode Booking Unik Secara Otomatis
    $kode_booking = "DE-" . date('Ymd') . rand(10, 99);

    // 2. Mengambil Harga Mobil untuk Hitung Total Bayar di Backend (Lebih Aman)
    $query_mobil = mysqli_query($koneksi, "SELECT * FROM mobil WHERE id_mobil = '$id_mobil'");
    $mobil = mysqli_fetch_assoc($query_mobil);
    
    $harga_per_hari = ($layanan == 'lepas-kunci') ? $mobil['harga_lepas_kunci'] : $mobil['harga_sopir'];
    $durasi = (strtotime($tgl_kembali) - strtotime($tgl_jemput)) / (60 * 60 * 24);
    if ($durasi <= 0) $durasi = 1;
    $total_bayar = $durasi * $harga_per_hari;

    // 3. Proses Unggah Foto KTP
    $target_dir = "assets/images/dokumen/";
    // Membuat folder jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $foto_ktp = time() . "_" . $_FILES['foto_ktp']['name'];
    move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $target_dir . $foto_ktp);

    // Proses Unggah Foto SIM (Jika Ada)
    $foto_sim = "";
    if (!empty($_FILES['foto_sim']['name'])) {
        $foto_sim = time() . "_" . $_FILES['foto_sim']['name'];
        move_uploaded_file($_FILES['foto_sim']['tmp_name'], $target_dir . $foto_sim);
    }

    // 4. Memasukkan Data ke Tabel Pesanan
    $query_insert = "INSERT INTO pesanan (kode_booking, id_mobil, nama_pelanggan, whatsapp, email, layanan, tgl_jemput, jam_jemput, tgl_kembali, jam_kembali, total_bayar, foto_ktp, foto_sim, metode_pembayaran, status_pesanan) 
    VALUES ('$kode_booking', '$id_mobil', '$nama', '$whatsapp', '$email', '$layanan', '$tgl_jemput', '$jam_jemput', '$tgl_kembali', '$jam_kembali', '$total_bayar', '$foto_ktp', '$foto_sim', '$pembayaran', 'pending')";

    if (mysqli_query($koneksi, $query_insert)) {
        // Jika sukses, alihkan ke halaman konfirmasi dengan membawa kode booking di URL
        header("Location: konfirmasi.php?booking=" . $kode_booking);
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>