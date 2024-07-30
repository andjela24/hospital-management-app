-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2024 at 02:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbis2023`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `manufacturer`, `image_path`) VALUES
(1, 'Analgetik', 'Galenika', 'https://ibb.co/w0jtNYV'),
(2, 'VIEKVIN', 'CONING-PPI DOO', 'https://ibb.co/w0jtNYV'),
(3, 'GRAFALON', 'EKOSAN DOO', 'https://ibb.co/Gxg9Pxb'),
(4, 'THYMOGLOBULINE', 'ERAK TRADE DOO', 'https://ibb.co/rfKXJXM'),
(5, 'VERORAB', 'HEMOFARM AD VRŠAC', 'https://ibb.co/Htx59Xr'),
(6, 'MENACTRA', 'HERBA SVET ', 'https://ibb.co/9NHmWsd'),
(7, 'Antibiotik', 'Galenika', 'https://ibb.co/Htx59Xr');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `released_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `first_name`, `last_name`, `date_of_birth`, `phone_number`, `active`, `created_at`, `released_at`) VALUES
(1, 'Pera', 'Peric', '05/01/2006', '6123456789', 0, '2024-03-11 12:46:07', '2024-03-18 12:46:07'),
(2, 'Mika', 'Mikic', '06/06/2006', '06212345678', 1, '2024-03-12 12:46:46', NULL),
(3, 'Zika', 'Zikic', '07/07/2007', '06212345678', 0, '2024-03-12 12:46:59', '2024-03-17 12:46:59'),
(4, 'Joko', 'Jokic', '01/01/2001', '62123456789', 1, '2024-03-17 00:31:57', NULL),
(5, 'Ognjen', 'Ognjenovic', '10/10/2010', '062123456789', 1, '2024-03-18 14:34:43', NULL),
(6, 'Dejan', 'Dejic', '08/08/2008', '062123456789', 1, '2024-03-18 15:44:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `medicine_id`, `patient_id`, `quantity`, `created_at`) VALUES
(1, 1, 1, 1, '2024-03-13'),
(2, 1, 3, 2, '2024-03-15'),
(3, 1, 1, 2, '2024-03-16'),
(4, 2, 3, 2, '2024-03-17'),
(5, 2, 1, 1, '2024-03-18'),
(6, 3, 5, 3, '2024-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Zaposleni');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$RgRh.TpcerJ9p4jwFJi4Qelqwsfe/IT.NZri9lmo5v9ht44JDPy0m', '06012345678'),
(4, 'Zika', 'zika@gmail.com', '$2y$10$vp6bYsOeiiFexcRGVTKFNOtkMbuDAOckNPzR64rEpqtJi36mudOOy', '60123456'),
(5, 'Laza', 'laza@gmail.com', '$2y$10$ieTt53J51D.BAlKh2qPB.OaPeSjC4EZSvyjRst7xAqi4..TWDYmh6', '60123456'),
(8, 'Ivan', 'ivan@gmail.com', '$2y$10$aynQYuzBDjyIhKVd9VAFTeGIoWTP6ixuqRPWeQ0WjPpMrPy2Pj.22', '6012345678'),
(14, 'Milena', 'milena@gmail.com', '$2y$10$XmttAOzY8dGfaTsTSbwsTeZ4nkiSxSL/PkOJiuEyBPWvZrD7fEtsW', '06012345'),
(40, 'Joksim', 'joksim@gmail.com', '$2y$10$bpzx7tHLZSOtTRM0y2iL2ORmy1fl6mXeax20iFIAXSR/Zox28Ulfm', '06212345678'),
(41, 'Pera', 'pera@gmail.com', '$2y$10$vRtKpFLh8DRk/ZRI89kUmOxI1hs7gYh8IOSucuxSclnK/gmIaZR3C', '0612345678');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(7, 4, 2),
(8, 5, 2),
(9, 8, 2),
(10, 14, 2),
(14, 40, 2),
(15, 41, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
