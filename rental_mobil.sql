-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2026 pada 06.19
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_mobil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'admin123', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mobil`
--

CREATE TABLE `mobil` (
  `id_mobil` int(11) NOT NULL,
  `nama_mobil` varchar(100) NOT NULL,
  `tipe_mobil` enum('mpv','suv','sedan','city-car') NOT NULL,
  `transmisi` enum('manual','matic') NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `harga_lepas_kunci` int(11) NOT NULL,
  `harga_sopir` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('tersedia','disewa','servis') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mobil`
--

INSERT INTO `mobil` (`id_mobil`, `nama_mobil`, `tipe_mobil`, `transmisi`, `kapasitas`, `harga_lepas_kunci`, `harga_sopir`, `gambar`, `status`) VALUES
(1, 'Toyota Avanza Grand New', 'mpv', 'manual', 7, 350000, 550000, 'avanza.jpg', 'tersedia'),
(2, 'Mitsubishi Pajero Sport', 'suv', 'matic', 7, 800000, 1100000, 'pajero.jpg', 'tersedia'),
(3, 'Honda Brio', '', 'matic', 5, 300000, 500000, 'brio.jpg', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `kode_booking` varchar(20) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `layanan` enum('lepas-kunci','dengan-sopir') NOT NULL,
  `tgl_jemput` date NOT NULL,
  `jam_jemput` time NOT NULL,
  `tgl_kembali` date NOT NULL,
  `jam_kembali` time NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `foto_ktp` varchar(255) NOT NULL,
  `foto_sim` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `status_pesanan` enum('pending','dikonfirmasi','selesai','dibatalkan') DEFAULT 'pending',
  `tgl_buat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `kode_booking`, `id_mobil`, `nama_pelanggan`, `whatsapp`, `email`, `layanan`, `tgl_jemput`, `jam_jemput`, `tgl_kembali`, `jam_kembali`, `total_bayar`, `foto_ktp`, `foto_sim`, `metode_pembayaran`, `status_pesanan`, `tgl_buat`) VALUES
(1, 'DE-2026060881', 1, 'oppung', '97346728652', 'oppungkece@gmail.com', 'lepas-kunci', '2026-06-10', '02:50:00', '2026-06-11', '03:51:00', 350000, '1780948314_81kxce-AlLL._AC_.jpg', '1780948314_hero-bg.jpg', 'transfer-bank', 'pending', '2026-06-08 19:51:54'),
(2, 'DE-2026060999', 1, 'oppung', '8415486578', 'oppungkece@gmail.com', 'lepas-kunci', '2026-06-09', '10:01:00', '2026-06-10', '09:01:00', 350000, '1780970615_hero-bg.jpg', '1780970615_pajero.jpg', 'cod', 'pending', '2026-06-09 02:03:35'),
(3, 'DE-2026060940', 1, 'noel', '8112546974', 'noel@gmail.com', 'lepas-kunci', '2026-06-09', '09:37:00', '2026-06-10', '09:37:00', 350000, '1780972705_hero-bg.jpg', '1780972705_pajero.jpg', 'cod', 'pending', '2026-06-09 02:38:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD UNIQUE KEY `kode_booking` (`kode_booking`),
  ADD KEY `id_mobil` (`id_mobil`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_mobil`) REFERENCES `mobil` (`id_mobil`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
