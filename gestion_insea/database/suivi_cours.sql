-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 23 juin 2018 à 23:08
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `suivi_cours`
--

-- --------------------------------------------------------

--
-- Structure de la table `annee_scolaire`
--

DROP TABLE IF EXISTS `annee_scolaire`;
CREATE TABLE IF NOT EXISTS `annee_scolaire` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `annee_scolaire` text,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id_dep` int(11) NOT NULL AUTO_INCREMENT,
  `code_dep` text,
  `label_dep` text,
  `chef_dep` text,
  PRIMARY KEY (`id_dep`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `element`
--

DROP TABLE IF EXISTS `element`;
CREATE TABLE IF NOT EXISTS `element` (
  `id_elt` int(11) NOT NULL AUTO_INCREMENT,
  `code_elt` text,
  `label_elt` text,
  `vh` int(11) NOT NULL,
  `ponderation` float NOT NULL,
  PRIMARY KEY (`id_elt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `emploi_temps`
--

DROP TABLE IF EXISTS `emploi_temps`;
CREATE TABLE IF NOT EXISTS `emploi_temps` (
  `id_emploi_temps` int(11) NOT NULL AUTO_INCREMENT,
  `annee_scolaire` int(11) NOT NULL,
  `filiere` text NOT NULL,
  `semestre` text,
  `niveau` text,
  `periode` text,
  `jour` date NOT NULL,
  `heure_deb` int(11) NOT NULL,
  `heure_fin` int(11) NOT NULL,
  `element` text,
  `salle` text,
  `professeur` int(11) DEFAULT NULL,
  `groupe` text,
  `etat_seance` text,
  PRIMARY KEY (`id_emploi_temps`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emploi_temps`
--

INSERT INTO `emploi_temps` (`id_emploi_temps`, `annee_scolaire`, `filiere`, `semestre`, `niveau`, `periode`, `jour`, `heure_deb`, `heure_fin`, `element`, `salle`, `professeur`, `groupe`, `etat_seance`) VALUES
(13, 2018, 'info', 's4', 'a2', 't1', '2018-06-01', 8, 10, 'TCP/IP', 'E1', 3, 'g1', 'confirme'),
(8, 2018, 'info', 's4', 'a2', 't1', '2018-06-01', 10, 12, 'MD', 'E2', 1, 'g1', 'confirme'),
(9, 2018, 'info', 's4', 'a2', 't2', '2018-06-04', 8, 10, 'MD', 'E2', 1, 'g1', 'reporte'),
(16, 2018, 'info', 's3', 'a1', 't1', '2018-06-22', 8, 10, 'TCP/IP', 'E1', 3, 'g1', 'annule'),
(14, 2018, 'info', 's3', 'a2', 't1', '2018-06-08', 8, 10, 'TCP/IP', 'E1', 3, 'g1', 'prevu'),
(15, 2018, 'info', 's3', 'a2', 't1', '2018-06-15', 8, 10, 'TCP/IP', 'E1', 3, 'g1', 'prevu'),
(17, 2018, 'info', 's3', 'a2', 't1', '2018-06-29', 8, 10, 'TCP/IP', 'E1', 3, 'g1', 'prevu'),
(18, 2018, 'info', 's3', 'a2', 't1', '2018-07-06', 8, 10, 'TCP/IP', 'E1', 3, 'g1', 'prevu'),
(19, 2018, 'info', 's3', 'a2', 't1', '2018-07-13', 8, 10, 'TCP/IP', 'E1', 3, 'g1', 'prevu'),
(20, 2018, 'info', 's1', 'a1', 't1', '2018-06-02', 16, 18, 'TCP/IP', 'E1', 3, 'g1', 'prevu'),
(21, 2018, 'road', 's2', 'a1', 't1', '2018-06-04', 8, 10, 'Structures de donnees', 'A3', 6, 'g1', 'prevu'),
(22, 2018, 'info', 's2', 'a1', 't1', '2018-06-06', 8, 10, 'TP Oracle', 'E1', 7, 'g3', 'prevu'),
(23, 2018, 'info', 's5', 'a3', 't1', '2018-06-04', 8, 10, 'MACHINE LEARNING', 'E1', 3, 'g1', 'confirme'),
(24, 2018, 'info', 's1', 'a1', 't1', '2018-06-05', 10, 12, 'GL', 'E1', 4, 'g1', 'prevu'),
(25, 2018, 'info', 's1', 'a1', 't1', '2018-06-12', 10, 12, 'GL', 'E1', 4, 'g1', 'prevu'),
(26, 2018, 'info', 's1', 'a1', 't1', '2018-06-19', 10, 12, 'GL', 'E1', 4, 'g1', 'prevu'),
(27, 2018, 'info', 's1', 'a1', 't1', '2018-06-26', 10, 12, 'GL', 'E1', 4, 'g1', 'prevu'),
(28, 2018, 'info', 's1', 'a1', 't1', '2018-07-03', 10, 12, 'GL', 'E1', 4, 'g1', 'prevu'),
(29, 2018, 'info', 's1', 'a1', 't1', '2018-07-10', 10, 12, 'GL', 'E1', 4, 'g1', 'prevu'),
(30, 2018, 'info', 's1', 'a1', 't1', '2018-07-17', 10, 12, 'GL', 'E1', 4, 'g1', 'prevu');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etud` int(11) NOT NULL AUTO_INCREMENT,
  `id_util` int(11) NOT NULL,
  `nom_etud` text,
  `prenom_etud` text,
  `annee_entree` int(11) NOT NULL,
  `filiere_etud` text,
  `niveau_etud` text,
  `statut_etud` text,
  `sexe_etud` text,
  `observation` text,
  `tel_etud` text,
  `email_etud` text,
  `groupe_etud` text,
  PRIMARY KEY (`id_etud`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etud`, `id_util`, `nom_etud`, `prenom_etud`, `annee_entree`, `filiere_etud`, `niveau_etud`, `statut_etud`, `sexe_etud`, `observation`, `tel_etud`, `email_etud`, `groupe_etud`) VALUES
(1, 2, 'Doe', 'John', 2018, 'info', 'a2', 'ad', 'f', '', '05 555 555 555', 'johndoe@gmail.com', 'g1');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `id_filiere` int(11) NOT NULL AUTO_INCREMENT,
  `code_filiere` text,
  `label_filiere` text,
  `coordinateur` text,
  PRIMARY KEY (`id_filiere`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `jours_ferier`
--

DROP TABLE IF EXISTS `jours_ferier`;
CREATE TABLE IF NOT EXISTS `jours_ferier` (
  `id_jours_ferier` int(11) NOT NULL AUTO_INCREMENT,
  `jour` date NOT NULL,
  PRIMARY KEY (`id_jours_ferier`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `jours_ferier`
--

INSERT INTO `jours_ferier` (`id_jours_ferier`, `jour`) VALUES
(1, '2018-06-03');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `code_module` text,
  `label_module` text,
  `respoensable_module` text NOT NULL,
  `coeficient` float NOT NULL,
  `id_deparetement` int(11) NOT NULL,
  PRIMARY KEY (`id_module`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

DROP TABLE IF EXISTS `niveau`;
CREATE TABLE IF NOT EXISTS `niveau` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `code_niveau` text,
  `label_niveau` text,
  PRIMARY KEY (`id_niveau`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

DROP TABLE IF EXISTS `periode`;
CREATE TABLE IF NOT EXISTS `periode` (
  `id_periode` int(11) NOT NULL AUTO_INCREMENT,
  `code_periode` text,
  `label_periode` text,
  PRIMARY KEY (`id_periode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `id_prof` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prof` text,
  `prenom_prof` text,
  `statut_prof` text,
  `tel_prof` text,
  `email_prof` text,
  `sexe_prof` text,
  `salaire_prof` double NOT NULL,
  PRIMARY KEY (`id_prof`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id_prof`, `nom_prof`, `prenom_prof`, `statut_prof`, `tel_prof`, `email_prof`, `sexe_prof`, `salaire_prof`) VALUES
(1, 'Belkora', 'Samir', 'permanent', '06 555 555 555', 'bk@gmail.com', 'h', 10000),
(3, 'Saidi', 'Abdelali', 'vacataire', '05 666 666 666', 's@gmail.co;', 'h', 0),
(4, 'Skalli', 'Ahmed', 'permanent', '5555', 'ah', 'h', 10000),
(5, 'Chraibi', 'Abdellatif', 'permanent', '0677777777', 'al', 'h', 10000),
(6, 'El Hari', 'Kaoutar', 'permanent', '064857852', 'ka', 'f', 10000),
(7, 'Ouradi', 'Mohammed', 'vacataire', '0624587952', 'our', 'h', 0);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` int(11) NOT NULL AUTO_INCREMENT,
  `nom_salle` text,
  `capacite` text,
  `type_salle` text NOT NULL,
  `etat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_salle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

DROP TABLE IF EXISTS `semestre`;
CREATE TABLE IF NOT EXISTS `semestre` (
  `id_semestre` int(11) NOT NULL AUTO_INCREMENT,
  `code_semestre` text,
  `label_semestre` text,
  PRIMARY KEY (`id_semestre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_util` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `type_util` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_util`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_util`, `username`, `password`, `type_util`) VALUES
(1, 'admin', 'admin', 'a'),
(3, 'ihab', 'ihab', 'a');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
