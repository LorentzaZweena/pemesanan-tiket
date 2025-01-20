-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 09:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemesanan-tiket`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_tiket`
--

CREATE TABLE `pemesanan_tiket` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_identitas` varchar(30) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tempat_wisata` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_pengunjung` int(13) NOT NULL,
  `pengunjung_anak` int(13) NOT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan_tiket`
--

INSERT INTO `pemesanan_tiket` (`id`, `nama`, `no_identitas`, `no_hp`, `tempat_wisata`, `tanggal`, `jumlah_pengunjung`, `pengunjung_anak`, `total`) VALUES
(1, 'Zweena Ariva', '7489374957382745', '29479285475827483', 3, '2025-01-20', 3, 2, 'Rp 5.000,00'),
(2, 'Ariva Zweena', '3443294754934732', '2345678303289344', 1, '2025-01-20', 8, 4, 'Rp 160.000,00'),
(3, 'Yoga kacamata', '3478359392722014', '45739292478540284', 1, '2025-01-04', 5, 4, 'Rp 40.000,00'),
(4, 'Avira Aneewz', '4574534676778788', '549574958304876493', 2, '2025-01-25', 2, 1, 'Rp 25.000,00'),
(5, 'Avira Aneewz', '4574534676778788', '549574958304876493', 2, '2025-01-25', 10, 5, 'Rp 125.000,00'),
(6, 'Yoga cilebut', '1325374728372849', '738273927849274928', 1, '2025-01-31', 4, 2, 'Rp 80.000,00'),
(7, 'qwerty', '3487638493743323', '678567459863543', 3, '2025-02-08', 3, 2, 'Rp 5.000,00'),
(8, 'dimas', '6435876438783572', '34564387568734754', 1, '2025-01-04', 5, 2, 'Rp 120.000,00');

-- --------------------------------------------------------

--
-- Table structure for table `tempat-wisata`
--

CREATE TABLE `tempat-wisata` (
  `id_tempat` int(11) NOT NULL,
  `tempat_wisata` varchar(50) NOT NULL,
  `harga` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tempat-wisata`
--

INSERT INTO `tempat-wisata` (`id_tempat`, `tempat_wisata`, `harga`) VALUES
(1, 'Kebun raya bogor', 40000),
(2, 'Museum zoologi', 25000),
(3, 'Museum Perjoanan Bogor', 5000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pemesanan_tiket`
--
ALTER TABLE `pemesanan_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempat-wisata`
--
ALTER TABLE `tempat-wisata`
  ADD PRIMARY KEY (`id_tempat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemesanan_tiket`
--
ALTER TABLE `pemesanan_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tempat-wisata`
--
ALTER TABLE `tempat-wisata`
  MODIFY `id_tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
