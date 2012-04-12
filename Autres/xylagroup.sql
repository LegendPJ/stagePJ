-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 12 Avril 2012 à 16:03
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
-- --------------------------------------------------------

--
-- Structure de la table `entite`
--

CREATE TABLE IF NOT EXISTS `entite` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `entite`
--

INSERT INTO `entite` (`id`, `nom`) VALUES
(1, 'ACCUEIL'),
(2, 'XYLASSUR'),
(3, 'XYLAVIE'),
(4, 'XYLABTP'),
(5, 'XYLARISK');


-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `encadre`
--

INSERT INTO `encadre` (`id`, `titre`, `contenu`, `entite_id`, `ordre`) VALUES
(1, 'Bienvenue Chez XYLAGROUP', '<p>Soci&eacute;t&eacute;s de Courtage en Assurances, notre groupe, issu de deux cabinets familiaux (BARR&Eacute; - JACQUET) dont les racines remontent &agrave; 1882, est actuellement compos&eacute; de trois soci&eacute;t&eacute;s : <br /><br />- <strong>XYLASSUR</strong>, proposant l''''assurance de biens, de responsabilit&eacute;s &amp; de finances,<br />- <strong> XYLABTP</strong>, sp&eacute;cialiste de l''''assurance des Constructeurs &amp; des Chantiers,<br />- <strong> XYLAVIE</strong>, sp&eacute;cialise de la protection sociale &amp; financi&egrave;re des personnes (Sant&eacute;, Pr&eacute;voyance, &Eacute;pargne, Retraite),<br />- <strong>XYLARISK</strong>, Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim venia.</p>\r\n', 1, 1),
(2, 'News', '<news>', 1, 2),
(3, 'Qui sommes-nous ?', '', 1, 3);


-- --------------------------------------------------------

