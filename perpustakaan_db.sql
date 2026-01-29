-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2026 at 01:35 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int NOT NULL,
  `no_anggota` varchar(20) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tanggal_daftar` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `no_anggota`, `nama_anggota`, `jenis_kelamin`, `alamat`, `no_telp`, `email`, `tanggal_daftar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A001', 'Budi Santoso', 'L', 'Jl. Merdeka No. 10, Jakarta', '081234567890', 'budi@email.com', '2024-01-15', 'Aktif', '2026-01-29 12:22:49', '2026-01-29 12:22:49'),
(2, 'A002', 'Siti Nurhaliza', 'P', 'Jl. Sudirman No. 25, Bandung', '081234567891', 'siti@email.com', '2024-02-20', 'Aktif', '2026-01-29 12:22:49', '2026-01-29 12:22:49'),
(4, 'A192', 'surti', 'L', 'ambokembang gang 2', '081234567892', 'yanto123@gmail.com', '2026-01-29', 'Aktif', '2026-01-29 13:23:05', '2026-01-29 13:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul_buku` varchar(200) NOT NULL,
  `pengarang` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` year NOT NULL,
  `jumlah_buku` int NOT NULL DEFAULT '0',
  `stok_tersedia` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `jumlah_buku`, `stok_tersedia`, `created_at`, `updated_at`) VALUES
(1, 'BK001', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 10, 9, '2026-01-29 12:22:49', '2026-01-29 12:22:49'),
(2, 'BK002', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 8, 8, '2026-01-29 12:22:49', '2026-01-29 12:22:49'),
(3, 'BK003', 'Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia', 2009, 12, 12, '2026-01-29 12:22:49', '2026-01-29 13:22:00'),
(4, 'BK004', 'Ronggeng Dukuh Paruk', 'Ahmad Tohari', 'Gramedia', 1982, 5, 5, '2026-01-29 12:22:49', '2026-01-29 12:22:49'),
(5, 'BK005', 'Cantik Itu Luka', 'Eka Kurniawan', 'Gramedia', 2002, 7, 7, '2026-01-29 12:22:49', '2026-01-29 12:22:49'),
(6, 'BK191', 'kisah musang makan gajah', 'adil hakim', 'pt adil makmur sejahtera', 2026, 100, 99, '2026-01-29 13:17:24', '2026-01-29 13:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL,
  `kode_peminjaman` varchar(20) NOT NULL,
  `id_anggota` int NOT NULL,
  `id_buku` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `denda` decimal(10,2) DEFAULT '0.00',
  `status` enum('Dipinjam','Dikembalikan') DEFAULT 'Dipinjam',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `kode_peminjaman`, `id_anggota`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `tanggal_pengembalian`, `denda`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PJ001', 1, 1, '2025-01-20', '2025-01-27', NULL, '0.00', 'Dipinjam', '2026-01-29 12:22:49', '2026-01-29 12:22:49'),
(2, 'PJ002', 2, 3, '2025-01-22', '2025-01-29', '2026-01-29', '365000.00', 'Dikembalikan', '2026-01-29 12:22:49', '2026-01-29 13:22:00'),
(3, 'PJ997730', 4, 6, '2026-01-29', '2026-02-05', NULL, '0.00', 'Dipinjam', '2026-01-29 13:23:34', '2026-01-29 13:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'yanto', '$2y$10$J4bcoZMBtl9vOf74hLXLkuE.oLCml.5//iyjx2wvLpzkFaAw/gsAW', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `no_anggota` (`no_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD UNIQUE KEY `kode_peminjaman` (`kode_peminjaman`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
