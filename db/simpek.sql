-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Bulan Mei 2023 pada 09.22
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
  `potongan` int(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `karyawan_id` int(10) NOT NULL,
  `status` enum('lunas','pending') NOT NULL DEFAULT 'pending',
  `tanggal_gajian` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id`, `gaji_pokok`, `uang_makan`, `potongan`, `created_at`, `karyawan_id`, `status`, `tanggal_gajian`, `updated_at`) VALUES
(4, 3000000, 50000, 2500, '2023-05-03 07:13:34', 7, 'pending', '2023-01-01', '2023-05-03 00:13:34'),
(5, 3500000, 0, 0, '2023-04-10 08:46:57', 8, 'pending', '2023-01-01', '2023-04-10 01:46:57'),
(6, 4000000, 0, 0, '2023-02-14 17:44:46', 10, 'pending', '2023-01-01', '2023-02-14 17:44:46'),
(7, 3000000, 0, 0, '2023-02-14 17:45:03', 7, 'pending', '2022-12-01', '2023-02-14 17:45:03'),
(8, 3500000, 0, 0, '2023-02-14 17:45:13', 8, 'pending', '2022-12-01', '2023-02-14 17:45:13'),
(9, 4000000, 0, 0, '2023-02-14 17:45:24', 10, 'pending', '2022-12-01', '2023-02-14 17:45:24'),
(10, 4000000, 0, 0, '2023-02-19 05:52:52', 11, 'pending', '2023-02-19', '2023-02-19 05:52:52'),
(12, 3000000, 50000, 10000, '2023-05-03 07:13:19', 13, 'pending', '2023-05-03', '2023-05-03 00:13:18');

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
(7, '199129018019809192', 'Yanma RIka', '', 8, 3),
(8, '199140918209481029', 'Anita Kurnia Dewi', '', 10, 3),
(10, '197191919704124017', 'Maspriyadi', 'l', 12, 2),
(11, '199190274120938109', 'Zunaedi', 'l', 13, 2),
(13, '639729593657419956', 'yuki', 'p', 15, 2);

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
(1, '191920191082409180', 'Kepala Sekolah 12412', 'p', 2, 1);

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
(10, 'anita', '$2y$10$Sa5TJyPMgbBu48vfUqFlseupYoX4isq922/3oXQIwgpMTPlSYvdlm', 'karyawan'),
(12, 'maspriyadi', '$2y$10$73kImDQ3TpbljQ41z5ROS.i/eB84/TmPGIoUONz0y9R6/os/rQ26C', 'karyawan'),
(13, 'zunaedi', '$2y$10$erWhnJ2E205YqEA/Y/5ExOE9wbYLiOPDxFus3SlObXIVyn6eCF0tC', 'karyawan'),
(15, 'yuki', '$2y$10$jkrRDJlmR8OaTuTtJvsJO.F3PKtG27JgwtC0.Jac3/QbIVCNhSECC', 'karyawan');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jabatans`
--
ALTER TABLE `jabatans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
