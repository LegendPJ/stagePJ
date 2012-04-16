
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Structure de la table `entite`
--

CREATE TABLE IF NOT EXISTS `entite` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


--
-- Structure de la table `encadre`
--

CREATE TABLE IF NOT EXISTS `encadre` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `entite_id` bigint(20) NOT NULL,
  `ordre` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entite_id_idx` (`entite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `numero` bigint(20) NOT NULL,
  `contenu` text NOT NULL,
  `auteur` text NOT NULL,
  `lien` text,
  `photo` text,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;



--
-- Structure de la table `sousencadre`
--


CREATE TABLE IF NOT EXISTS `sousencadre` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `encadre_id` bigint(20) NOT NULL,
  `ordre` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `encadre_id_idx` (`encadre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--