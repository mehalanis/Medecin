-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 27 déc. 2019 à 22:30
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `medecin`
--

-- --------------------------------------------------------

--
-- Structure de la table `malade`
--

CREATE TABLE `malade` (
  `id_malade` int(11) NOT NULL,
  `matricule` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `malade`
--

INSERT INTO `malade` (`id_malade`, `matricule`, `nom`, `prenom`, `date_naissance`) VALUES
(3, 'SP40', 'anis', 'mehal', '1999-05-29');

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE `medicament` (
  `id_medicament` int(11) NOT NULL,
  `nom_medicament` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`id_medicament`, `nom_medicament`) VALUES
(1, 'humex'),
(2, 'panadole');

-- --------------------------------------------------------

--
-- Structure de la table `ordonnance`
--

CREATE TABLE `ordonnance` (
  `id_ordonnance` int(11) NOT NULL,
  `id_malade` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `motif` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ordonnance`
--

INSERT INTO `ordonnance` (`id_ordonnance`, `id_malade`, `id_user`, `motif`, `date`) VALUES
(14, 3, 1, 'kjhg', '2019-03-26 09:55:57'),
(15, 3, 1, 'kjhg', '2019-03-26 09:55:57'),
(16, 3, 1, 'kjhg', '2019-03-27 09:33:04'),
(17, 3, 1, 'kjhg', '2019-03-27 09:33:45'),
(18, 3, 1, 'kjhg', '2019-03-27 09:33:49'),
(19, 3, 1, 'mjopgsq', '2019-03-27 09:35:39'),
(20, 3, 1, 'mjopgsq', '2019-03-27 09:35:41');

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`id_region`, `code`, `nom`) VALUES
(1, 1, 'Adrar'),
(2, 2, 'Chlef'),
(3, 3, 'Laghouat'),
(4, 4, 'Oum El Bouaghi'),
(5, 5, 'Batna'),
(6, 6, 'Bejaia'),
(7, 7, 'Biskra'),
(8, 8, 'Bechar'),
(9, 9, 'Blida'),
(10, 10, 'Bouira'),
(11, 11, 'Tamanrasset'),
(12, 12, 'Tebessa'),
(13, 13, 'Tlemcen'),
(14, 14, 'Tiaret'),
(15, 15, 'Tizi Ouzou'),
(16, 16, 'Alger'),
(17, 17, 'Djelfa'),
(18, 18, 'Jijel'),
(19, 19, 'Setif'),
(20, 20, 'Saida'),
(21, 21, 'Skikda'),
(22, 22, 'Sidi Bel Abbes'),
(23, 23, 'Annaba'),
(24, 24, 'Guelma'),
(25, 25, 'Constantine'),
(26, 26, 'Medea'),
(27, 27, 'Mostaganem'),
(28, 28, 'M\'Sila'),
(29, 29, 'Mascara'),
(30, 30, 'Ouargla'),
(31, 31, 'Oran'),
(32, 32, 'El Bayadh'),
(33, 33, 'Illizi'),
(34, 34, 'Bordj Bou Arreridj'),
(35, 35, 'Boumerdes'),
(36, 36, 'El Tarf'),
(37, 37, 'Tindouf'),
(38, 38, 'Tissemsilt'),
(39, 39, 'El Oued'),
(40, 40, 'Khenchela'),
(41, 41, 'Souk Ahras'),
(42, 42, 'Tipaza'),
(43, 43, 'Mila'),
(44, 44, 'Ain Defla'),
(45, 45, 'Naama'),
(46, 46, 'Ain Temouchent'),
(47, 47, 'Ghardaia'),
(48, 48, 'Relizane');

-- --------------------------------------------------------

--
-- Structure de la table `traitement`
--

CREATE TABLE `traitement` (
  `id_ordonnance` int(11) DEFAULT NULL,
  `id_medicament` int(11) DEFAULT NULL,
  `doz` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbrboit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `traitement`
--

INSERT INTO `traitement` (`id_ordonnance`, `id_medicament`, `doz`, `nbrboit`) VALUES
(14, 1, '2/jour', 3),
(15, 1, '2/jour', 3),
(17, 1, '2/jour', 1),
(18, 1, '2/jour', 1),
(19, 1, '1/jour', 1),
(20, 1, '1/jour', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_region` int(11) DEFAULT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `email`, `id_region`, `username`, `password`) VALUES
(1, 'Mehal', 'Hamida', 'test@gmail.com', 9, 'hamida', 'f048b5bfd252c5dd1e2dff9139644a23'),
(3, 'anis', 'mehal', 'anis@gmail.com', 31, 'anismehal', '38a1ffb5ccad9612d3d28d99488ca94b');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `malade`
--
ALTER TABLE `malade`
  ADD PRIMARY KEY (`id_malade`);

--
-- Index pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`id_medicament`);

--
-- Index pour la table `ordonnance`
--
ALTER TABLE `ordonnance`
  ADD PRIMARY KEY (`id_ordonnance`),
  ADD KEY `id_malade` (`id_malade`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Index pour la table `traitement`
--
ALTER TABLE `traitement`
  ADD KEY `id_ordonnance` (`id_ordonnance`),
  ADD KEY `id_medicament` (`id_medicament`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_region` (`id_region`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `malade`
--
ALTER TABLE `malade`
  MODIFY `id_malade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `medicament`
--
ALTER TABLE `medicament`
  MODIFY `id_medicament` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ordonnance`
--
ALTER TABLE `ordonnance`
  MODIFY `id_ordonnance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ordonnance`
--
ALTER TABLE `ordonnance`
  ADD CONSTRAINT `ordonnance_ibfk_1` FOREIGN KEY (`id_malade`) REFERENCES `malade` (`id_malade`) ON DELETE CASCADE,
  ADD CONSTRAINT `ordonnance_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `traitement`
--
ALTER TABLE `traitement`
  ADD CONSTRAINT `traitement_ibfk_1` FOREIGN KEY (`id_ordonnance`) REFERENCES `ordonnance` (`id_ordonnance`) ON DELETE CASCADE,
  ADD CONSTRAINT `traitement_ibfk_2` FOREIGN KEY (`id_medicament`) REFERENCES `medicament` (`id_medicament`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `region` (`id_region`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
