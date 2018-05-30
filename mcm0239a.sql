-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2018 at 01:21 PM
-- Server version: 5.5.60-0+deb8u1
-- PHP Version: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mcm0239a`
--

-- --------------------------------------------------------

--
-- Table structure for table `CONSULTATIONS`
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
-- Table structure for table `MEDECINS`
--

CREATE TABLE IF NOT EXISTS `MEDECINS` (
`id_medecin` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `civilite` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `USAGERS`
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
  `numero_ss` bigint(20) NOT NULL,
  `id_medecin` int(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `USAGERS`
--

INSERT INTO `USAGERS` (`id_usager`, `civilite`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `date_naissance`, `numero_ss`, `id_medecin`) VALUES
(1, 'Mme', 'STARK', 'Math', '4, rue Roqualeine', '31000', 'Toulouse', '2018-01-22', 2147483647, NULL),
(2, 'mme', 'Michau', 'Math', '2, rue Roquelaine', '31000', 'Toulouse', '2017-09-26', 2147483647, NULL),
(3, 'mme', 'Michau', 'Mathilde', '2, rue Roquelaine', '31000', 'Toulouse', '2018-05-09', 2920409160026, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CONSULTATIONS`
--
ALTER TABLE `CONSULTATIONS`
 ADD PRIMARY KEY (`id_usager`,`id_medecin`,`date`,`heure_debut`), ADD KEY `id_medecin` (`id_medecin`,`id_usager`), ADD KEY `id_usager` (`id_usager`);

--
-- Indexes for table `MEDECINS`
--
ALTER TABLE `MEDECINS`
 ADD PRIMARY KEY (`id_medecin`), ADD KEY `id_medecin` (`id_medecin`);

--
-- Indexes for table `USAGERS`
--
ALTER TABLE `USAGERS`
 ADD PRIMARY KEY (`id_usager`), ADD KEY `id_medecin` (`id_medecin`), ADD KEY `id_medecin_2` (`id_medecin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `MEDECINS`
--
ALTER TABLE `MEDECINS`
MODIFY `id_medecin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `USAGERS`
--
ALTER TABLE `USAGERS`
MODIFY `id_usager` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `CONSULTATIONS`
--
ALTER TABLE `CONSULTATIONS`
ADD CONSTRAINT `FK_IDUSAGER_USAGERS` FOREIGN KEY (`id_usager`) REFERENCES `USAGERS` (`id_usager`);

--
-- Constraints for table `USAGERS`
--
ALTER TABLE `USAGERS`
ADD CONSTRAINT `FK_IDMEDECIN_MEDECIN` FOREIGN KEY (`id_medecin`) REFERENCES `MEDECINS` (`id_medecin`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
