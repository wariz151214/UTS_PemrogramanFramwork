-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 05:23 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_pemweb_lab`
--
CREATE DATABASE IF NOT EXISTS `uas_pemweb_lab` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `uas_pemweb_lab`;

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `facility_id` char(5) NOT NULL,
  `facility_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`facility_id`, `facility_name`) VALUES
('F0001', 'AC'),
('F0002', 'Restaurant'),
('F0003', 'Swimming Pool'),
('F0004', '24-Hour Front Desk'),
('F0005', 'Parking'),
('F0006', 'Elevator'),
('F0007', 'WiFi');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_bookings`
--

CREATE TABLE `hotel_bookings` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `booking_id` varchar(14) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number_of_rooms` int(10) UNSIGNED NOT NULL,
  `duration` int(10) UNSIGNED NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `price_per_day` bigint(20) UNSIGNED NOT NULL,
  `total_price` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_facilities`
--

CREATE TABLE `hotel_facilities` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `facility_id` char(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_facilities`
--

INSERT INTO `hotel_facilities` (`id`, `hotel_id`, `facility_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(2, 1, 'F0002', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(3, 1, 'F0004', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(4, 1, 'F0005', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(5, 1, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(6, 2, 'F0001', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(7, 2, 'F0002', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(8, 2, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(9, 2, 'F0004', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(10, 2, 'F0005', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(11, 2, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(12, 3, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(13, 3, 'F0005', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(14, 3, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(15, 4, 'F0001', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(16, 4, 'F0002', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(17, 4, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(18, 4, 'F0004', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(19, 4, 'F0005', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(20, 4, 'F0006', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(21, 4, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(22, 5, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(23, 5, 'F0004', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(24, 5, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(25, 5, 'F0002', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(26, 6, 'F0001', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(27, 6, 'F0002', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(28, 6, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(29, 6, 'F0004', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(30, 6, 'F0005', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(31, 6, 'F0006', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(32, 6, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(33, 7, 'F0001', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(34, 7, 'F0002', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(35, 7, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(36, 7, 'F0004', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(37, 7, 'F0005', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(38, 7, 'F0006', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(39, 7, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(40, 8, 'F0001', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(41, 8, 'F0002', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(42, 8, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(43, 8, 'F0004', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(44, 8, 'F0005', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(45, 8, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(46, 9, 'F0001', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(47, 9, 'F0002', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(48, 9, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(49, 9, 'F0004', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(50, 9, 'F0005', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(51, 9, 'F0006', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(52, 9, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(53, 10, 'F0002', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(54, 10, 'F0003', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(55, 10, 'F0004', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(56, 10, 'F0005', '2021-06-10 22:20:26', '2021-06-10 22:20:26'),
(57, 10, 'F0007', '2021-06-10 22:20:26', '2021-06-10 22:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_list`
--

CREATE TABLE `hotel_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `star_rating` int(10) UNSIGNED NOT NULL,
  `number_of_rooms` int(10) UNSIGNED NOT NULL,
  `price_per_day` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `description` longtext NOT NULL,
  `image` mediumtext NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_list`
--

INSERT INTO `hotel_list` (`id`, `name`, `star_rating`, `number_of_rooms`, `price_per_day`, `address`, `city`, `province`, `postal_code`, `description`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'The Oberoi Lombok', 5, 20, 4300000, 'Medana Beach, Tanjung', 'Lombok Utara', 'Nusa Tenggara Barat', '83352', 'Terletak di Lombok, The Oberoi menawarkan parkir gratis, Wi-Fi gratis di area umumnya, dan pusat kebugaran dengan kolam renang outdoor yang menghadap ke laut.', 'the-oberoi-lombok.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL),
(2, 'Katamaran Hotel & Resort', 5, 20, 1300000, 'Jalan Raya Mangsit, Senggigi', 'Lombok', 'Nusa Tenggara Barat', '83355', 'Katamaran Resort terletak di Senggigi, Lombok, dan memiliki kolam renang luar ruangan yang besar serta area pantai pribadi. Restoran di hotel ini menyajikan masakan internasional, dan Anda dapat menikmati minuman sambil memandang matahari terbenam di bar. Resor tepi pantai ini menyediakan akses Wi-Fi gratis dan parkir gratis.', 'katamaran-hotel-resort.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL),
(3, 'Intercontinental Bali Resort', 5, 20, 1600000, 'Jalan Uluwatu 45, Jimbaran, Kuta Selatan', 'Denpasar', 'Bali', '80361', 'InterContinental Bali Resort di Teluk Jimbaran, 10 menit berkendara dari Bandara Internasional Ngurah Rai, menyediakan hotel dengan 6 kolam renang, pusat kebugaran 24 jam, serta WiFi gratis di seluruh areanya.', 'intercontinental-bali-resort.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL),
(4, 'The Apurva Kempinski Bali', 5, 20, 3600000, 'Jalan Raya Nusa Dua Selatan, Sawangan', 'Denpasar', 'Bali', '80361', 'Dikelilingi oleh tanaman hijau subur yang menghadap ke laut, The Apurva Kempinski Bali menawarkan penginapan mewah di Nusa Dua. Menawarkan kolam renang outdoor sepanjang 60 meter, resor ini juga memiliki spa. Parkir gratis dan Wi-Fi gratis disediakan.', 'the-apurva-kempinski-bali.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL),
(5, 'Amanjiwo', 5, 20, 13000000, 'Ds. Majaksingi Borobudur, Borobudur', 'Magelang', 'Jawa Tengah', '56501', 'Amanjiwo has a restaurant, fitness centre, a bar and garden in Magelang. This 5-star hotel offers a 24-hour front desk and room service. There is an outdoor pool and guests can make use of free WiFi and free private parking.', 'amanjiwo.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL),
(6, 'Plataran Heritage Borobudur Hotel', 4, 20, 2300000, 'Dusun Kretek, Karangrejo', 'Magelang', 'Jawa Tengah', '56553', 'Plataran Heritage Borobudur Hotel, 19 menit berjalan kaki dari Candi Borobudur yang ikonik di Magelang, menawarkan akomodasi yang dikelilingi oleh tanaman hijau tropis dan pemandangan Menoreh Hill serta fasilitas kolam renang terbuka besar, restoran mewah, pusat spa mewah, serta WiFi gratis di seluruh areanya.', 'plataran-heritage-borobudur-hotel.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL),
(7, 'Aston Pasteur', 4, 20, 650000, 'Jalan Dr. Djunjunan No. 162 , Pasteur', 'Bandung', 'Jawa Barat', '40162', 'Memiliki sebuah kolam renang outdoor dan restoran, Aston Pasteur menawarkan akomodasi di Bandung. Wi-Fi dapat diakses secara gratis di seluruh area hotel, dan layanan antar-jemput gratis ke bandara juga tersedia.', 'aston-pasteur.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL),
(8, 'The Trans Luxury Hotel', 5, 20, 2500000, 'Jl. Gatot Subroto No. 289, Buahbatu', 'Bandung', 'Jawa Barat', '40273', 'Terletak di Kompleks Trans Studio Bandung yang terintegrasi, The Trans Luxury Hotel Bandung menawarkan kamar-kamar modern dengan iPod dock. Hotel ini memiliki kolam renang luar ruangan, pusat spa, dan pusat kebugaran 24 jam. Wi-Fi tersedia gratis di seluruh area hotel.', 'the-trans-luxury-hotel.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL),
(9, 'Hotel Indonesia Kempinski Jakarta', 5, 20, 2500000, 'Jalan MH Thamrin No. 1, Thamrin', 'Jakarta Pusat', 'Jakarta', '10310', 'Terletak di jantung daerah Jakarta Pusat dekat dengan Bundaran HI yang terkenal, Hotel Indonesia Kempinski Jakarta menawarkan akomodasi bintang 5 dengan pemandangan cakrawala kota. Hotel ini menawarkan 6 pilihan tempat makan, spa mewah, dan kolam renang di atap gedung.', 'hotel-indonesia-kempinski-jakarta.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL),
(10, 'Sari Pacific Jakarta', 4, 20, 1100000, 'Jl. MH Thamrin No. 6, Thamrin', 'Jakarta Pusat', 'Jakarta', '10340', 'Sari Pacific Jakarta merupakan akomodasi mewah yang berjarak 1 km dari Stasiun Kereta Api Gambir serta dekat Bundaran HI dan Sarinah Shopping Mall. Hotel ini menawarkan 4 pilihan tempat bersantap, kolam renang terbuka, dan kamar-kamar yang luas dengan Wi-Fi gratis.', 'sari-pacific-jakarta.jpg', '2021-06-10 22:20:26', '2021-06-10 22:20:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `uid` varchar(15) NOT NULL,
  `role_id` char(5) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `avatar` mediumtext NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `uid`, `role_id`, `full_name`, `email`, `password`, `birth_date`, `phone_number`, `gender`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'pP2BxTSOiXjJ', 'R0001', 'Admin', 'admin@umn.ac.id', '$2y$10$YgXgVr4e0vEIkEAMa8XObuyqmvKSAqbF4Rnk1cInQIWJ39T0FGIXC', '2021-06-10', '6201234567890', 'M', 'avatar-placeholder.png', '2021-06-10 22:22:12', '2021-06-10 22:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` char(5) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`) VALUES
('R0001', 'Admin'),
('R0002', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hotel_facilities`
--
ALTER TABLE `hotel_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `facility_id` (`facility_id`);

--
-- Indexes for table `hotel_list`
--
ALTER TABLE `hotel_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_facilities`
--
ALTER TABLE `hotel_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `hotel_list`
--
ALTER TABLE `hotel_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  ADD CONSTRAINT `hotel_bookings_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel_list` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hotel_bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_accounts` (`uid`) ON UPDATE CASCADE;

--
-- Constraints for table `hotel_facilities`
--
ALTER TABLE `hotel_facilities`
  ADD CONSTRAINT `hotel_facilities_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel_list` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `hotel_facilities_ibfk_2` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`facility_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD CONSTRAINT `user_accounts_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`role_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
