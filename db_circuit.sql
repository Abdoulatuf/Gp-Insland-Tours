-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 sep. 2024 à 14:22
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_circuit`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualites`
--

CREATE TABLE `actualites` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_publication` datetime DEFAULT current_timestamp(),
  `auteur` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `actualites`
--

INSERT INTO `actualites` (`id`, `titre`, `contenu`, `date_publication`, `auteur`, `image`) VALUES
(1, 'Hôtel Galawa', 'Le mythique hôtel Galawa, qui a placé les Comores sur la carte touristique, sur le point de renaître.\r\nDétruit en 2007, cet établissement cinq-étoiles où a frayé le mercenaire français Bob Denard était étroitement lié au régime d’apartheid en Afrique du Sud. Aujourd’hui, un groupe égyptien le reconstruit afin de relancer le tourisme local.', '2024-09-18 00:00:00', 'comores-info', 'uploads/images.jpeg'),
(2, 'Route du Karthala', 'La route reliant Nvouni au Karthala est en cours de construction et devrait considérablement améliorer l\'accès à cette région, augmentant ainsi le nombre de visiteurs. Cependant, une alerte jaune a été émise à la suite d\'une éruption volcanique en janvier 2022, ce qui souligne la nécessité d\'être prudent lors de la fréquentation de la zone. Récemment, un accident a eu lieu sur cette route, entraînant plusieurs blessés, dont deux en soins intensifs.', '2024-09-17 00:00:00', 'Comore info', 'uploads/karthala.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

CREATE TABLE `circuit` (
  `id` int(250) NOT NULL,
  `nom_circuit` varchar(255) NOT NULL,
  `page` varchar(50) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`id`, `nom_circuit`, `page`, `lieu`, `date`, `image`, `description`) VALUES
(1, 'Plages de moya', 'plage', 'anjouan', '2024-09-08', 'moya.jpg', 'aaaaaaaaaa'),
(2, 'Poterie de Moheli', 'art_culture', 'Moheli', '2024-09-16', 'poterie.jpeg', 'Voici a quoi ressemble un poterie a Moheli Comore'),
(3, 'Plages de Nioumachiwa', 'plage', 'Moheli', '2024-09-17', 'nioumachiwa.jpeg', 'c est une plage de moheli'),
(5, 'Plages de Chidini', 'plage', 'Grande-Comore', '2024-09-17', 'chidini.jpeg', 'hhhhhhhhhhhhhhhhhh'),
(6, 'Montage de karthala', 'montagne', 'Grande-Comore', '2024-09-17', 'mont_karthala.jpeg', 'Montagne'),
(7, 'SNDRS', 'patrimoine', 'Grande-Comore', '2024-09-17', 'PatrimoinrGC.jpeg', 'Lieu de stockage de plusieurs culture et histoire des comores'),
(8, 'Lac de hantsogoma', 'randonnee', 'Grande-Comore', '2024-09-17', 'lac_hantsogoma.jpeg', 'Le lac Hantsongoma est un petit lac de cratère permanent situé  au pied nord du volcan Karthala, dans la région d\'Itsandra.'),
(9, 'Lac Dziani Boudouni', 'randonnee', 'Moheli', '2024-09-17', 'lac_dziani_boundouni.jpeg', 'Le lac Dziani Boundouni est un lac volcanique situé dans la partie sud-est de l\'île de Mohéli'),
(10, 'Lac Dziani Boudouni', 'randonnee', 'Moheli', '2024-09-17', 'lac_dziani_boundouni.jpeg', 'Le lac Dziani Boundouni est un lac volcanique situé dans la partie sud-est de l\'île de Mohéli');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Mohamed', 'abdoulatufmhamed@gmail.com', 'Reservation', 'J\'ai un probleme de reservation', '2024-09-17 02:41:51'),
(2, 'hghfghfg', 'vbhcbcb@gm.com', 'fgdfgdf', 'fgdfgdf', '2024-09-17 09:01:40'),
(3, 'dddd', 'ddddddd@gmail.com', 'ddddddd', 'sssssssss', '2024-09-17 09:13:24'),
(4, 'ssssssss', 'sssssss@gmail.com', 'ssssssss', 'dffffffssfffff', '2024-09-17 09:43:07'),
(5, 'ssssss', 'ffffffffffff@gmail.com', 'ssssssssss', 'ssssssssss', '2024-09-17 09:45:37');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(100) NOT NULL,
  `nom_circuit` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `nom_circuit`, `nom`, `mobile`, `date`, `lieu`, `created_at`) VALUES
(1, 'Plage de moya', 'Abdou', '3800643', '2024-09-09', 'anjouan', '2024-09-09 18:05:54'),
(2, 'Plages Nioumachiwa', 'Abdoulatuf', '3772424', '2024-09-20', 'Moheli', '2024-09-20 08:02:21');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` int(11) NOT NULL COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `nom` varchar(150) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` int(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `mobile`, `password`, `roleid`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Abdoulatuf', 'Mohamed', 'abdou@gmail.com', 3772424, '8c0e7aac121539e04764e39ff381d70c23057d16', 1, 0, '2024-08-21 08:05:41', '2024-08-21 08:05:41'),
(8, 'Abdou', 'Ahmed', 'meda@gmail.com', 3800643, 'dad618ec94c5fca5ad808ecd46f5b3bdd261f88c', 2, 0, '2024-09-07 18:47:07', '2024-09-07 18:47:07'),
(9, 'Amatoulatuf', 'Mohamed', 'amatou@gmail.com', 3381900, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, 0, '2024-09-13 03:38:34', '2024-09-13 03:38:34');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actualites`
--
ALTER TABLE `actualites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `circuit`
--
ALTER TABLE `circuit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actualites`
--
ALTER TABLE `actualites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `circuit`
--
ALTER TABLE `circuit`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id';

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
