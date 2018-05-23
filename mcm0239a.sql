-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 23 Mai 2018 à 11:22
-- Version du serveur :  5.5.60-0+deb8u1
-- Version de PHP :  5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mcm0239a`
--

-- --------------------------------------------------------

--
-- Structure de la table `CONSULTATIONS`
--

CREATE TABLE IF NOT EXISTS `CONSULTATIONS` (
  `date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `id_medecin` int(11) NOT NULL,
  `id_usager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `MEDECINS`
--

CREATE TABLE IF NOT EXISTS `MEDECINS` (
`id_medecin` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `USAGERS`
--

CREATE TABLE IF NOT EXISTS `USAGERS` (
`id_usager` int(11) NOT NULL,
  `civilite` varchar(3) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `date_naissance` date NOT NULL,
  `numero_ss` int(11) NOT NULL,
  `id_medecin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `CONSULTATIONS`
--
ALTER TABLE `CONSULTATIONS`
 ADD PRIMARY KEY (`id_usager`,`id_medecin`,`date`,`heure_debut`), ADD KEY `id_medecin` (`id_medecin`,`id_usager`), ADD KEY `id_usager` (`id_usager`);

--
-- Index pour la table `MEDECINS`
--
ALTER TABLE `MEDECINS`
 ADD PRIMARY KEY (`id_medecin`), ADD KEY `id_medecin` (`id_medecin`);

--
-- Index pour la table `USAGERS`
--
ALTER TABLE `USAGERS`
 ADD PRIMARY KEY (`id_usager`), ADD KEY `id_medecin` (`id_medecin`), ADD KEY `id_medecin_2` (`id_medecin`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `MEDECINS`
--
ALTER TABLE `MEDECINS`
MODIFY `id_medecin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `USAGERS`
--
ALTER TABLE `USAGERS`
MODIFY `id_usager` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `CONSULTATIONS`
--
ALTER TABLE `CONSULTATIONS`
ADD CONSTRAINT `FK_IDUSAGER_USAGERS` FOREIGN KEY (`id_usager`) REFERENCES `USAGERS` (`id_usager`);

--
-- Contraintes pour la table `USAGERS`
--
ALTER TABLE `USAGERS`
ADD CONSTRAINT `FK_IDMEDECIN_MEDECIN` FOREIGN KEY (`id_medecin`) REFERENCES `MEDECINS` (`id_medecin`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