--
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `titre`, `numero`, `contenu`, `auteur`, `lien`, `photo`, `date`) VALUES
(1, 'Les grands changements dans l''assurance de nos jours, qu''en pensez-vous ?? Etes vous d''accord ?', 117, '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'Rémy', 'http://www.grafikart.fr', 'XYLABTP.png', '2012-04-12'),
(2, 'xylassur', 2, 'ebdfh6f8h74sb', 'Jean Marc', '', 'XYLAGROUP.png', '2012-03-23'),
(3, 'Coordonnées', 3, 'zpedofvbx fjv65', 'Elsa', 'www.zalando.com', 'XYLAVIE.png', '2012-03-01'),
(4, 'azertyuiop', 5, 'sbdvx', 'Sylvie', 'www.leprogres.fr', 'XYLAGROUP.png', '2012-02-23'),
(5, 'pomlpim', 4, 'zqebdv', 'Delphine & Sandrine', 'www.xylassur.fr', 'XYLASSUR.png', '2012-03-01');

-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `sousencadre`
--

INSERT INTO `sousencadre` (`id`, `titre`, `contenu`, `encadre_id`, `ordre`) VALUES
(1, 'Notre m&eacute;tier', '<p>XYLAGROUPest une Soci&eacute;t&eacute; de Courtage en Assurances, et nos bureaux sont &agrave; Neuville sur Sa&ocirc;ne,&nbsp; Lons le Saunier &amp; Paris.<br />Nous accompagnons aussi nos Clients &agrave; l''&eacute;tranger, grace &agrave; un r&eacute;seau de correspondants pr&eacute;sents &agrave; New York, <strong>Philadelphie</strong>, <strong>Seattle</strong>, <strong>Toronto</strong>, <strong>Melbourne</strong>, <strong>Londres</strong>, <strong>Cologne</strong>, <strong>Rotterdam</strong>, <strong>Madrid</strong>, <strong>Ath&egrave;nes</strong>.<br /><br />L&rsquo;homog&eacute;n&eacute;it&eacute; de notre portefeuille nous permet<br />- d&rsquo;accompagner plus efficacement le d&eacute;veloppement de nos Clients par la conjugaison des exp&eacute;riences ainsi que des savoir-faire &amp; dynamisme de nos &eacute;quipes<br />- d&rsquo;am&eacute;liorer nos relations, tant en mati&egrave;re de n&eacute;gociation que de gestion, avec les Compagnies, Mutuelles, Institutions &amp; Organismes aupr&egrave;s desquels nous pla&ccedil;ons les risques de nos Clients,<br />- de conforter notre rang dans le peloton de t&ecirc;te des Cabinets de Courtage r&eacute;gionaux ind&eacute;pendants sp&eacute;cialistes des risques d&rsquo;entreprises.<br /><br />Notre conception du m&eacute;tier : <strong>Gestion &amp; Transfert Raisonn&eacute;s de Risques</strong><br /><br />Notre d&eacute;marche est bas&eacute;e sur l''analyse de nos Clients, &agrave; qui nous proposons de valider la gestion de leurs risques au travers de mesures &amp; moyens de pr&eacute;vention, surveillance, protection adapt&eacute;s. Mais aussi de ma&icirc;triser les co&ucirc;ts de leurs postes "assurances", tout en optimisant leurs garanties, par l&rsquo;ajustement de nos programmes aux r&eacute;alit&eacute;s juridiques, &eacute;conomiques &amp; financi&egrave;res de chacun d''eux.<br /><br />Nous pouvons ainsi avoir un dialogue plus constructif avec les Compagnies d''Assurances, Mutuelles, Institutions &amp; Organismes auxquels nous proposons la couverture de nos Clients.<br /><br />Cette d&eacute;marche a aussi un grand int&eacute;r&ecirc;t dans les relations de nos Assur&eacute;s avec leurs propres Clients &amp; Fournisseurs, de plus en plus soucieux des mesures et moyens mis en ouvre pour la p&eacute;rennit&eacute; de leurs activit&eacute;s et la qualit&eacute; de leurs produits/services.<br /><br /><span style="font-size: x-small;"><em>N.B. : Les conditions &eacute;conomiques du march&eacute; des assurances ne nous permettant pas d&rsquo;&ecirc;tre r&eacute;f&eacute;renc&eacute;s aupr&egrave;s de l&rsquo;ensemble des compagnies, mutuelles, institutions &amp; organismes intervenant en France, nous exer&ccedil;ons donc notre m&eacute;tier dans le cadre d&eacute;fini &agrave; l&rsquo;article L520-1-II-b du Code des Assurances.</em></span><br /><br /></p>', 3, 1),
(2, 'A l''&eacute;tranger', '<p>Pour accompagner nos Clients sur leurs march&eacute;s &agrave; l''&eacute;tranger, nous b&eacute;nficions<br /><br />- des &eacute;tablissements d''un Partenaire &agrave;<br />&nbsp; . <strong>New</strong> <strong>York</strong>, <strong>Philadelphie</strong>, <strong>Seattle</strong>, <strong>Ketchikan</strong>, <br />&nbsp; . <strong>Toronto</strong>, <br />&nbsp; . <strong>Melbourne</strong>, <br />&nbsp; . <strong>Londres</strong>, <br />&nbsp; . <strong>Cologne</strong>, <br />&nbsp; . <strong>Rotterdam</strong>, <br />&nbsp; . <strong>Madrid</strong>, <br />&nbsp; . <strong>Ath&egrave;nes</strong>.<br /><br />- de ses Correspondants en <br />&nbsp; . <strong>Autriche</strong> (Vienne)<br />&nbsp; . <strong>Belgique</strong> (Anvers)<br />&nbsp; . <strong>Bulgarie</strong> (Sofia)<br />&nbsp; . <strong>Croatie</strong> (Zagreb)<br />&nbsp; . <strong>Tch&eacute;quie</strong> (Prague)<br />&nbsp; . <strong>Dannemark</strong> (Tatrup)<br />&nbsp; . <strong>Estonie</strong> (Tallin)<br />&nbsp; . <strong>Hongrie</strong> (Budapest)<br />&nbsp; . <strong>Irlande</strong> (Cork)<br />&nbsp; . <strong>Italie</strong> (Milan)<br />&nbsp; . <strong>Lettonie</strong> (Riga)<br />&nbsp; . <strong>Lithuanie</strong> (Vilnius)<br />&nbsp; . <strong>Pologne</strong> (Varsovie)<br />&nbsp; . <strong>Portugal</strong> (Lisbone)<br />&nbsp; . <strong>Roumanie</strong> (Bucarest)<br />&nbsp; . <strong>Serbie</strong> (Novi Beograd)<br />&nbsp; . <strong>Slovaquie</strong> (Bratislava)<br />&nbsp; . <strong>Su&egrave;de</strong> (G&ouml;teborg ; Sundsval)<br /><br />mais aussi en<br />&nbsp; . <strong>Russie</strong> (Moscou)<br />&nbsp; . <strong>Ukraine</strong> (Kiev)<br />&nbsp; . <strong>Tunisie</strong> (Tunis)<br />&nbsp; . <strong>Turquie</strong> (Istambul)<br />&nbsp; . <strong>&Eacute;mirats</strong> <strong>Arabes</strong> <strong>Unis</strong> (Duba&iuml;)<br />&nbsp; . <strong>Afrique du Sud</strong> (Johanesbourg)<br />&nbsp; . <strong>Mexique</strong> (Mexico) <br />&nbsp; . <strong>Br&eacute;sil</strong> (Sao Paolo)<br />&nbsp; . <strong>Argentine</strong> (Buenos Aires)<br />&nbsp; . <strong>Chili</strong> (Santiago)<br />&nbsp; . <strong>Japon</strong> (Tokyo)<br />&nbsp; . <strong>Inde</strong> (Mumbai)<br />&nbsp; . <strong>Philippines</strong> (Makati)</p>', 3, 2),
(3, 'Coordonn&eacute;es', '	<p>&nbsp;XYLASSUR<br />- 3 Chemin de Parenty 69250 <strong>Neuville</strong> <strong>sur</strong> <strong>Sa&ocirc;ne</strong> - T&eacute;l 04 78 98 24 76<br />- 18 rue &Eacute;mile Monot 39000 <strong>Lons le Saunier</strong> - T&eacute;l 03 84 24 06 36<br />- 4 Place Louis Armand 75012 <strong>Paris</strong><br /><br />XYLASSUR est une sarl au capital de 430 000 &euro;<br />immatricul&eacute;e 433 301 256 RCS Lyon - 07001095 ORiAS<br /><strong>Soci&eacute;t&eacute;</strong> <strong>de Courtage en Assurances</strong> dont l''inscription est v&eacute;rifiable sur www.orias.fr<br />exon&eacute;r&eacute;e de TVA selon l''article 261-C-2 du Code G&eacute;n&eacute;ral des imp&ocirc;ts, sauf pour les services &amp; assistance<br />Garantie Financi&egrave;re &amp; Responsabilit&eacute; Civile Professionnelle conformes aux dispositions du Code des Assurances ainsi qu''&agrave; celles du Code Mon&eacute;taire &amp; Financier<br />Exercice sous l''&eacute;gide de l''Autorit&eacute; de Contr&ocirc;le Prudentiel (<em>www.acam.fr</em>)<br />Les G&eacute;rants de XYLASSUR sont membres de la <strong>Chambre Syndicale des Courtiers Rh&ocirc;ne Alpes Auvergne</strong><br /><br /><br /></p>', 3, 3),
(4, 'CGV', '<p><span style="text-decoration: underline;"><strong>Conditions générales de prestation de services de courtage en assurances</strong></span><br />Entre qui et qui ? <br />    La Société de Courtage en Assurances éditrice du présent site internet<br />ci-après dénommé : le prestataire, d''une part, et le client, identifié par ordre écrit de mission indiquant clairement son nom/prénom ou raison sociale (ainsi que, le cas échéant, sa forme juridique, le montant de son capital social, son numéro siren &amp; les nom prénom &amp; fonction de son représentant légal), ses coordonnées, donnant mission au prestataire, ci-après dénommé : le client, d&rsquo;autre part.</p>\r\n<p><br />Il est convenu ce qui suit :<br /><br /><strong>Objet</strong><br />Le client missionne, avec exclusivité, le prestataire pour réaliser, dans l&rsquo;intér&ecirc;t du client, l&rsquo;étude, le placement &amp; la gestion de contrats d&rsquo;assurances concernant des biens et/ou responsabilités et/ou risques financiers et/ou b&acirc;tisseurs et/ou chantiers et/ou assurances des personnes (santé, prévoyance, épargne, retraite) désignés par le client au prestataire, ci-après dénommé &laquo; la prestation &raquo; ou &laquo; la prestation de services &raquo;.<br />La prestation est &agrave; réaliser sous la forme, le cas échéant, :<br />- de rapport d&rsquo;étude, recommandation, préconisation ;<br />- de proposition de garanties adaptées aux réalités du client, sur la base de formules élaborées ou sélectionnées par le prestataire, ainsi que, selon son expertise &amp; ses connaissances, recherche &amp; placement exclusif auprès de compagnies, mutuelles, institutions, organismes pour lesquels il est agréé, pour faire bénéficier le client des meilleurs rapports garanties/prix, favorisant autant que faire se peut la pérennité &amp; l&rsquo;optimisation des couvertures &amp; co&ucirc;ts ;<br />- de placement, émission &amp; administration de contrats d&rsquo;assurances ;<br />- d&rsquo;appels de primes/cotisations par avis d&rsquo;échéances établis par le prestataire selon les termes des contrats auxquels ils se réfèrent ;<br />- de suivi/évolution/adaptation des contrats aux nouvelles réalités du client, conformément aux instructions communiquées par lui au prestataire ;<br />- d&rsquo;accompagnement dans l&rsquo;instruction &amp; le règlement de sinistre ;<br />- selon son expertise &amp; ses connaissances, toutes propositions de changements de garanties et/ou compagnies, mutuelles, institutions, organismes auprès desquels il est agréé, pour faire bénéficier le client des meilleurs rapports garanties/prix, favorisant autant que faire se peut la pérennité &amp; l&rsquo;optimisation des couvertures &amp; co&ucirc;ts ; puis mise en oeuvre conformément aux instructions du client.<br /><br /><span style="text-decoration: underline;"><strong>Prix</strong></span><br />Concernant la prestation de services fournie au titre du présent contrat,<br />- pour les opérations d&rsquo;étude, le client verse, le cas échéant, au prestataire des honoraires (soumis &agrave; TVA) convenus &amp; payables d&rsquo;avance ;<br />- pour les opérations d&rsquo;assurances, le prestataire est rémunéré, sauf convention contraire, par commissions versées par les compagnies, mutuelles, institutions, organismes auprès desquels il a placé les contrats ;<br />- pour les opérations de gestion, le client verse au prestataire, &agrave; chaque échéance, des frais proportionnels au montant de la prime/cotisation émise, selon barème consultable au siège du prestataire ; le cas échéant, le client verse au prestataire des honoraires (soumis ou non &agrave; TVA) annuels ou ponctuels de gestion &amp; conseils convenus d&rsquo;avance.<br />La totalité du prix doit &ecirc;tre versée dans les trente jours suivant la réception de la facturation par le client.<br />Concernant les contrats d&rsquo;assurances, le prix peut &ecirc;tre<br />- forfaitaire, facturé en début d&rsquo;exercice, évoluant d&rsquo;année en année (au m&ecirc;me titre que les garanties, limites &amp; franchises) en fonction de l&rsquo;indice de référence (par exemple : indice Ri, indice BM, indice FFB, etc&hellip; ) ;<br />- provisionnel, facturé en début d&rsquo;exercice, puis révisé après la cl&ocirc;ture de l&rsquo;exercice, en fonction des éléments variables (par exemple : investissements, désinvestissements, marchandises, masse salariale, chiffre d&rsquo;affaires, marge brute, &hellip;), une facture d&rsquo;ajustement étant alors émise au cours de l&rsquo;un des deux exercices suivants ;<br />- facturé/prélevé, le cas échéant, directement par les compagnies, mutuelles, institutions, organismes auprès desquels ont été placés les contrats.<br />Les taxes d&rsquo;assurances ne sont pas récupérables.<br />La totalité du prix doit &ecirc;tre versée dans les dix jours suivant la réception de la facturation par le client.<br />Toute prestation complémentaire non prévue au présent contrat donnera lieu &agrave; facturation en sus, sur la base d''un devis accepté.<br /><br /><span style="text-decoration: underline;"><strong>Conditions de paiement</strong></span><br />Les règlements du client au prestataire seront effectués par chèques ou par virements bancaires sur le compte dont RiB pourra &ecirc;tre communiqué sur demande.<br />Tout retard de paiement concernant une opération d&rsquo;étude ou de gestion entra&icirc;ne de plein droit &amp; sans mise en demeure préalable, nonobstant la clause de résiliation, la facturation d''un intér&ecirc;t de retard au taux d''intér&ecirc;t légal majoré de 1.5 points ; l''intér&ecirc;t est d&ucirc; par le seul fait de l''échéance contractuelle du règlement.<br />Particularité concernant le délai de paiement des primes/cotisations d&rsquo;assurances :<br />l''article L 133-3 du code des assurances stipule qu&rsquo;&laquo; &agrave; défaut de paiement d''une prime ou d''une fraction de prime dans les dix jours de son échéance l''assureur peut suspendre la garantie par lettre recommandée de mise en demeure. La garantie est suspendue le trente et unième jour &agrave; zéro heure &agrave; compter du lendemain de la date d''envoi de la lettre recommandée. Si ce trente et unième jour est un samedi, un dimanche ou un jour férié ou ch&ocirc;mé, la suspension est effective le premier jour ouvrable suivant. L''assureur peut résilier le contrat dix jours après le début de la suspension de garantie. Le contrat non résilié reprend pour l''avenir ses effets &agrave; midi le lendemain du jour du paiement &agrave; l''assureur &raquo;.<br /><br /><span style="text-decoration: underline;"><strong>Délai de réalisation de la prestation</strong></span><br />- pour les opérations d&rsquo;étude, le client confie au prestataire une mission pour une durée ferme convenue &agrave; l&rsquo;avance lors de sa demande d&rsquo;étude ;<br />- pour les opérations d&rsquo;assurances &amp; de gestion, le client donne de fait au prestataire (c''est-&agrave;-dire lorsque des contrats d&rsquo;assurances sont mis en place par le prestataire) un mandat de courtage avec exclusivité pour une durée d&rsquo;un an ; cependant, si la période allant de sa date d&rsquo;effet (c&rsquo;est &agrave; dire la date &agrave; laquelle prend effet le premier contrat d&rsquo;assurance mis en place par le prestataire) au 1er juillet est inférieure &agrave; un an, le mandat de courtage est conclu pour cette période augmentée de la durée d&rsquo;un an. Ledit mandat de Courtage, dont l&rsquo;échéance annuelle est fixée au 1er juillet, est renouvelé tacitement &agrave; son expiration pour une durée de douze mois, sauf résiliation pour l&rsquo;échéance annuelle moyennant un préavis de trois mois par lettre recommandée envoyée au plus tard la veille du début du préavis.<br />Toute modification de ces délais devra &ecirc;tre acceptée par les deux parties dans un avenant aux présentes.<br /><br /><span style="text-decoration: underline;"><strong>Lieu de réalisation de la prestation</strong></span><br />La réalisation de la prestation de services a lieu dans les locaux du prestataire ainsi que tous autres lieux dont il pourra &ecirc;tre besoin.<br /><br /><span style="text-decoration: underline;"><strong>Moyens mis &agrave; disposition par le client/prestataire</strong></span><br />Dès le début de réalisation de la prestation de services, le client met &agrave; la disposition du prestataire, en fonction des thèmes traités, ses contrats d&rsquo;assurances, états, descriptions, estimations, statistiques, document unique d&rsquo;évaluation des risques pour la santé &amp; la sécurité des travailleurs, manuel qualité, rapports de contr&ocirc;les, rapports de prévention, rapports d&rsquo;étude d&rsquo;impacts, conditions générales de vente, contrats ou marchés types, agréments, certifications, qualifications, etc&hellip;<br />Le prestataire collabore, en fonction des besoins, avec le Commissaire aux Comptes et/ou l&rsquo;Expert Comptable du client, ainsi qu&rsquo;avec ses Conseils en Gestion, Fiscalité, Social, Juridique, Environnement, Qualité, Organisation.<br /><br /><span style="text-decoration: underline;"><strong>Désignation des responsables respectifs</strong></span><br />Le client doit désigner une personne responsable qui sera l&rsquo;interlocuteur du prestataire. De son c&ocirc;té, le prestataire désignera au client le responsable qui aura la charge de la réalisation de la prestation de services.<br /><br /><span style="text-decoration: underline;"><strong>Engagement du client</strong></span><br />Le client s&rsquo;engage &agrave; apporter sa collaboration au prestataire afin de permettre l&rsquo;exécution des prestations de services et en particulier &agrave; :<br />- fournir au prestataire les informations &amp; éléments indispensables &agrave; la bonne compréhension des problèmes posés (par exemple : identifications, historiques, situations, contextes &amp; perspectives, etc&hellip;) ;<br />- mettre &agrave; la disposition du prestataire pour les prestations que celui-ci réalise chez le client les moyens nécessaires &agrave; leur exécution.<br /><br /><span style="text-decoration: underline;"><strong>Engagement du prestataire</strong></span><br />Le prestataire s&rsquo;engage &agrave; mener &agrave; bien la t&acirc;che précisée &agrave; l&rsquo;article &laquo; objet &raquo;, conformément aux règles de l&rsquo;art &amp; de la meilleure manière.<br /><br /><span style="text-decoration: underline;"><strong>Réception</strong></span><br />La réception de la prestation de services se réalise par la signature par les deux parties d&rsquo;un avis de réception pouvant se matérialiser par un exemplaire de rapport, ou un ordre de mission, ou un exemplaire de proposition/contrat d&rsquo;assurance, ou tout autre document du choix des parties.<br /><br /><span style="text-decoration: underline;"><strong>Responsabilité</strong></span><br />Le prestataire déclare &ecirc;tre assuré pour sa responsabilité civile professionnelle &amp; garantie financière auprès d&rsquo;une compagnie notoirement solvable pour tous les dommages matériels &amp; immatériels consécutifs &agrave; l&rsquo;exécution de la prestation par son personnel ou ses collaborateurs.<br />Le client convient que, quels que soient les fondements de sa réclamation, la responsabilité éventuelle du prestataire, &agrave; raison de l&rsquo;exécution des obligations nées du présent contrat, ne saurait excéder les montants &amp; la prescription prévus par la réglementation de la profession de courtage en assurances. Par ailleurs, le prestataire ne saurait voir sa responsabilité engagée au titre de la détérioration ou destruction des fichiers, documents, données qui auraient été confiés au client (quel que soit le support d&rsquo;informations).<br />En cas de force majeure, le prestataire ne sera pas tenu pour responsable vis-&agrave;vis du client de la non-exécution ou des retards dans l&rsquo;exécution d&rsquo;une obligation du présent contrat.<br /><br /><span style="text-decoration: underline;"><strong>Propriété des résultats</strong></span><br />Le prestataire s&rsquo;engage &agrave; remettre au client tous les éléments, notamment les rapports, brochures &amp; autres documents préparés spécialement pour le client.<br /><br /><span style="text-decoration: underline;"><strong>Confidentialité</strong></span><br />Les parties s&rsquo;engagent mutuellement &agrave; respecter la plus stricte confidentialité sur tout ce qu&rsquo;elles pourraient apprendre &agrave; l&rsquo;occasion de la réalisation de la prestation de services.<br />Particularité du métier de courtage en assurance : Le prestataire est astreint au secret professionnel (devoir de réserve, confidentialité des informations qui lui sont confiées et/ou de celles dont il a eu connaissance dans l&rsquo;exercice de ses missions), conformément aux obligations professionnelles issues des dispositions du Code des Assurances &amp; du Code Monétaire &amp; Financier. Toutes les informations recueillies par le prestataire &amp; les compagnies, mutuelles, institutions, organismes avec lesquels il travaille sont nécessaires &agrave; l&rsquo;étude &amp;, le cas échant, la mise en place puis la gestion de contrats d&rsquo;assurances. Elles ne sont utilisées par eux que pour les seules nécessités de ces missions ou pour satisfaire aux obligations légales ou réglementaires.<br />Conformément aux articles 35 et 36 de la loi n&deg; 78-17 du 6 janvier 1978 relative &agrave; l&rsquo;informatique, aux fichiers et aux libertés, le client dispose, auprès des Sièges Sociaux du prestataire &amp; des compagnies, mutuelles, institutions, organismes avec lesquels il travaille, d&rsquo;un droit d&rsquo;accès pour communication ou rectification de toutes informations le concernant &amp; figurant sur tout fichier &agrave; leur usage ainsi qu&rsquo;&agrave; celui des compagnies, mutuelles, institutions, organismes, de leurs mandataires, des réassureurs &amp; des organismes professionnels concernés.<br /><br /><span style="text-decoration: underline;"><strong>Résiliation du contrat</strong></span><br />Outre les spécificités concernant le &laquo; mandat de courtage &raquo; énoncées plus haut, en cas d&rsquo;inobservation par une des parties de ses obligations nées du présent contrat, chacune des parties peut mettre cette dernière en demeure de respecter ses obligations. Dans l&rsquo;hypothèse o&ugrave; la lettre (recommandée avec accusé de réception) de mise en demeure resterait infructueuse, le présent contrat de prestation sera présumé résilié de plein droit dans les quatre vingt dix jours suivant la réception de cette lettre.<br /><br /><span style="text-decoration: underline;"><strong>Médiateur</strong></span><br />En cas de réclamation, le client peut s&rsquo;adresser au médiateur interne &agrave; notre Cabinet, éric GENTET, qui peut &ecirc;tre contacté &agrave; l&rsquo;adresse mediateur@xylassur.fr, ou au médiateur de la Chambre Syndicale des Courtiers d&rsquo;Assurances qui peut &ecirc;tre contacté &agrave; l&rsquo;adresse mediateur@csca.fr.<br /><br /><span style="text-decoration: underline;"><strong>Attribution de juridiction</strong></span><br />Le présent contrat est soumis au droit fran&ccedil;ais. Les litiges seront de la compétence du tribunal de commerce de Lyon.<br /><br /></p>', 3, 4);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `encadre`
--
ALTER TABLE `encadre`
  ADD CONSTRAINT `encadre_entite_id_entite_id` FOREIGN KEY (`entite_id`) REFERENCES `entite` (`id`);

--
-- Contraintes pour la table `sousencadre`
--
ALTER TABLE `sousencadre`
  ADD CONSTRAINT `sousencadre_encadre_id_encadre_id` FOREIGN KEY (`encadre_id`) REFERENCES `encadre` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
