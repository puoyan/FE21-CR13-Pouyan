-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 04, 2021 at 06:05 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fswd13_cr13_bigevents_pouyan`
--
CREATE DATABASE IF NOT EXISTS `fswd13_cr13_bigevents_pouyan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd13_cr13_bigevents_pouyan`;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210903185707', '2021-09-03 18:57:22', 2719);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `type_id_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `type_id_id`, `name`, `date`, `start_time`, `image`, `description`, `capacity`, `email`, `phone`, `url`, `location`, `zip_code`) VALUES
(1, 1, 'VCM 2020', '2020-01-03', '7:00 pm', 's1.jpg', 'e tension on the morning of April 19. Running off together on the \'Reichsbrücke\' bridge. The wide, green Prater with Eliud Kipchoge\'s 1:59 course. Think of all the historic buildings. The spectators. The joy, the effort. Think of the Ringstrasse. How you fight and yet hold on. How you run the last meters and reach the finish in the heart of Vienna. All emotions at one place. Happiness. Tiredness. Pride.', 3000, 'sport@festival.com', '004353234', 'http://www.sport.at', 'runstreet 1', 40133),
(3, 1, 'Musikverein-Führung', '2019-03-01', '7:00 pm', 'm1.jpg', 'The Musikverein is not a Museum and we hope that you will understand that we cannot garantuee the arrangement of guided tours and that a scheduled tour can be cancelled at short notice. Reasons for cancellation can be rehearsals or set changes, amongst others.', 1000, 'ticket@mail.com', '0043345644', 'https://www.musikverein.at/fuehrungen', 'Musikvereinsplatz 1\r\n1010 Wien', 1210),
(4, 1, 'Die Zauberflöte', '2021-05-03', '8:00 pm', 'm2.jpg', 'The Magic Flute“ is a piece of collective cultural heritage and the most frequently performed opera in existence. Mozart’s universal opus is a fixture in the Vienna Volksoper’s repertoire.', 500, 'ticket@mail.com', '004331654', 'www.culturall.com', 'Währinger Straße 78\r\nWien', 1090),
(5, 1, 'Waves Vienna 2021', '2021-09-03', '8:00 pm', 's3.jpg', 'In autumn, the music festival once again brings an exciting and colorful mix of acts from around the world to Vienna. In addition to famous headliners, Waves Vienna also offers the opportunity to discover new talents.', 300, 'ticket@mail.com', '004323452345', 'www.wavesvienna.com', 'Währinger Straße 59\r\nWien', 1090),
(6, 1, 'ImPulsTanz', '2021-09-03', '6:00 pm', 'd1.jpg', 'Dancing is finally on again! ImPulsTanz – Europe\'s biggest dance festival – once again gathers the international dance and performance scene in Vienna from July 15 to August 15. Beyond the performances, there are 180 workshops for everyone who wants to do more than just watch. From voguing to Funktastic Jam.', 100, 'ticket@mail.com', '004352111400', 'http://www.leopoldmuseum.org', 'Museumsplatz 1\r\nWien', 1070),
(7, 1, 'Dancing on impulse', '2021-11-03', '6:00 pm', 'd2.jpg', 'Impulstanz, Europe’s largest dance festival, provides a blend of top performances and an unrivaled workshop program. The Viennese producer, director and presenter Nina Saurugg attends up to eight courses every year – a genuine workshopaholic. She shares her thoughts on high heels, passion and pain', 100, 'ticket@mail.com', '004356789', 'http://www.leopoldmuseum.org', 'Museumsplatz 4\r\nWien', 1070),
(8, 1, 'Brinkmann Performing Arts', '2021-11-03', '6:00 am', 't1.jpg', 'Become a member of our new Foundation, enjoy the many benefits on offer and\r\nhelp us meet future challenges in staging high quality productions!\r\n\r\nIn these difficult times for the performing arts, your support is highly valued.\r\nYour membership in our Foundation or any donations will contribute to keep\r\nour theatre alive and thriving.', 100, 'ticket@mail.com', '004234234234', 'http://www.theater.org', 'theaterst 4\r\nWien', 1090),
(9, 1, 'Theater for children', '2021-11-03', '6:00 am', 's4.jpg', 'Take the stage! Dive into the world of spoken and dance theater, puppet and marionette play and cinema. Be enchanted by the very best in acting.', 50, 'ticket@mail.com', '004234234234', 'http://www.theater.org', 'sportstreet 15Wien', 1110),
(10, 1, 'world music festival', '2016-01-01', '7:00 pm', 'm3.jpg', 'sasfasdf', 123, 'ticket@mail.com', '06603847680', 'www.vienna.com', 'wienstrasse 12 ,Vienna', 1090);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `title`) VALUES
(1, 'Music'),
(2, 'Theater'),
(3, 'Dance'),
(4, 'Sport');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BAE0AA7714819A0` (`type_id_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA7714819A0` FOREIGN KEY (`type_id_id`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
