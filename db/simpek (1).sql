-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2023 pada 09.30
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id` int(10) NOT NULL,
  `gaji_pokok` int(30) NOT NULL,
  `uang_makan` int(30) NOT NULL,
  `uang_tambahan` int(30) NOT NULL,
  `potongan` int(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `karyawan_id` int(10) NOT NULL,
  `status` enum('lunas','pending') NOT NULL DEFAULT 'pending',
  `tanggal_gajian` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id`, `gaji_pokok`, `uang_makan`, `uang_tambahan`, `potongan`, `created_at`, `karyawan_id`, `status`, `tanggal_gajian`, `updated_at`) VALUES
(4, 1000000, 50000, 16000, 2500, '2023-05-26 01:43:38', 7, 'pending', '2023-01-01', '2023-05-25 18:43:38'),
(5, 3500000, 0, 0, 0, '2023-05-04 05:03:53', 8, 'pending', '2023-01-01', '2023-05-03 22:03:53'),
(6, 4000000, 0, 0, 0, '2023-02-14 17:44:46', 10, 'pending', '2023-01-01', '2023-02-14 17:44:46'),
(10, 4000000, 50000, 5000, 10000, '2023-05-16 05:24:02', 11, 'pending', '2023-02-19', '2023-05-15 22:24:02'),
(12, 3000000, 50000, 0, 10000, '2023-05-03 07:13:19', 13, 'pending', '2023-05-03', '2023-05-03 00:13:18'),
(14, 4000000, 2100000, 0, 20000, '2023-05-04 05:32:30', 14, 'pending', '2023-05-05', '2023-05-03 22:32:30'),
(15, 1100000, 50000, 0, 0, '2023-05-04 23:43:15', 15, 'pending', '2023-05-05', '2023-05-04 23:43:15'),
(16, 1100000, 50000, 0, 5000, '2023-05-04 23:43:44', 16, 'pending', '2023-05-05', '2023-05-04 23:43:44'),
(17, 1100000, 50000, 0, 5000, '2023-05-04 23:43:58', 17, 'pending', '2023-05-05', '2023-05-04 23:43:58'),
(18, 1000000, 50000, 0, 0, '2023-05-04 23:44:15', 18, 'pending', '2023-05-05', '2023-05-04 23:44:15'),
(21, 1200000, 50000, 100000, 5000, '2023-05-25 19:38:21', 15, 'pending', '2023-05-26', '2023-05-25 19:38:21'),
(22, 1200000, 50000, 100000, 5000, '2023-05-25 19:44:30', 16, 'pending', '2023-05-26', '2023-05-25 19:44:30'),
(23, 1100000, 50000, 100000, 5000, '2023-05-25 20:08:59', 11, 'pending', '2023-04-01', '2023-05-25 20:08:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatans`
--

CREATE TABLE `jabatans` (
  `id` int(10) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `jabatans`
--

INSERT INTO `jabatans` (`id`, `nama_jabatan`) VALUES
(1, 'Kepala Sekolah'),
(2, 'Guru'),
(3, 'Staf TU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawans`
--

CREATE TABLE `karyawans` (
  `id` int(10) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('l','p') NOT NULL,
  `user_id` int(10) NOT NULL,
  `jabatan_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `karyawans`
--

INSERT INTO `karyawans` (`id`, `nip`, `nama`, `jenis_kelamin`, `user_id`, `jabatan_id`) VALUES
(7, '199129018019809192', 'Yanma RIka, S.Pd', 'p', 8, 3),
(11, '199190274120938109', 'Zunaedi, S.Pd', 'l', 13, 2),
(15, '199506297489338202', 'ANAS FACHUL ROZI, S.Pd', 'l', 17, 2),
(16, '199405261926192020', 'DWI ZAHROTUN NISA, S.Pd', 'p', 18, 2),
(17, '199502162002122020', 'MIFTAKHUL MUNIR, S.Pd.I', 'l', 19, 2),
(18, '199208262224892019', 'NUR INDAH KARTIKA, S.Pd', 'p', 20, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepala_sekolah`
--

CREATE TABLE `kepala_sekolah` (
  `id` int(10) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('l','p') NOT NULL,
  `user_id` int(10) NOT NULL,
  `jabatan_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `kepala_sekolah`
--

INSERT INTO `kepala_sekolah` (`id`, `nip`, `nama`, `jenis_kelamin`, `user_id`, `jabatan_id`) VALUES
(1, '196901292003122003', 'Mudjiati, S.Pd', 'p', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kepsek','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2a$12$JGtHbW5qYwtouEaCU04vG.Us4eCi/NukQIzmGIeNENSa0txyPolsm', 'admin'),
(2, 'kepsek', '$2a$12$Za9D.WwUqwD1g5v2J.ZGq.X6m1k13ZFyb4ypRxemrkS.wZQAmsJ3K', 'kepsek'),
(8, 'yanma', '$2y$10$6LW3Jw56kSvACrSvOT37p.nDohz1T.Rh4Mns.Jsg0c/qPya.VTlXO', 'karyawan'),
(13, 'zunaedi', '$2y$10$erWhnJ2E205YqEA/Y/5ExOE9wbYLiOPDxFus3SlObXIVyn6eCF0tC', 'karyawan'),
(17, 'anasf', '$2y$10$oDGvrawKkX7pTUhzkSXjxerzaejlDT/LTYKsenpvGKwfnyYxPhDG6', 'karyawan'),
(18, 'dwizahrotun', '$2y$10$7V2Fmm11SGnCE3GaoQbdpeOSI24IYmnfJHlKQbhfH6ldWDEHTrtqi', 'karyawan'),
(19, 'miftakhul', '$2y$10$A8refaozfdvHoIsFGaKpiuSERjN5VxzaRuf5LyjLVpj5MfzVHVzza', 'karyawan'),
(20, 'nurindah', '$2y$10$CC8JadmHiKv3U27KTO6r9OW1DLm5wIFLD8zq/T9SADSZh2cRCL//S', 'karyawan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatans`
--
ALTER TABLE `jabatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
