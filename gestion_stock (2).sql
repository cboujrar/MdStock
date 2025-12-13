-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 08:26 PM
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
-- Database: `gestion_stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `id_categorie_id` int(11) NOT NULL,
  `id_depot_id` int(11) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `prix` double NOT NULL,
  `quantite` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `min_quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `id_categorie_id`, `id_depot_id`, `nom`, `description`, `prix`, `quantite`, `image`, `min_quantite`) VALUES
(21, 20, 12, 'Clavier mecanique', 'lumiere mixte, avec effet de lumiere RGB personnaliser', 207, 200, '8331718215321.jpg', 10),
(22, 20, 12, 'pc portable', 'Lenovo thinkpad L530-I5-8G-250Go-full hd-AZERTY', 1789, 96, '6551718215455.jpg', 5),
(23, 20, 12, 'Monitor', 'XIAOMI Monitor A22i 2145in 24W Max 75Hz Aspect ratio 169', 862, 80, '2581718215533.jpg', 25),
(24, 21, 12, 'Air fryer1', 'Mellerware Friteuse à air sans huile AIR FRYER MDF5S DIGITAL 8programmes5L', 749, 1000, '4601718215672.jpg', 100),
(25, 21, 13, 'Nespresso machine ', 'Nespresso Machine Inissia Rouge + 14 capsules Nespresso', 1132, 450, '3411718215756.jpg', 50),
(26, -1, 13, 'chaise', '  Chaise robuste bureau maison', 239, 280, '6751718215896.jpg', 40),
(27, -1, 13, 'chaise gaming', 'Chaise gaming blue Nouveau design', 1359, 55, '4771718216002.jpg', 15),
(29, 22, 12, 'television', 'PARTAGEZ CE PRODUIT   Boutique Officielle FS Samsung 32\" Smart Tv HD - Récepteur Intégré - TNT - HDM', 1499, 500, '1051719151673.jpeg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `bon_commande`
--

CREATE TABLE `bon_commande` (
  `id` int(11) NOT NULL,
  `code_status_id` int(11) DEFAULT NULL,
  `id_fournisseur_id` int(11) DEFAULT NULL,
  `date_commande` date NOT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `date_livraison` date NOT NULL,
  `facture_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bon_commande`
--

INSERT INTO `bon_commande` (`id`, `code_status_id`, `id_fournisseur_id`, `date_commande`, `observation`, `date_livraison`, `facture_id`) VALUES
(27, 1, 7, '2024-06-23', 'test', '2024-06-24', 33),
(28, 3, 10, '2024-06-10', 'observation', '2024-06-17', 34),
(29, 2, 9, '2024-06-02', 'test2', '2024-06-09', 35),
(30, 3, 10, '2024-06-12', 'tessst', '2024-06-14', 36),
(31, 3, 9, '2024-06-17', 'commande des ecrans', '2024-06-18', 37),
(32, 3, 10, '2024-06-04', 'des materiels informatique', '2024-06-04', 38),
(33, 2, 9, '2024-06-10', 'bureaux', '2024-06-11', 39);

-- --------------------------------------------------------

--
-- Table structure for table `bon_sortie`
--

CREATE TABLE `bon_sortie` (
  `id` int(11) NOT NULL,
  `observation` varchar(100) DEFAULT NULL,
  `facture_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bon_sortie`
--

INSERT INTO `bon_sortie` (`id`, `observation`, `facture_id`) VALUES
(23, 'test', 40),
(24, 'test1', 41),
(25, 'vente des ordinateurs', 42),
(26, 'les materiels de maison', 43),
(27, 'test', 44);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom_categorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom_categorie`) VALUES
(-1, 'default'),
(20, 'Informatique'),
(21, 'Electromenager'),
(22, 'Maison '),
(26, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `depot`
--

CREATE TABLE `depot` (
  `id` int(11) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `capacite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depot`
--

INSERT INTO `depot` (`id`, `adresse`, `capacite`) VALUES
(12, 'Rue abdelkarim  el khatabi Marrakech', 7000000),
(13, 'Massira 1 Marrakech', 800000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bon_commande`
--

CREATE TABLE `detail_bon_commande` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` double NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `bon_commande_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_bon_commande`
--

INSERT INTO `detail_bon_commande` (`id`, `quantite`, `prix`, `article_id`, `bon_commande_id`) VALUES
(30, 50, 10000, 21, 33),
(31, 100, 2000, 22, 33);

-- --------------------------------------------------------

--
-- Table structure for table `detail_bon_sortie`
--

CREATE TABLE `detail_bon_sortie` (
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `idbs_id` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_bon_sortie`
--

INSERT INTO `detail_bon_sortie` (`id`, `quantite`, `idbs_id`, `article_id`) VALUES
(33, 4, 26, 22);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240428150023', '2024-04-28 17:00:48', 817),
('DoctrineMigrations\\Version20240505121342', '2024-05-05 14:14:31', 14),
('DoctrineMigrations\\Version20240505204926', '2024-05-05 22:49:50', 164),
('DoctrineMigrations\\Version20240506220616', '2024-05-07 00:07:00', 44),
('DoctrineMigrations\\Version20240506221253', '2024-05-07 00:12:57', 109),
('DoctrineMigrations\\Version20240506221413', '2024-05-07 00:14:18', 43),
('DoctrineMigrations\\Version20240507155822', '2024-05-07 17:58:44', 184),
('DoctrineMigrations\\Version20240508134051', '2024-05-08 15:41:08', 50),
('DoctrineMigrations\\Version20240508193215', '2024-05-08 21:32:25', 288),
('DoctrineMigrations\\Version20240508193831', '2024-05-08 21:38:36', 48),
('DoctrineMigrations\\Version20240508193942', '2024-05-08 21:39:45', 56),
('DoctrineMigrations\\Version20240508194326', '2024-05-08 21:43:31', 113),
('DoctrineMigrations\\Version20240508200349', '2024-05-08 22:17:20', 14),
('DoctrineMigrations\\Version20240508205735', '2024-05-08 22:57:55', 16),
('DoctrineMigrations\\Version20240514173940', '2024-05-14 19:39:56', 187),
('DoctrineMigrations\\Version20240519174152', '2024-05-19 19:42:17', 136),
('DoctrineMigrations\\Version20240519174318', '2024-05-19 19:43:25', 98),
('DoctrineMigrations\\Version20240520205917', '2024-05-20 22:59:35', 494),
('DoctrineMigrations\\Version20240520210110', '2024-05-20 23:01:17', 1719),
('DoctrineMigrations\\Version20240521124704', '2024-05-21 14:47:11', 431),
('DoctrineMigrations\\Version20240521154925', '2024-05-21 17:49:33', 194),
('DoctrineMigrations\\Version20240521163726', '2024-05-21 18:37:34', 111),
('DoctrineMigrations\\Version20240521163940', '2024-05-21 18:39:47', 86),
('DoctrineMigrations\\Version20240523123043', '2024-05-23 14:31:12', 73),
('DoctrineMigrations\\Version20240523123551', '2024-05-23 14:35:55', 13),
('DoctrineMigrations\\Version20240523123707', '2024-05-23 14:37:14', 17),
('DoctrineMigrations\\Version20240523140818', '2024-05-23 16:08:23', 102),
('DoctrineMigrations\\Version20240523144055', '2024-05-23 16:41:00', 24),
('DoctrineMigrations\\Version20240523144146', '2024-05-23 16:41:52', 92),
('DoctrineMigrations\\Version20240523144728', '2024-05-23 16:47:31', 63),
('DoctrineMigrations\\Version20240527165201', '2024-05-27 18:52:17', 271),
('DoctrineMigrations\\Version20240527170517', '2024-05-27 19:05:21', 32),
('DoctrineMigrations\\Version20240527170554', '2024-05-29 16:31:52', 254),
('DoctrineMigrations\\Version20240603141919', '2024-06-03 16:19:46', 281),
('DoctrineMigrations\\Version20240603142228', '2024-06-03 16:22:34', 98),
('DoctrineMigrations\\Version20240604190716', '2024-06-04 21:07:32', 134),
('DoctrineMigrations\\Version20240610135429', '2024-06-10 15:54:47', 138);

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `id` int(11) NOT NULL,
  `date_paiement` date DEFAULT NULL,
  `totale` double DEFAULT NULL,
  `mode_paiment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`id`, `date_paiement`, `totale`, `mode_paiment_id`) VALUES
(33, NULL, NULL, NULL),
(34, NULL, NULL, NULL),
(35, NULL, NULL, NULL),
(36, NULL, NULL, NULL),
(37, NULL, NULL, NULL),
(38, NULL, NULL, NULL),
(39, NULL, 700000, NULL),
(40, NULL, NULL, 1),
(41, NULL, NULL, 2),
(42, NULL, NULL, 4),
(43, NULL, 7156, 3),
(44, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom_fournisseur` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom_fournisseur`, `adresse`, `telephone`, `email`) VALUES
(7, 'Fournitures Industrielles Maroc', '123 Rue de l\'Industrie, Casablanca, Maroc', 522334455, 'contact@fournituresindustrielles.ma'),
(8, 'Matériaux de Construction Maroc', '456 Avenue des Bâtisseurs, Rabat, Maroc', 537667788, 'info@materiauxconstruction.ma'),
(9, 'Équipements Pro Maroc', '789 Boulevard du Travail, Marrakech, Maroc', 524889900, 'service@equipementspro.ma'),
(10, 'Technologie Avancée Maroc', '321 Rue de la Technologie, Fès, Maroc', 535556677, 'contact@techavancee.ma');

-- --------------------------------------------------------

--
-- Table structure for table `historique_operation`
--

CREATE TABLE `historique_operation` (
  `id` int(11) NOT NULL,
  `entite` varchar(50) NOT NULL,
  `utilisateur` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `historique_operation`
--

INSERT INTO `historique_operation` (`id`, `entite`, `utilisateur`, `date`, `type_id`) VALUES
(13, 'Utilisateur', 'admin', '2024-06-03 16:34:09', 2),
(14, 'Utilisateur', 'admin', '2024-06-03 17:23:06', 3),
(15, 'Utilisateur', 'admin', '2024-06-03 17:23:24', 1),
(16, 'Utilisateur', 'chaima', '2024-06-03 17:37:55', 1),
(19, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:08:14', 1),
(20, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:08:14', 1),
(21, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:08:14', 1),
(22, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:08:14', 1),
(23, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:08:14', 1),
(24, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:08:14', 1),
(25, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:08:14', 1),
(26, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:08:14', 1),
(27, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:09:54', 1),
(28, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:09:54', 1),
(29, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:09:54', 1),
(30, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:09:54', 1),
(31, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:09:54', 1),
(32, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:09:54', 1),
(33, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:12:38', 1),
(34, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:12:38', 1),
(35, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:12:38', 1),
(36, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:12:38', 1),
(37, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:12:38', 1),
(38, 'privilege_utilisateur', 'Youssef', '2024-06-05 22:12:38', 1),
(39, 'privilege_utilisateur', 'chaima', '2024-06-06 16:45:18', 1),
(40, 'privilege_utilisateur', 'chaima', '2024-06-06 16:45:18', 1),
(41, 'privilege_utilisateur', 'chaima', '2024-06-06 16:45:18', 1),
(42, 'privilege_utilisateur', 'chaima', '2024-06-06 17:20:44', 1),
(43, 'privilege_utilisateur', 'chaima', '2024-06-06 17:20:44', 1),
(44, 'privilege_utilisateur', 'admin', '2024-06-06 17:22:25', 1),
(45, 'privilege_utilisateur', 'admin', '2024-06-06 17:22:25', 1),
(46, 'privilege_utilisateur', 'admin', '2024-06-06 17:22:25', 1),
(47, 'privilege_utilisateur', 'admin', '2024-06-06 17:22:25', 1),
(48, 'privilege_utilisateur', 'admin', '2024-06-06 17:22:25', 1),
(49, 'privilege_utilisateur', 'admin', '2024-06-06 17:22:25', 1),
(50, 'privilege_utilisateur', 'admin', '2024-06-06 17:22:25', 1),
(51, 'privilege_utilisateur', 'admin', '2024-06-06 17:23:52', 1),
(52, 'privilege_utilisateur', 'admin', '2024-06-06 17:23:52', 1),
(53, 'privilege_utilisateur', 'admin', '2024-06-06 17:23:52', 1),
(54, 'privilege_utilisateur', 'admin', '2024-06-06 17:23:52', 1),
(55, 'privilege_utilisateur', 'admin', '2024-06-06 17:23:52', 1),
(56, 'privilege_utilisateur', 'admin', '2024-06-06 17:23:52', 1),
(57, 'privilege_utilisateur', 'admin', '2024-06-06 17:23:52', 1),
(58, 'privilege_utilisateur', 'chaima', '2024-06-06 17:25:39', 1),
(59, 'privilege_utilisateur', 'chaima', '2024-06-06 17:25:39', 1),
(60, 'privilege_utilisateur', 'chaima', '2024-06-06 17:25:39', 1),
(61, 'privilege_utilisateur', 'chaima', '2024-06-06 17:25:39', 1),
(62, 'privilege_utilisateur', 'chaima', '2024-06-06 17:25:39', 1),
(63, 'privilege_utilisateur', 'chaima', '2024-06-06 17:50:14', 1),
(64, 'privilege_utilisateur', 'chaima', '2024-06-06 17:50:14', 1),
(65, 'privilege_utilisateur', 'chaima', '2024-06-06 17:50:14', 1),
(66, 'privilege_utilisateur', 'chaima', '2024-06-06 17:50:14', 1),
(67, 'privilege_utilisateur', 'chaima', '2024-06-06 17:50:14', 1),
(68, 'privilege_utilisateur', 'chaima', '2024-06-06 17:50:14', 1),
(69, 'privilege_utilisateur', 'admin', '2024-06-06 20:38:55', 1),
(70, 'privilege_utilisateur', 'admin', '2024-06-06 20:38:55', 1),
(71, 'privilege_utilisateur', 'admin', '2024-06-06 20:38:55', 1),
(72, 'privilege_utilisateur', 'admin', '2024-06-06 20:38:55', 1),
(73, 'privilege_utilisateur', 'admin', '2024-06-06 20:38:55', 1),
(74, 'privilege_utilisateur', 'admin', '2024-06-06 20:40:21', 1),
(75, 'privilege_utilisateur', 'admin', '2024-06-06 20:40:21', 1),
(76, 'privilege_utilisateur', 'admin', '2024-06-06 20:40:21', 1),
(77, 'privilege_utilisateur', 'admin', '2024-06-06 20:40:21', 1),
(78, 'privilege_utilisateur', 'admin', '2024-06-06 20:40:21', 1),
(79, 'privilege_utilisateur', 'admin', '2024-06-06 20:40:21', 1),
(80, 'privilege_utilisateur', 'admin', '2024-06-06 20:40:21', 1),
(81, 'privilege_utilisateur', 'admin', '2024-06-06 20:42:42', 1),
(82, 'privilege_utilisateur', 'admin', '2024-06-06 20:42:42', 1),
(83, 'privilege_utilisateur', 'admin', '2024-06-06 20:42:42', 1),
(84, 'privilege_utilisateur', 'admin', '2024-06-06 20:42:42', 1),
(85, 'privilege_utilisateur', 'admin', '2024-06-06 20:42:42', 1),
(86, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:03', 1),
(87, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:03', 1),
(88, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:03', 1),
(89, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:03', 1),
(90, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:03', 1),
(91, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:52', 1),
(92, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:52', 1),
(93, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:52', 1),
(94, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:52', 1),
(95, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:52', 1),
(96, 'privilege_utilisateur', 'chaima', '2024-06-06 21:14:52', 1),
(97, 'privilege_utilisateur', 'chaima', '2024-06-06 21:19:14', 1),
(98, 'privilege_utilisateur', 'chaima', '2024-06-06 21:19:14', 1),
(99, 'privilege_utilisateur', 'chaima', '2024-06-06 21:19:14', 1),
(100, 'privilege_utilisateur', 'chaima', '2024-06-06 21:19:14', 1),
(101, 'privilege_utilisateur', 'chaima', '2024-06-06 21:19:14', 1),
(102, 'privilege_utilisateur', 'chaima', '2024-06-09 15:41:11', 1),
(103, 'privilege_utilisateur', 'chaima', '2024-06-09 15:41:11', 1),
(104, 'privilege_utilisateur', 'chaima', '2024-06-09 15:41:11', 1),
(105, 'privilege_utilisateur', 'chaima', '2024-06-09 15:41:11', 1),
(106, 'privilege_utilisateur', 'chaima', '2024-06-09 15:41:11', 1),
(107, 'privilege_utilisateur', 'chaima', '2024-06-09 15:41:11', 1),
(108, 'privilege_utilisateur', 'chaima', '2024-06-09 15:49:18', 1),
(109, 'privilege_utilisateur', 'chaima', '2024-06-09 15:49:18', 1),
(110, 'privilege_utilisateur', 'chaima', '2024-06-09 15:49:18', 1),
(111, 'privilege_utilisateur', 'chaima', '2024-06-09 15:49:18', 1),
(112, 'privilege_utilisateur', 'chaima', '2024-06-09 15:49:18', 1),
(113, 'privilege_utilisateur', 'chaima', '2024-06-09 15:49:18', 1),
(114, 'privilege_utilisateur', 'chaima', '2024-06-09 15:49:18', 1),
(115, 'privilege_utilisateur', 'chaima', '2024-06-09 17:50:02', 1),
(116, 'privilege_utilisateur', 'chaima', '2024-06-09 17:50:02', 1),
(117, 'privilege_utilisateur', 'chaima', '2024-06-09 17:50:02', 1),
(118, 'privilege_utilisateur', 'chaima', '2024-06-09 17:50:02', 1),
(119, 'privilege_utilisateur', 'chaima', '2024-06-09 17:50:02', 1),
(120, 'privilege_utilisateur', 'chaima', '2024-06-09 17:50:02', 1),
(121, 'privilege_utilisateur', 'chaima', '2024-06-09 17:51:43', 1),
(122, 'privilege_utilisateur', 'chaima', '2024-06-09 17:51:43', 1),
(123, 'privilege_utilisateur', 'chaima', '2024-06-09 17:51:43', 1),
(124, 'privilege_utilisateur', 'chaima', '2024-06-09 17:51:43', 1),
(125, 'privilege_utilisateur', 'chaima', '2024-06-09 17:51:43', 1),
(126, 'privilege_utilisateur', 'chaima', '2024-06-09 17:52:42', 1),
(127, 'privilege_utilisateur', 'chaima', '2024-06-09 17:52:42', 1),
(128, 'privilege_utilisateur', 'chaima', '2024-06-09 17:52:42', 1),
(129, 'privilege_utilisateur', 'chaima', '2024-06-09 17:52:42', 1),
(130, 'privilege_utilisateur', 'chaima', '2024-06-09 17:52:42', 1),
(131, 'privilege_utilisateur', 'chaima', '2024-06-09 17:52:42', 1),
(132, 'privilege_utilisateur', 'chaima', '2024-06-09 18:00:15', 1),
(133, 'privilege_utilisateur', 'chaima', '2024-06-09 18:00:15', 1),
(134, 'privilege_utilisateur', 'chaima', '2024-06-09 18:00:15', 1),
(135, 'privilege_utilisateur', 'chaima', '2024-06-09 18:00:15', 1),
(136, 'privilege_utilisateur', 'chaima', '2024-06-09 18:00:15', 1),
(137, 'privilege_utilisateur', 'chaima', '2024-06-09 18:00:15', 1),
(138, 'privilege_utilisateur', 'chaima', '2024-06-09 18:00:15', 1),
(139, 'Article', 'chaima', '2024-06-09 18:00:59', 1),
(140, 'privilege_utilisateur', 'chaima', '2024-06-09 18:01:31', 1),
(141, 'privilege_utilisateur', 'chaima', '2024-06-09 18:01:31', 1),
(142, 'privilege_utilisateur', 'chaima', '2024-06-09 18:01:31', 1),
(143, 'privilege_utilisateur', 'chaima', '2024-06-09 18:01:31', 1),
(144, 'privilege_utilisateur', 'chaima', '2024-06-09 18:01:31', 1),
(145, 'privilege_utilisateur', 'chaima', '2024-06-09 18:01:31', 1),
(146, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:08', 1),
(147, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:08', 1),
(148, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:08', 1),
(149, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:08', 1),
(150, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:08', 1),
(151, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:08', 1),
(152, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:35', 1),
(153, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:35', 1),
(154, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:35', 1),
(155, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:35', 1),
(156, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:35', 1),
(157, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:35', 1),
(158, 'privilege_utilisateur', 'chaima', '2024-06-09 18:08:35', 1),
(159, 'Article', 'chaima', '2024-06-09 18:08:50', 2),
(160, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(161, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(162, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(163, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(164, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(165, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(166, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(167, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(168, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(169, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(170, 'privilege_utilisateur', 'chaima', '2024-06-09 18:21:36', 1),
(171, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(172, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(173, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(174, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(175, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(176, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(177, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(178, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(179, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(180, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(181, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(182, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(183, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(184, 'privilege_utilisateur', 'chaima', '2024-06-09 18:35:38', 1),
(185, 'Detail bon sortie', 'chaima', '2024-06-09 18:36:16', 1),
(186, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(187, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(188, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(189, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(190, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(191, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(192, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(193, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(194, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(195, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(196, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(197, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(198, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(199, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(200, 'privilege_utilisateur', 'chaima', '2024-06-09 18:43:59', 1),
(201, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(202, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(203, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(204, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(205, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(206, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(207, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(208, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(209, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(210, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(211, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(212, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(213, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(214, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(215, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(216, 'privilege_utilisateur', 'chaima', '2024-06-09 18:52:02', 1),
(217, 'categorie', 'chaima', '2024-06-09 21:06:28', 1),
(218, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(219, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(220, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(221, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(222, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(223, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(224, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(225, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(226, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(227, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(228, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(229, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(230, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(231, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(232, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(233, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(234, 'privilege_utilisateur', 'chaima', '2024-06-09 21:32:46', 1),
(235, 'categorie', 'chaima', '2024-06-09 21:33:01', 3),
(236, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(237, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(238, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(239, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(240, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(241, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(242, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(243, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(244, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(245, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(246, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(247, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(248, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(249, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(250, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(251, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(252, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(253, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(254, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(255, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(256, 'privilege_utilisateur', 'chaima', '2024-06-09 21:37:57', 1),
(257, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(258, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(259, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(260, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(261, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(262, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(263, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(264, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(265, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(266, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(267, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(268, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(269, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(270, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(271, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(272, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(273, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(274, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(275, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(276, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(277, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(278, 'privilege_utilisateur', 'chaima', '2024-06-09 21:41:31', 1),
(279, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(280, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(281, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(282, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(283, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(284, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(285, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(286, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(287, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(288, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(289, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(290, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(291, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(292, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(293, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(294, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(295, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(296, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(297, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(298, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(299, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(300, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(301, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(302, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(303, 'privilege_utilisateur', 'chaima', '2024-06-09 21:43:57', 1),
(304, 'Bon sortie', 'chaima', '2024-06-09 21:44:09', 1),
(305, 'Detail bon sortie', 'chaima', '2024-06-09 21:45:29', 1),
(306, 'Detail bon sortie', 'chaima', '2024-06-09 21:46:14', 1),
(307, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(308, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(309, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(310, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(311, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(312, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(313, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(314, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(315, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(316, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(317, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(318, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(319, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(320, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(321, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(322, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(323, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(324, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(325, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(326, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(327, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(328, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(329, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(330, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(331, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(332, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:32', 1),
(333, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(334, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(335, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(336, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(337, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(338, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(339, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(340, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(341, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(342, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(343, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(344, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(345, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(346, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(347, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(348, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(349, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(350, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(351, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(352, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(353, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(354, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(355, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(356, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(357, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(358, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(359, 'privilege_utilisateur', 'chaima', '2024-06-09 21:51:47', 1),
(360, 'Bon commande', 'chaima', '2024-06-09 21:57:37', 1),
(361, 'Detail bon commande', 'chaima', '2024-06-09 21:58:40', 1),
(362, 'Detail bon commande', 'chaima', '2024-06-09 22:00:27', 1),
(363, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(364, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(365, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(366, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(367, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(368, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(369, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(370, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(371, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(372, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(373, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(374, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(375, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(376, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(377, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(378, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(379, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(380, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(381, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(382, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(383, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(384, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(385, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(386, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(387, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(388, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(389, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(390, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(391, 'privilege_utilisateur', 'chaima', '2024-06-09 22:02:11', 1),
(392, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(393, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(394, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(395, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(396, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(397, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(398, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(399, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(400, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(401, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(402, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(403, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(404, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(405, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(406, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(407, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(408, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(409, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(410, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(411, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(412, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(413, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(414, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(415, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(416, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(417, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(418, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(419, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(420, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(421, 'privilege_utilisateur', 'chaima', '2024-06-10 12:48:28', 1),
(422, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(423, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(424, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(425, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(426, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(427, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(428, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(429, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(430, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(431, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(432, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(433, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(434, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(435, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(436, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(437, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(438, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(439, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(440, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(441, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(442, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(443, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(444, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(445, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(446, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(447, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(448, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(449, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(450, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(451, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(452, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(453, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(454, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(455, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(456, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(457, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(458, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(459, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(460, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(461, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(462, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(463, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(464, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(465, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(466, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(467, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(468, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(469, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(470, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(471, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(472, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(473, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(474, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(475, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(476, 'privilege_utilisateur', 'chaima', '2024-06-10 13:06:57', 1),
(477, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(478, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(479, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(480, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(481, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(482, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(483, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(484, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(485, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(486, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(487, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(488, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(489, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(490, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(491, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(492, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(493, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(494, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(495, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(496, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(497, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(498, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(499, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(500, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(501, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(502, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(503, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(504, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(505, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(506, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(507, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(508, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(509, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(510, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(511, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(512, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(513, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(514, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(515, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(516, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(517, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(518, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(519, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(520, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(521, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(522, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(523, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(524, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(525, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(526, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(527, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(528, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(529, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(530, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(531, 'privilege_utilisateur', 'test', '2024-06-10 13:35:50', 1),
(532, 'Detail bon sortie', 'test', '2024-06-10 13:42:35', 1),
(533, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(534, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(535, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(536, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(537, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(538, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(539, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(540, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(541, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(542, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(543, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(544, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(545, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(546, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(547, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(548, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(549, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(550, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(551, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(552, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(553, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(554, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(555, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(556, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(557, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(558, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(559, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(560, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(561, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(562, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(563, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(564, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(565, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(566, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(567, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(568, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(569, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(570, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(571, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(572, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(573, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(574, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(575, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(576, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(577, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(578, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(579, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(580, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(581, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(582, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(583, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(584, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(585, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(586, 'privilege_utilisateur', 'test', '2024-06-10 13:52:08', 1),
(587, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(588, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(589, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(590, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(591, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(592, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(593, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(594, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(595, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(596, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(597, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(598, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(599, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(600, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(601, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(602, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(603, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(604, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(605, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(606, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(607, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(608, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(609, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(610, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(611, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(612, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(613, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(614, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(615, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(616, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(617, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(618, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(619, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(620, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(621, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(622, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(623, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(624, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(625, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(626, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(627, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(628, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(629, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(630, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(631, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(632, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(633, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(634, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(635, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(636, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(637, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(638, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(639, 'privilege_utilisateur', 'test', '2024-06-10 13:55:09', 1),
(640, 'privilege_utilisateur', 'chaima', '2024-06-10 16:16:44', 1),
(641, 'privilege_utilisateur', 'chaima', '2024-06-10 16:16:44', 1),
(642, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(643, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(644, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(645, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(646, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(647, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(648, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(649, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(650, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(651, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(652, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(653, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(654, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(655, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(656, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(657, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(658, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(659, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(660, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(661, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(662, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(663, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(664, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(665, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(666, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(667, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(668, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(669, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(670, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(671, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(672, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(673, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(674, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(675, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(676, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(677, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(678, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(679, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(680, 'privilege_utilisateur', 'chaima', '2024-06-10 16:37:32', 1),
(681, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(682, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(683, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(684, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(685, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(686, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(687, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(688, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(689, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(690, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(691, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(692, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(693, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(694, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(695, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(696, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(697, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(698, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(699, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(700, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(701, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(702, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(703, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(704, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(705, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(706, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(707, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(708, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(709, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(710, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(711, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(712, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(713, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(714, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(715, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(716, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(717, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(718, 'privilege_utilisateur', 'chaima', '2024-06-10 17:03:31', 1),
(719, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(720, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(721, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(722, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(723, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(724, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(725, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(726, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(727, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(728, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(729, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(730, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(731, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(732, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(733, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(734, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(735, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(736, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(737, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(738, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(739, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(740, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(741, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(742, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(743, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(744, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(745, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(746, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(747, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(748, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(749, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(750, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(751, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(752, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(753, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(754, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(755, 'privilege_utilisateur', 'chaima', '2024-06-10 17:24:00', 1),
(756, 'Depot', 'chaima', '2024-06-10 19:05:47', 1),
(757, 'Depot', 'chaima', '2024-06-10 19:06:02', 3),
(758, 'privilege_utilisateur', 'test', '2024-06-10 19:20:58', 1),
(759, 'privilege_utilisateur', 'test', '2024-06-10 19:26:58', 1),
(760, 'privilege_utilisateur', 'test', '2024-06-10 19:26:58', 1),
(761, 'privilege_utilisateur', 'test', '2024-06-10 19:32:37', 1),
(762, 'privilege_utilisateur', 'test', '2024-06-10 19:32:37', 1),
(763, 'privilege_utilisateur', 'test', '2024-06-10 19:32:37', 1),
(764, 'privilege_utilisateur', 'test', '2024-06-10 19:32:37', 1),
(765, 'privilege_utilisateur', 'test', '2024-06-10 19:32:37', 1),
(766, 'privilege_utilisateur', 'test', '2024-06-10 19:32:37', 1),
(767, 'privilege_utilisateur', 'test', '2024-06-10 19:32:37', 1),
(768, 'privilege_utilisateur', 'test', '2024-06-10 19:32:37', 1),
(769, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(770, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(771, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(772, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(773, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(774, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(775, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(776, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(777, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(778, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(779, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1);
INSERT INTO `historique_operation` (`id`, `entite`, `utilisateur`, `date`, `type_id`) VALUES
(780, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(781, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(782, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(783, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(784, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(785, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(786, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(787, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(788, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(789, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(790, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(791, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(792, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(793, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(794, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(795, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(796, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(797, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(798, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(799, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(800, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(801, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(802, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(803, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(804, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(805, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(806, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(807, 'privilege_utilisateur', 'test', '2024-06-11 16:51:24', 1),
(808, 'Article', 'test', '2024-06-11 16:53:11', 1),
(809, 'Article', 'test', '2024-06-11 16:53:27', 3),
(810, 'Article', 'test', '2024-06-11 16:57:10', 2),
(811, 'Article', 'test', '2024-06-11 17:00:35', 2),
(812, 'Bon commande', 'test', '2024-06-11 17:11:03', 1),
(813, 'Bon commande', 'test', '2024-06-11 17:11:14', 3),
(814, 'Bon commande', 'test', '2024-06-11 17:13:48', 2),
(815, 'Detail bon commande', 'test', '2024-06-11 17:17:19', 1),
(816, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(817, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(818, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(819, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(820, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(821, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(822, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(823, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(824, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(825, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(826, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(827, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(828, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(829, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(830, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(831, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(832, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(833, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(834, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(835, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(836, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(837, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(838, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(839, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(840, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(841, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(842, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(843, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(844, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(845, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(846, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(847, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(848, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(849, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(850, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(851, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(852, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(853, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(854, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(855, 'privilege_utilisateur', 'test', '2024-06-11 17:27:45', 1),
(856, 'bon sortie', 'test', '2024-06-11 17:27:56', 2),
(857, 'categorie', 'test', '2024-06-11 17:41:21', 1),
(858, 'categorie', 'test', '2024-06-11 17:41:38', 3),
(859, 'Depot', 'test', '2024-06-11 17:46:20', 1),
(860, 'Depot', 'test', '2024-06-11 17:46:31', 3),
(861, 'Depot', 'test', '2024-06-11 17:46:50', 2),
(862, 'Utilisateur', 'test', '2024-06-11 18:09:17', 1),
(863, 'Utilisateur', 'test', '2024-06-11 18:11:26', 1),
(864, 'categorie', 'chaima', '2024-06-11 20:34:25', 3),
(865, 'categorie', 'chaima', '2024-06-11 20:34:31', 3),
(866, 'categorie', 'chaima', '2024-06-11 20:34:40', 3),
(868, 'categorie', 'chaima', '2024-06-11 20:34:54', 3),
(869, 'Depot', 'chaima', '2024-06-11 20:35:06', 3),
(870, 'Depot', 'chaima', '2024-06-11 20:35:11', 3),
(874, 'Bon sortie', 'chaima', '2024-06-11 20:36:32', 3),
(875, 'Bon sortie', 'chaima', '2024-06-11 20:36:48', 3),
(876, 'Bon sortie', 'chaima', '2024-06-11 20:36:52', 3),
(877, 'Bon sortie', 'chaima', '2024-06-11 20:36:58', 3),
(878, 'Bon sortie', 'chaima', '2024-06-11 20:37:02', 3),
(879, 'Bon commande', 'chaima', '2024-06-11 20:37:13', 3),
(880, 'Bon commande', 'chaima', '2024-06-11 20:37:19', 3),
(881, 'Bon commande', 'chaima', '2024-06-11 20:38:33', 3),
(882, 'Bon commande', 'chaima', '2024-06-11 20:38:37', 3),
(883, 'Bon commande', 'chaima', '2024-06-11 20:38:42', 3),
(884, 'Bon commande', 'chaima', '2024-06-11 20:38:47', 3),
(885, 'Article', 'chaima', '2024-06-11 20:38:57', 3),
(886, 'Article', 'chaima', '2024-06-11 20:39:02', 3),
(887, 'Depot', 'chaima', '2024-06-11 20:39:44', 3),
(888, 'Fournisseur', 'chaima', '2024-06-11 20:40:12', 3),
(889, 'Fournisseur', 'chaima', '2024-06-11 20:40:18', 3),
(890, 'Fournisseur', 'chaima', '2024-06-11 20:40:24', 3),
(891, 'Utilisateur', 'chaima', '2024-06-11 20:41:19', 3),
(892, 'Utilisateur', 'chaima', '2024-06-11 20:41:33', 3),
(893, 'Utilisateur', 'chaima', '2024-06-11 20:41:43', 3),
(896, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(897, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(898, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(899, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(900, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(901, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(902, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(903, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(904, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(905, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(906, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(907, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(908, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(909, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(910, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(911, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(912, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(913, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(914, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(915, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(916, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(917, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(918, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(919, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(920, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(921, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(922, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(923, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(924, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(925, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(926, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(927, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(928, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(929, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(930, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(931, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(932, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(933, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(934, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(935, 'privilege_utilisateur', 'chaima', '2024-06-11 20:45:40', 1),
(936, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(937, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(938, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(939, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(940, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(941, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(942, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(943, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(944, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(945, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(946, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(947, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(948, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(949, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(950, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(951, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(952, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(953, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(954, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(955, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(956, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(957, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(958, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(959, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(960, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(961, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(962, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(963, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(964, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(965, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(966, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(967, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(968, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(969, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(970, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(971, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(972, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(973, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(974, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:00', 1),
(975, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(976, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(977, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(978, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(979, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(980, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(981, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(982, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(983, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(984, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(985, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(986, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(987, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(988, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(989, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(990, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(991, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(992, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(993, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(994, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(995, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(996, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(997, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(998, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(999, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1000, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1001, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1002, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1003, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1004, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1005, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1006, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1007, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1008, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1009, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1010, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1011, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1012, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1013, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1014, 'privilege_utilisateur', 'chaima', '2024-06-11 20:55:28', 1),
(1016, 'Utilisateur', 'chaima', '2024-06-11 21:33:55', 3),
(1017, 'categorie', 'chaima', '2024-06-11 21:46:32', 1),
(1018, 'categorie', 'chaima', '2024-06-11 21:46:42', 3),
(1019, 'categorie', 'chaima', '2024-06-12 19:55:05', 1),
(1020, 'categorie', 'chaima', '2024-06-12 19:55:24', 1),
(1021, 'categorie', 'chaima', '2024-06-12 19:56:01', 1),
(1022, 'categorie', 'chaima', '2024-06-12 19:56:12', 1),
(1023, 'Depot', 'chaima', '2024-06-12 19:57:42', 1),
(1024, 'Depot', 'chaima', '2024-06-12 19:58:17', 1),
(1025, 'Article', 'chaima', '2024-06-12 20:02:01', 1),
(1026, 'Article', 'chaima', '2024-06-12 20:04:15', 1),
(1027, 'Article', 'chaima', '2024-06-12 20:05:33', 1),
(1028, 'Article', 'chaima', '2024-06-12 20:07:52', 1),
(1029, 'Article', 'chaima', '2024-06-12 20:09:16', 1),
(1030, 'Article', 'chaima', '2024-06-12 20:11:36', 1),
(1031, 'Article', 'chaima', '2024-06-12 20:13:22', 1),
(1032, 'Article', 'chaima', '2024-06-12 20:15:09', 1),
(1033, 'Fournisseur', 'chaima', '2024-06-12 20:24:09', 1),
(1034, 'Fournisseur', 'chaima', '2024-06-12 20:24:45', 1),
(1035, 'Fournisseur', 'chaima', '2024-06-12 20:25:17', 1),
(1036, 'Fournisseur', 'chaima', '2024-06-12 20:25:47', 1),
(1037, 'Utilisateur', 'chaima', '2024-06-12 20:27:02', 1),
(1038, 'Utilisateur', 'chaima', '2024-06-12 20:27:28', 1),
(1039, 'privilege_utilisateur', 'chaima', '2024-06-22 12:25:04', 1),
(1040, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1041, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1042, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1043, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1044, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1045, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1046, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1047, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1048, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1049, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1050, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1051, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1052, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1053, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1054, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1055, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1056, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1057, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1058, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1059, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1060, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1061, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1062, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1063, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1064, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1065, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1066, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1067, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1068, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1069, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1070, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1071, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1072, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1073, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1074, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1075, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1076, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1077, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1078, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1079, 'privilege_utilisateur', 'chaima', '2024-06-23 13:56:36', 1),
(1080, 'Bon commande', 'chaima', '2024-06-23 16:03:24', 1),
(1081, 'Bon commande', 'chaima', '2024-06-23 16:03:44', 1),
(1082, 'Bon commande', 'chaima', '2024-06-23 16:04:01', 1),
(1083, 'Bon commande', 'chaima', '2024-06-23 16:04:19', 1),
(1084, 'Bon commande', 'chaima', '2024-06-23 16:05:06', 1),
(1085, 'Bon commande', 'chaima', '2024-06-23 16:05:35', 1),
(1086, 'Bon commande', 'chaima', '2024-06-23 16:06:01', 1),
(1087, 'Article', 'chaima', '2024-06-23 16:07:53', 1),
(1088, 'categorie', 'chaima', '2024-06-23 16:26:50', 1),
(1089, 'categorie', 'chaima', '2024-06-23 16:26:57', 3),
(1090, 'categorie', 'chaima', '2024-06-23 16:28:09', 1),
(1091, 'categorie', 'chaima', '2024-06-23 16:28:16', 3),
(1092, 'Bon sortie', 'chaima', '2024-06-23 17:15:30', 1),
(1093, 'Bon sortie', 'chaima', '2024-06-23 17:15:38', 1),
(1094, 'Bon sortie', 'chaima', '2024-06-23 17:15:53', 1),
(1095, 'Bon sortie', 'chaima', '2024-06-23 17:16:10', 1),
(1096, 'Detail bon sortie', 'chaima', '2024-06-23 17:24:15', 1),
(1097, 'Detail bon commande', 'chaima', '2024-06-23 17:37:23', 1),
(1098, 'Detail bon commande', 'chaima', '2024-06-23 17:37:37', 1),
(1099, 'Utilisateur', 'chaima', '2024-06-23 18:21:07', 1),
(1100, 'Utilisateur', 'chaima', '2024-06-23 19:11:13', 3),
(1101, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1102, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1103, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1104, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1105, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1106, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1107, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1108, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1109, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1110, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1111, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1112, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1113, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1114, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1115, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1116, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1117, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1118, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1119, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1120, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1121, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1122, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1123, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1124, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1125, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1126, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1127, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1128, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1129, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1130, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1131, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1132, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1133, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1134, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1135, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1136, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1137, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1138, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1139, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1140, 'privilege_utilisateur', 'chaima', '2024-06-23 19:25:22', 1),
(1141, 'categorie', 'chaima', '2024-06-28 10:47:43', 1),
(1142, 'categorie', 'chaima', '2024-06-28 10:47:54', 2),
(1143, 'categorie', 'chaima', '2024-06-28 10:48:21', 3),
(1144, 'Article', 'chaima', '2024-06-28 10:51:42', 2),
(1145, 'Article', 'chaima', '2024-06-28 10:51:50', 3),
(1146, 'Bon sortie', 'chaima', '2024-06-28 10:53:40', 1),
(1147, 'privilege_utilisateur', 'chaima', '2024-06-28 10:56:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mode_paiment`
--

CREATE TABLE `mode_paiment` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mode_paiment`
--

INSERT INTO `mode_paiment` (`id`, `libelle`) VALUES
(1, 'Virement Bank'),
(2, 'PAYPAL'),
(3, 'TPE'),
(4, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `oublier_pass`
--

CREATE TABLE `oublier_pass` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oublier_pass`
--

INSERT INTO `oublier_pass` (`id`, `utilisateur_id`, `code`, `status`) VALUES
(1, 17, '1451717529652', 0),
(2, 17, '9401717529665', 0),
(3, 17, '7171717529791', 0),
(4, 17, '1251717529845', 0),
(5, 17, '9251717529904', 0),
(6, 17, '1751717529932', 0),
(7, 17, '4891717530007', 0),
(8, 17, '101717530071', 1),
(9, 17, '5581717532685', 1),
(10, 17, '1991717599919', 1),
(11, 17, '8421719052195', 0),
(12, 17, '9831719053708', 0),
(13, 17, '5801719053727', 0),
(14, 17, '1181719053755', 0),
(15, 17, '2841719053841', 0),
(16, 17, '1141719053903', 0),
(17, 17, '5761719143551', 0),
(18, 17, '4801719143723', 1),
(19, 17, '7081719531718', 1),
(20, 17, '1991719565075', 0);

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `lib_priv` varchar(100) NOT NULL,
  `date_add` date NOT NULL,
  `titre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`id`, `lib_priv`, `date_add`, `titre`) VALUES
(10, 'article', '2024-06-05', 'Consulter les articles'),
(11, 'update_article', '2024-06-05', 'Modifier un article'),
(13, 'delete_article', '2024-06-05', 'Supprimer un article'),
(14, 'new_article', '2024-06-05', 'Ajouter un article'),
(15, 'facture_listC', '2024-06-05', 'Consulter la liste factures de bon de commande'),
(16, 'delete_detail_bonC', '2024-06-05', 'Supprimer un detail de bon de commande'),
(17, 'new_detail_bon_commande', '2024-06-05', 'Ajouter un detail de bon de commande'),
(18, 'details_bon_commande', '2024-06-05', 'Consulter un detail de bon de commande'),
(19, 'update_bon_commande', '2024-06-05', 'Modifier un bon de commande'),
(21, 'delete_bonC', '2024-06-05', 'Supprimer un bon de commande'),
(22, 'new_bon_commande', '2024-06-05', 'Ajouter un bon de commande'),
(23, 'boncommande', '2024-06-05', 'Consulter les bons de commande'),
(25, 'delete_bonS', '2024-06-05', 'Supprimer un bon de sortie'),
(26, 'delete_detail_bonS', '2024-06-05', 'Supprimer un detail de bon de sortie'),
(27, 'new_detail_bon_sortie', '2024-06-05', 'Ajouter un detail de bon de sortie'),
(28, 'new_bon_sortie', '2024-06-05', 'Ajouter un bon de sortie'),
(29, 'details_bon_sortie', '2024-06-05', 'Consulter les details de bon de sortie'),
(30, 'bonsortie', '2024-06-05', 'Consulter les bons de sortie'),
(31, 'update_categ', '2024-06-05', 'Modifier un categorie'),
(33, 'delete_category', '2024-06-05', 'Supprimer un categorie'),
(34, 'new_category', '2024-06-05', 'Ajouter un categorie'),
(35, 'category', '2024-06-05', 'Consulter les categories'),
(38, 'dashboard', '2024-06-05', 'Consulter le tableau de bord'),
(39, 'update_depot', '2024-06-05', 'Modifier un Depot'),
(41, 'delete_depot', '2024-06-05', 'Suprrimer un depot'),
(42, 'new_depot', '2024-06-05', 'Ajouter un depot'),
(43, 'depot', '2024-06-05', 'Consulter les depots'),
(44, 'factureById', '2024-06-05', 'Imprimer une facture'),
(45, 'facture', '2024-06-05', 'Consulter les facture'),
(47, 'update_fournisseur', '2024-06-05', 'Modifier un fournisseur'),
(48, 'delete_fournisseur', '2024-06-05', 'Supprimer un fourisseur'),
(49, 'new_fournisseur', '2024-06-05', 'Ajouter un fournisseur'),
(50, 'fournisseur', '2024-06-05', 'Consulter les fournisseurs'),
(52, 'update_password', '2024-06-05', 'Modifier un fournisseur'),
(61, 'delete_utilisateur', '2024-06-05', 'Supprimer un utilisateur'),
(62, 'update_utilisateur', '2024-06-05', 'Modifier un utilisateur'),
(64, 'new_utilisateur', '2024-06-05', 'Ajouter un utilisateur'),
(65, 'utilisateur', '2024-06-05', 'Consulter les utilisateurs'),
(66, 'facture_list', '2024-06-09', 'Consulter les factures de bon de sortie'),
(67, 'update_bon_sort', '2024-06-11', 'Modifier un bon de sortie');

-- --------------------------------------------------------

--
-- Table structure for table `privilege_utilisateur`
--

CREATE TABLE `privilege_utilisateur` (
  `id` int(11) NOT NULL,
  `id_priv_id` int(11) DEFAULT NULL,
  `id_utilisateur_id` int(11) DEFAULT NULL,
  `date_add` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privilege_utilisateur`
--

INSERT INTO `privilege_utilisateur` (`id`, `id_priv_id`, `id_utilisateur_id`, `date_add`) VALUES
(1016, 10, 17, '2024-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'caisser'),
(3, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `status_bc`
--

CREATE TABLE `status_bc` (
  `id` int(11) NOT NULL,
  `code_status` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_bc`
--

INSERT INTO `status_bc` (`id`, `code_status`, `libelle`) VALUES
(1, 1, 'En attente'),
(2, 2, 'Annule'),
(3, 3, 'valide');

-- --------------------------------------------------------

--
-- Table structure for table `type_operation`
--

CREATE TABLE `type_operation` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_operation`
--

INSERT INTO `type_operation` (`id`, `titre`) VALUES
(1, 'ajouter'),
(2, 'modifier'),
(3, 'supprimer');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `email`, `password`, `role_id`) VALUES
(17, 'chaima', 'cbouj31@gmail.com', '067d83504d3d911f840f4727caed0bf35736c4606a55090139c449ea3fe12550', 1),
(21, 'mohammed', 'cbouj6@gmail.com', 'c776af30588b78a14453dfefc29ee888a5ee9ab5350cd298758f3a5fa74361fc', 2),
(22, 'youssef', 'chaima.boujrar@edu.uiz.ac.ma', '89f8903bd9328d1e0cf4e7c64d24a0276131a958b95f604b1ab080239754aa6a', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_23A0E669F34925F` (`id_categorie_id`),
  ADD KEY `IDX_23A0E66D5CB384B` (`id_depot_id`);

--
-- Indexes for table `bon_commande`
--
ALTER TABLE `bon_commande`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_159D95767F2DEE08` (`facture_id`),
  ADD KEY `IDX_159D9576C7B27885` (`code_status_id`),
  ADD KEY `IDX_159D95765A6AC879` (`id_fournisseur_id`);

--
-- Indexes for table `bon_sortie`
--
ALTER TABLE `bon_sortie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2843ABC87F2DEE08` (`facture_id`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depot`
--
ALTER TABLE `depot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_bon_commande`
--
ALTER TABLE `detail_bon_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_99EFF797294869C` (`article_id`),
  ADD KEY `IDX_99EFF79B4B54061` (`bon_commande_id`);

--
-- Indexes for table `detail_bon_sortie`
--
ALTER TABLE `detail_bon_sortie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_93591B1E135FAC79` (`idbs_id`),
  ADD KEY `IDX_93591B1E7294869C` (`article_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FE866410BDA57703` (`mode_paiment_id`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historique_operation`
--
ALTER TABLE `historique_operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4AF2ED25C54C8C93` (`type_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `mode_paiment`
--
ALTER TABLE `mode_paiment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oublier_pass`
--
ALTER TABLE `oublier_pass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C4944A60FB88E14F` (`utilisateur_id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privilege_utilisateur`
--
ALTER TABLE `privilege_utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_212F90A4AA05FCB1` (`id_priv_id`),
  ADD KEY `IDX_212F90A4C6EE5C49` (`id_utilisateur_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_bc`
--
ALTER TABLE `status_bc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_operation`
--
ALTER TABLE `type_operation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1D1C63B3D60322AC` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `bon_commande`
--
ALTER TABLE `bon_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `bon_sortie`
--
ALTER TABLE `bon_sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `depot`
--
ALTER TABLE `depot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detail_bon_commande`
--
ALTER TABLE `detail_bon_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `detail_bon_sortie`
--
ALTER TABLE `detail_bon_sortie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `historique_operation`
--
ALTER TABLE `historique_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1148;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mode_paiment`
--
ALTER TABLE `mode_paiment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oublier_pass`
--
ALTER TABLE `oublier_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `privilege_utilisateur`
--
ALTER TABLE `privilege_utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1017;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status_bc`
--
ALTER TABLE `status_bc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_operation`
--
ALTER TABLE `type_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E669F34925F` FOREIGN KEY (`id_categorie_id`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `FK_23A0E66D5CB384B` FOREIGN KEY (`id_depot_id`) REFERENCES `depot` (`id`);

--
-- Constraints for table `bon_commande`
--
ALTER TABLE `bon_commande`
  ADD CONSTRAINT `FK_159D95765A6AC879` FOREIGN KEY (`id_fournisseur_id`) REFERENCES `fournisseur` (`id`),
  ADD CONSTRAINT `FK_159D95767F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`),
  ADD CONSTRAINT `FK_159D9576C7B27885` FOREIGN KEY (`code_status_id`) REFERENCES `status_bc` (`id`);

--
-- Constraints for table `bon_sortie`
--
ALTER TABLE `bon_sortie`
  ADD CONSTRAINT `FK_2843ABC87F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`);

--
-- Constraints for table `detail_bon_commande`
--
ALTER TABLE `detail_bon_commande`
  ADD CONSTRAINT `FK_99EFF797294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_99EFF79B4B54061` FOREIGN KEY (`bon_commande_id`) REFERENCES `bon_commande` (`id`);

--
-- Constraints for table `detail_bon_sortie`
--
ALTER TABLE `detail_bon_sortie`
  ADD CONSTRAINT `FK_93591B1E135FAC79` FOREIGN KEY (`idbs_id`) REFERENCES `bon_sortie` (`id`),
  ADD CONSTRAINT `FK_93591B1E7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

--
-- Constraints for table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_FE866410BDA57703` FOREIGN KEY (`mode_paiment_id`) REFERENCES `mode_paiment` (`id`);

--
-- Constraints for table `historique_operation`
--
ALTER TABLE `historique_operation`
  ADD CONSTRAINT `FK_4AF2ED25C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_operation` (`id`);

--
-- Constraints for table `oublier_pass`
--
ALTER TABLE `oublier_pass`
  ADD CONSTRAINT `FK_C4944A60FB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `privilege_utilisateur`
--
ALTER TABLE `privilege_utilisateur`
  ADD CONSTRAINT `FK_212F90A4AA05FCB1` FOREIGN KEY (`id_priv_id`) REFERENCES `privilege` (`id`),
  ADD CONSTRAINT `FK_212F90A4C6EE5C49` FOREIGN KEY (`id_utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_1D1C63B3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
