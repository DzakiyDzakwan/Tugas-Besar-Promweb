-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2021 at 01:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_guru` varchar(200) NOT NULL,
  `NIG` char(9) NOT NULL,
  `mapel_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama_guru`, `NIG`, `mapel_id`, `user_id`) VALUES
(9, 'Ahmad Surtana', '191102001', 5, 26),
(10, 'Maulida Yatna', '191102002', 3, 23),
(11, 'Zulaika Hana', '191102003', 6, 24),
(12, 'Efendi Ginting', '191102004', 5, 25),
(13, 'Zainal Arifin', '191102005', 2, 27);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(10) UNSIGNED NOT NULL,
  `jawaban` varchar(200) NOT NULL,
  `nilai` int(10) UNSIGNED DEFAULT 0,
  `siswa` int(10) UNSIGNED NOT NULL,
  `tugas` int(10) UNSIGNED NOT NULL,
  `mapel` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id`, `jawaban`, `nilai`, `siswa`, `tugas`, `mapel`) VALUES
(7, 'UTS - PemrogBerorientasiObjek-S1TIA_2020.pdf', 100, 9, 6, 5),
(8, 'JADWAL UAS SEMESTER GANJIL 2021-2022.pdf', 80, 11, 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_kelas` varchar(12) NOT NULL,
  `jurusan` enum('IPA','IPS') DEFAULT NULL,
  `wali_kelas` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `jurusan`, `wali_kelas`) VALUES
(7, '10 A', 'IPA', 9),
(8, '10 A', 'IPS', 10),
(9, '11 A', 'IPA', 12),
(10, '11 A', 'IPS', 11);

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_mapel` varchar(200) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `nama_mapel`, `Created_at`) VALUES
(1, 'Matematika Wajib', '2021-11-13 02:28:45'),
(2, 'B. Indonesia', '2021-11-13 02:50:46'),
(3, 'Matematika Peminatan', '2021-11-13 17:17:56'),
(5, 'Fisika', '2021-12-10 05:03:08'),
(6, 'Kimia', '2021-12-10 05:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `mapel_kelas`
--

CREATE TABLE `mapel_kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `kelas` int(10) UNSIGNED NOT NULL,
  `guru` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel_kelas`
--

INSERT INTO `mapel_kelas` (`id`, `kelas`, `guru`) VALUES
(7, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `NIS` char(9) NOT NULL,
  `kelas_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama_siswa`, `NIS`, `kelas_id`, `user_id`) VALUES
(9, 'Ayash Batubara', '211402001', 7, 19),
(10, 'Ahmad Budiawan', '211402002', 8, 20),
(11, 'Reisa Ananda', '211402003', 7, 21),
(12, 'Ilham Kurniawan', '211302001', 8, 28),
(13, 'Ayu Nabila', '211302003', 8, 29);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_tugas` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `guru` int(10) UNSIGNED NOT NULL,
  `kelas` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `nama_tugas`, `deskripsi`, `deadline`, `created_at`, `guru`, `kelas`) VALUES
(6, 'Hukum Archimedes dan Pascal', '<p>Buatlah <strong>Rangkuman</strong> tentang <strong>HUKUM ARCHIMEDES</strong>&nbsp;</p><p>Buatlah rangkuman dalam bentuk <strong>PDF</strong></p>', '2021-12-24', '2021-12-10 07:12:06', 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` enum('ADMIN','GURU','SISWA') DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `status`, `Created_at`) VALUES
(1, 'admin', '$2y$10$YUgrqufmksozuj1VtDN1C.8DwEPPBOx3AMT5yFCeYCUsResux2qBq', 'admin@gmail.com', 'ADMIN', '2021-11-13 02:28:01'),
(6, 'admin3', '$2y$10$7QGWGfFoBpnO/0kF79LQ3ulVtr0FKJPh77PKbN7RzumVlxnwsIW.e', 'admin3@gmail.com', 'ADMIN', '2021-11-18 02:41:54'),
(17, 'admin2', '$2y$10$1T4FRmIgNEPdyj5kbrlD5O23xmk7iO/EZZnKISgM74s.ZlJWBlHSi', 'admin2@gmail.com', 'ADMIN', '2021-12-10 04:54:21'),
(18, 'admin4', '$2y$10$QCjBinThkpsjZ7FaM04D7eztjyd3AlL3usKOfUFP2SdS4onihpMHy', 'admin4@gmail.com', 'ADMIN', '2021-12-10 04:54:59'),
(19, 'siswa1', '$2y$10$B9B6hK8zKCG2fdEWRG.qWOVJNixNr0u1TYTkvoWfFxto7eKyiIx/C', 'siswa1@gmail.com', 'SISWA', '2021-12-10 04:56:15'),
(20, 'siswa2', '$2y$10$ds0VimdlzoRdpnUtX0hLOuTwC6o2RCL0ZtM2OT4yNdwarAlU/oT2W', 'siswa2@gmail.com', 'SISWA', '2021-12-10 04:56:32'),
(21, 'siswa3', '$2y$10$TSmVjlQVI8QwC0uM4/B86uv6uEfH8/cpTeweAQCc5WClTIrk8svoi', 'siswa3@gmail.com', 'SISWA', '2021-12-10 04:56:54'),
(23, 'guru2', '$2y$10$FurySm4kfg4Ic1puyPsjKeWtBGMGit6tXuRXPdp9I8ZYLzPwsfBzC', 'guru2@gmail.com', 'GURU', '2021-12-10 05:00:01'),
(24, 'guru3', '$2y$10$5jIzKaTz21xRHpv37cFhDOC9tBhsIbUNXj3FfAdIMOgjWQbQaeNyK', 'guru3@gmail.com', 'GURU', '2021-12-10 05:00:17'),
(25, 'guru4', '$2y$10$TkFvPdWv0CBo1qLoH.1WheL/Hebtt1BRAiAp4dRkndj0GRlZQupMK', 'guru4@gmail.com', 'GURU', '2021-12-10 05:00:32'),
(26, 'guru1', '$2y$10$4PsUfpTNUbobH4ur0liaH.MZt0nauZv1GPRgzZiAlf.JQWb2gaIXy', 'guru1@gmail.com', 'GURU', '2021-12-10 05:04:36'),
(27, 'guru5', '$2y$10$9yBeBKDAM5IrNjbd8719VeoTDvaLtq7jC1cuboUN8Ru4VC1GzHulK', 'guru5@gmail.com', 'GURU', '2021-12-10 05:07:46'),
(28, 'siswa4', '$2y$10$cptKIp2XXcSTmSDj8Bm78utwbjGwVrcJGQMeIKGmEW4h.I/4vOHsS', 'siswa4@gmail.com', 'SISWA', '2021-12-10 05:17:33'),
(29, 'siswa5', '$2y$10$oyg78JO4xOtdXCxYqoZrYu69xLlAoWq/8hAJ7QwFyJauRYH0UzVu.', 'siswa5@gmail.com', 'SISWA', '2021-12-10 05:17:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_guru` (`user_id`),
  ADD KEY `fk_mapel_guru` (`mapel_id`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nilai_siswa` (`siswa`),
  ADD KEY `fk_jawaban_tugas` (`tugas`),
  ADD KEY `fk_mapel_jawaban` (`mapel`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wali` (`wali_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mapel_kelas` (`kelas`),
  ADD KEY `fk_pengajar` (`guru`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kelas` (`kelas_id`),
  ADD KEY `fk_user_siswa` (`user_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tugas_guru` (`guru`),
  ADD KEY `fk_tugas_kelas` (`kelas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `fk_mapel_guru` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_guru` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `fk_jawaban_tugas` FOREIGN KEY (`tugas`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mapel_jawaban` FOREIGN KEY (`mapel`) REFERENCES `mapel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_siswa` FOREIGN KEY (`siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `fk_wali` FOREIGN KEY (`wali_kelas`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD CONSTRAINT `fk_mapel_kelas` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengajar` FOREIGN KEY (`guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_siswa` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `fk_tugas_guru` FOREIGN KEY (`guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tugas_kelas` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
