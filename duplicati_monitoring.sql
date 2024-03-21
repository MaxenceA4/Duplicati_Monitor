-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 21 mars 2024 à 08:43
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `duplicati_monitoring`
--

-- --------------------------------------------------------

--
-- Structure de la table `backup_reports`
--

CREATE TABLE `backup_reports` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `operation` varchar(255) DEFAULT NULL,
  `extraResult` varchar(255) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `nameOfComputer` varchar(255) DEFAULT NULL,
  `deletedFiles` int(11) DEFAULT NULL,
  `deletedFolders` int(11) DEFAULT NULL,
  `modifiedFiles` int(11) DEFAULT NULL,
  `examinedFiles` int(11) DEFAULT NULL,
  `openedFiles` int(11) DEFAULT NULL,
  `addedFiles` int(11) DEFAULT NULL,
  `sizeOfModifiedFiles` bigint(20) DEFAULT NULL,
  `sizeOfAddedFiles` bigint(20) DEFAULT NULL,
  `sizeOfExaminedFiles` bigint(20) DEFAULT NULL,
  `sizeOfOpenedFiles` bigint(20) DEFAULT NULL,
  `notProcessedFiles` int(11) DEFAULT NULL,
  `addedFolders` int(11) DEFAULT NULL,
  `tooLargeFiles` int(11) DEFAULT NULL,
  `filesWithError` int(11) DEFAULT NULL,
  `modifiedFolders` int(11) DEFAULT NULL,
  `modifiedSymlinks` int(11) DEFAULT NULL,
  `addedSymlinks` int(11) DEFAULT NULL,
  `deletedSymlinks` int(11) DEFAULT NULL,
  `partialBackup` tinyint(1) DEFAULT NULL,
  `dryrun` tinyint(1) DEFAULT NULL,
  `mainOperation` varchar(255) DEFAULT NULL,
  `compactResults` varchar(255) DEFAULT NULL,
  `parsedResult` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `beginTime` datetime DEFAULT NULL,
  `messages` int(11) DEFAULT NULL,
  `warnings` int(11) DEFAULT NULL,
  `errors` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `backup_reports`
--

INSERT INTO `backup_reports` (`id`, `date`, `operation`, `extraResult`, `duration`, `nameOfComputer`, `deletedFiles`, `deletedFolders`, `modifiedFiles`, `examinedFiles`, `openedFiles`, `addedFiles`, `sizeOfModifiedFiles`, `sizeOfAddedFiles`, `sizeOfExaminedFiles`, `sizeOfOpenedFiles`, `notProcessedFiles`, `addedFolders`, `tooLargeFiles`, `filesWithError`, `modifiedFolders`, `modifiedSymlinks`, `addedSymlinks`, `deletedSymlinks`, `partialBackup`, `dryrun`, `mainOperation`, `compactResults`, `parsedResult`, `version`, `endTime`, `beginTime`, `messages`, `warnings`, `errors`) VALUES
(1, '2024-03-15 10:25:28', 'Backup', 'Success', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2024-03-15 10:27:08', 'Backup', 'Success', '00:00:07', '0', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2024-03-15 10:29:21', 'Backup', 'Success', '00:00:07', '0', 0, 0, 0, 3388, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2024-03-15 13:12:42', 'Backup', 'Success', '00:00:07', '0', 0, 0, 0, 3388, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2024-03-15 13:14:38', 'Backup', 'Success', '00:00:06', 'Bureau-albanese', 0, 0, 0, 3388, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2024-03-15 14:48:56', 'Backup', 'Success', '00:00:03', 'Bureau-albanese', 0, 0, 0, 3388, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2024-03-18 07:45:14', 'Backup', 'Success', '00:00:10', 'Bureau-albanese', 0, 0, 0, 3388, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2024-03-18 09:45:05', 'Backup', 'Success', '00:00:09', 'Bureau-albanese', 0, 0, 0, 3388, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer977', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer670', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer417', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer76', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer128', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer413', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer679', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer156', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer742', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '2024-03-18 14:13:00', NULL, NULL, NULL, 'Computer240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, '2024-03-21 07:10:34', 'Backup', 'Success', '00:00:08', 'Bureau-albanese', 0, 0, 0, 3388, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, '2024-03-21 07:15:54', 'Backup', 'Success', '00:00:06', 'Bureau-albanese', 0, 0, 0, 3388, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `backup_reports`
--
ALTER TABLE `backup_reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `backup_reports`
--
ALTER TABLE `backup_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
