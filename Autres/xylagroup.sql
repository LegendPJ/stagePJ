-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Dim 15 Avril 2012 à 21:01
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `xylagroup`
--

--
-- Contenu de la table `encadre`
--

INSERT INTO `encadre` (`id`, `titre`, `contenu`, `entite_id`, `ordre`) VALUES
(4, 'Test encadre du XYLASSUR', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse tincidunt, risus sed vehicula molestie, nisl mi ultricies turpis, commodo laoreet nunc lacus sed orci. Integer lectus risus, mollis vitae volutpat sit amet, ullamcorper nec massa. Sed ultricies interdum mi, et facilisis lacus scelerisque eget. Nunc imperdiet tempus consectetur. Maecenas eu risus nec lorem condimentum feugiat. Sed id tortor bibendum leo fringilla viverra. Aliquam orci urna, porta nec egestas eu, gravida vitae sapien. Morbi et velit vitae ante mattis facilisis non sed diam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean euismod, felis in sagittis ultrices, eros libero laoreet mauris, nec gravida nulla tortor id velit. Sed a libero vel turpis elementum volutpat sed vitae risus. Nam nibh lorem, hendrerit vitae tincidunt at, aliquam quis eros.\r\n\r\nMorbi metus nisi, mollis sit amet imperdiet iaculis, suscipit consequat urna. Morbi ac arcu id orci luctus ultrices ut eget mauris. Donec vel nibh tempus neque ultricies posuere. Phasellus elementum tellus fermentum nisi pretium eu vestibulum ante pharetra. Fusce commodo diam eget augue tristique interdum. Duis fringilla cursus dignissim. Fusce aliquam risus consequat libero bibendum tempus a at massa. </p>', 2, 1),
(5, 'Second Test', 'eqfhliibv', 2, 2);

--
-- Contenu de la table `sousencadre`
--

INSERT INTO `sousencadre` (`id`, `titre`, `contenu`, `encadre_id`, `ordre`) VALUES
(5, 'Sous encad 1', 'Morbi metus nisi, mollis sit amet imperdiet iaculis, suscipit consequat urna. Morbi ac arcu id orci luctus ultrices ut eget mauris. Donec vel nibh tempus neque ultricies posuere. Phasellus elementum tellus fermentum nisi pretium eu vestibulum ante pharetra. Fusce commodo diam eget augue tristique interdum. Duis fringilla cursus dignissim. Fusce aliquam risus consequat libero bibendum tempus a at massa. ', 5, 3),
(6, 'Je Haut bonojour bonjour', 'eu vestibulum ante pharetra. Fusce commodo diam eget augue tristique interdum. Duis fringilla cursus dignissim. Fusce aliquam risus consequat libero bibendum tempus a at massa. Morbi metus nisi, mollis sit amet imperdiet iaculis, suscipit consequat urna. Morbi ac arcu id orci luctus ultrices ut eget mauris. Donec vel nibh tempus neque ultricies posuere. Phasellus elementum tellus fermentum nisi pretium ', 5, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
