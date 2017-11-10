-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 14 Décembre 2016 à 13:57
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bibliotheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `IDobjet` int(11) NOT NULL,
  `IDcategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `appartient`
--

INSERT INTO `appartient` (`IDobjet`, `IDcategorie`) VALUES
(1, 1),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

CREATE TABLE `auteur` (
  `IDauteur` int(11) NOT NULL,
  `Nom` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `auteur`
--

INSERT INTO `auteur` (`IDauteur`, `Nom`) VALUES
(1, 'Tolkien'),
(2, 'Ian Kershow'),
(3, 'François Branger');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `IDcategorie` int(11) NOT NULL,
  `Libelle` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`IDcategorie`, `Libelle`) VALUES
(1, 'Fantastique'),
(2, 'ScienceFiction'),
(3, 'Historique');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `IDobjet` int(11) NOT NULL,
  `IDutilisateur` int(11) NOT NULL,
  `Commentaire` varchar(500) COLLATE utf8_bin NOT NULL DEFAULT 'Pas de commentaire',
  `etoiles` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`IDobjet`, `IDutilisateur`, `Commentaire`, `etoiles`) VALUES
(1, 1, 'cool', 4);

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE `objet` (
  `IDobjet` int(11) NOT NULL,
  `ISBN` varchar(50) COLLATE utf8_bin NOT NULL,
  `Titre` varchar(100) COLLATE utf8_bin NOT NULL,
  `IDauteur` int(11) NOT NULL,
  `image` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `Resume` longtext COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `objet`
--

INSERT INTO `objet` (`IDobjet`, `ISBN`, `Titre`, `IDauteur`, `image`, `Resume`) VALUES
(1, '9782266154116', 'Le Seigneur des Anneaux', 1, NULL, 'blibli'),
(2, '9782021243642', 'Europe en Enfer', 2, NULL, 'bleble'),
(3, '9782266258692', 'Dominium Mundi', 3, NULL, 'blabla');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `IDobjet` int(11) NOT NULL,
  `IDutilisateur` int(11) NOT NULL,
  `Datedébut` date NOT NULL,
  `Datefin` date NOT NULL,
  `Emprunté` tinyint(1) NOT NULL DEFAULT '0',
  `Rendu` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`IDobjet`, `IDutilisateur`, `Datedébut`, `Datefin`, `Emprunté`, `Rendu`) VALUES
(1, 2, '2016-12-08', '2016-12-09', 1, 0),
(2, 1, '2016-12-09', '2016-12-10', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `IDutilisateur` int(11) NOT NULL,
  `MDP` varchar(50) COLLATE utf8_bin NOT NULL,
  `Mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `Nom` varchar(100) COLLATE utf8_bin NOT NULL,
  `Prenom` varchar(100) COLLATE utf8_bin NOT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(150) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IDutilisateur`, `MDP`, `Mail`, `Nom`, `Prenom`, `Admin`, `image`) VALUES
(1, 'az', '@epsi.fr', 'toto', 'fred', 0, ''),
(2, 'er', '@idrac.fr', 'titi', 'hugo', 0, '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`IDobjet`,`IDcategorie`),
  ADD KEY `IDcategorie` (`IDcategorie`);

--
-- Index pour la table `auteur`
--
ALTER TABLE `auteur`
  ADD PRIMARY KEY (`IDauteur`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`IDcategorie`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`IDobjet`,`IDutilisateur`),
  ADD KEY `IDutilisateur` (`IDutilisateur`);

--
-- Index pour la table `objet`
--
ALTER TABLE `objet`
  ADD PRIMARY KEY (`IDobjet`),
  ADD KEY `IDauteur` (`IDauteur`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`IDobjet`,`IDutilisateur`),
  ADD KEY `IDutilisateur` (`IDutilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`IDutilisateur`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `appartient_ibfk_1` FOREIGN KEY (`IDobjet`) REFERENCES `objet` (`IDobjet`),
  ADD CONSTRAINT `appartient_ibfk_2` FOREIGN KEY (`IDcategorie`) REFERENCES `categories` (`IDcategorie`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`IDobjet`) REFERENCES `objet` (`IDobjet`),
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateur` (`IDutilisateur`);

--
-- Contraintes pour la table `objet`
--
ALTER TABLE `objet`
  ADD CONSTRAINT `objet_ibfk_1` FOREIGN KEY (`IDauteur`) REFERENCES `auteur` (`IDauteur`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`IDobjet`) REFERENCES `objet` (`IDobjet`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`IDutilisateur`) REFERENCES `utilisateur` (`IDutilisateur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
