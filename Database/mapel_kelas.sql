-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 03:53 PM
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
(1, 2, 6),
(2, 2, 8),
(3, 5, 6),
(5, 4, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mapel_kelas` (`kelas`),
  ADD KEY `fk_pengajar` (`guru`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mapel_kelas`
--
ALTER TABLE `mapel_kelas`
  ADD CONSTRAINT `fk_mapel_kelas` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengajar` FOREIGN KEY (`guru`) REFERENCES `guru` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
