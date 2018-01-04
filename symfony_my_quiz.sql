-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 04 jan. 2018 à 13:08
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfony_my_quiz`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(0, 'Harry Potter'),
(1, '\nSigles Français'),
(2, '\nDéfinitions de mots'),
(3, '\nLes spécialités culinaires'),
(4, '\nSéries TV : les simpson - partie 1'),
(5, '\nSéries TV : les simpson - partie 2'),
(6, '\nSéries TV : Stargate SG1'),
(7, '\nSéries TV : NCIS'),
(8, '\nJeux de société'),
(9, '\nProgrammation'),
(10, '\nSigles informatiques'),
(11, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `historique_user_quizz`
--

DROP TABLE IF EXISTS `historique_user_quizz`;
CREATE TABLE IF NOT EXISTS `historique_user_quizz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `categorie_quizz` int(11) NOT NULL,
  `score` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `ip_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `historique_user_quizz`
--

INSERT INTO `historique_user_quizz` (`id`, `user_id`, `categorie_quizz`, `score`, `created_at`, `ip_user`) VALUES
(34, NULL, 3, '7/10', '2017-11-21 13:13:18', '127.0.0.1'),
(35, NULL, 3, '7/10', '2017-11-21 13:13:31', '127.0.0.1'),
(36, NULL, 3, '6/10', '2017-11-21 15:00:06', '127.0.0.1111'),
(37, 9, 6, '9/10', '2017-11-21 15:16:51', '127.0.0.1'),
(38, 9, 6, '9/10', '2017-11-21 15:24:40', '127.0.0.1'),
(39, NULL, 7, '7/10', '2017-11-28 12:54:21', '127.0.0.1'),
(40, NULL, 1, '0/0', '2017-11-28 13:10:07', '127.0.0.1'),
(41, NULL, 1, '1/1', '2017-11-28 13:10:19', '127.0.0.1'),
(42, NULL, 0, '6/10', '2017-11-28 13:35:26', '127.0.0.1');

-- --------------------------------------------------------

--
-- Structure de la table `infos_user`
--

DROP TABLE IF EXISTS `infos_user`;
CREATE TABLE IF NOT EXISTS `infos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `visiteur` int(11) DEFAULT NULL,
  `inscrit` int(11) DEFAULT NULL,
  `nb_quizz_effectuer_annee` int(11) DEFAULT NULL,
  `nb_quizz_effectuer_mois` int(11) DEFAULT NULL,
  `nb_quizz_effectuer_semaine` int(11) DEFAULT NULL,
  `nb_quizz_effectuer_24h` int(11) DEFAULT NULL,
  `theme_choix_quizz` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `ip_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `infos_user`
--

INSERT INTO `infos_user` (`id`, `id_user`, `visiteur`, `inscrit`, `nb_quizz_effectuer_annee`, `nb_quizz_effectuer_mois`, `nb_quizz_effectuer_semaine`, `nb_quizz_effectuer_24h`, `theme_choix_quizz`, `created_at`, `ip_user`) VALUES
(44, 7, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2017-11-20 10:01:28', '127.0.0.11'),
(47, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-20 10:04:19', '127.0.0.1111'),
(48, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2017-01-20 10:05:21', '127.0.0.11111111'),
(49, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-20 10:06:44', '127.0.0.11111111'),
(149, 9, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2017-11-21 15:45:19', '127.0.0.1'),
(150, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-08 10:47:59', '127.0.0.1'),
(151, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-12 12:10:41', '127.0.0.1'),
(152, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-15 13:02:25', '127.0.0.1');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(6) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494EC9486A13` (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `id_categorie`, `question`) VALUES
(0, 0, 'Dans la partie d?échec, Harry Potter prend la place de :'),
(1, 0, 'Quel est le mot de passe du bureau de Dumbledore ?'),
(2, 0, 'Quel chiffre est écrit à l\'avant du Poudlard Express ?'),
(3, 0, 'Avec qui Harry est-il interdit de jouer à vie au Quidditch par Ombrage ?'),
(4, 0, 'Sur quelle(s) main(s) Harry s\'écrit-il je ne dois pas dire de mensonge pendant ses retenues avec Ombrage ?'),
(5, 0, 'Everard et Dilys sont :'),
(6, 0, 'Quel est le prénom du professeur Gobe-Planche ?'),
(7, 0, 'Quel est le nom de jeune fille de Molly Weasley ?'),
(8, 0, 'Lequel de ces Mangemorts n\'était pas présent lors de l\'invasion au ministère ?'),
(9, 0, 'En quelle année sont morts les parents de Harry Potter ?'),
(10, 1, 'Que signifie AOC ?'),
(11, 1, 'Que signifie CROUS ?'),
(12, 1, 'Que signifie FAI ?'),
(13, 1, 'Que signifie l\'INSEE ?'),
(14, 1, 'Que signifie ADN ?'),
(15, 1, 'Que signifie SAMU ?'),
(16, 1, 'Que signifie SFR ?'),
(17, 1, 'Que signifie FNAC ?'),
(18, 1, 'Que signifie RATP ?'),
(19, 1, 'Que signifie SMIC ?'),
(20, 2, 'Que signifie le verbe Enrêner ?'),
(21, 2, 'Qu\'est-ce qu\'un protocole ?'),
(22, 2, 'Que fait une langue qui est protractile ?'),
(23, 2, 'Qu\'est ce qu\'un Campanile ?'),
(24, 2, 'ue signifie le mot « gentilé » ?'),
(25, 2, 'Qu\'est ce qu\'un Pugilat ?'),
(26, 2, 'Parmi ces définitions, laquelle n\'est pas une torpille ?'),
(27, 2, 'Qu\'est ce que la déontologie ?'),
(28, 2, 'Qu\'est ce qu\'un carcan ?'),
(29, 2, 'Que signifie le terme univoque ?'),
(30, 3, 'Quelle est la spécialité de Reims ?'),
(31, 3, 'Parmi ces spécialités, laquelle ne fait pas partie du patrimoine gastronomique de la ville de Troyes ?'),
(32, 3, 'Dans quelle département trouve-t-on les lentilles du Puy ?'),
(33, 3, 'Dans quel département trouve-t-on la Teurgoule ?'),
(34, 3, 'Quel fromage ne trouve-t-on pas en Normandie ?'),
(35, 3, 'Parmi ces spécialités, laquelle ne vient pas de la région PACA ?'),
(36, 3, 'Quelle est la spécialité de Tours ?'),
(37, 3, 'Parmi ces biscuits lesquelles ne vient pas de Bretagne ?'),
(38, 3, 'Quelle est le nom de cette recette: Lamproie à la? ?'),
(39, 3, 'Le Kouglof est une spécialité de :'),
(40, 4, 'Comment s\'appelle le père d\'Homer Simpson ?'),
(41, 4, 'Quel est le nom du dessin animé gore préféré de Bart et Lisa Simpson ?'),
(42, 4, 'De quel instrument joue Lisa Simpson ?'),
(43, 4, 'Comment s\'appelle le meilleur ami de Bart ?'),
(44, 4, 'Quelle est la profession de Wiggum ?'),
(45, 4, 'Qui en veut à la vie de Bart Simpson ?'),
(46, 4, 'Qui est Smithers ?'),
(47, 4, 'Quelle est la nationalité de Willy ?'),
(48, 4, 'Quelle est la nourriture préférée d\'Homer ?'),
(49, 4, 'Dans quelle ville habitent les Simpson ?'),
(50, 5, 'Qui est le créateur des Simpson ?'),
(51, 5, 'Quel est le nom de jeune fille de Marge Simpson ?'),
(52, 5, 'Que faisait le chien des Simpson avant qu\'ils l\'adoptent ?'),
(53, 5, 'Où Maud Flanders trouva t-elle la mort ?'),
(54, 5, 'Quelle réplique prononce très souvent Homer Simpson ?'),
(55, 5, 'Comment s\'appelle la bière préférée des habitat de Springfield ?'),
(56, 5, 'Quelle est le vice de Marge ?'),
(57, 5, 'Comment s\'appelle la mère d\'Homer ?'),
(58, 5, 'Comment s\'appelle la ville voisine et ennemie de Springfrield ?'),
(59, 5, 'Quelle est l\'une des particularités de Moe ?'),
(60, 6, 'Où se trouve la base de commandement du SGC ?'),
(61, 6, 'Comment s\'appelle les crabes métalliques qui se reproduisent rapidement en se nourrissant de métal ?'),
(62, 6, 'Combien a y-t-il de saisons dans Stargate SG1 ?'),
(63, 6, 'Dans l\'épisode « L\'histoire sans fin » que font Jack et Teal\'c d\'assez particulier ?'),
(64, 6, 'Qui est le commandant suprême de la flotte Asgard ?'),
(65, 6, 'De qui Jolinar était-elle la compagne ?'),
(66, 6, 'Quel mot désigne les habitants de la planète Terre ?'),
(67, 6, 'De qui Sha\'are devient-elle l\'hôte ?'),
(68, 6, 'L\'alliance des quatre races est composée des Anciens, Des Asgards, des Furlings et..'),
(69, 6, 'Comment meurt Daniel Jackson avant de faire son Ascension et d\'être ensuite remplacé par Jonas Quinn ?'),
(70, 7, 'Quels sont les prénoms de Gibbs ?'),
(71, 7, 'Comment est morte Kate à la fin de la deuxième saison ?'),
(72, 7, 'Quelle est la boisson préférée d\'Abby ?'),
(73, 7, 'Qui est en réalité Jeanne Benoit, la petite amie de Tony dans la Saison 4 ?'),
(74, 7, 'De quelle grave maladie Tony DiNozzo est infectée dans la saison 2 ?'),
(75, 7, 'A part les filles, quelle est la grande passion de Tony DiNozzo ?'),
(76, 7, 'Ziva David est un ancien officier du ? ?'),
(77, 7, 'Lorsque Gibbs décide de démissionner à la fin de la Saison 3, quel personnage devient le chef de l\'équipe ?'),
(78, 7, 'Avec quel agent Palmer a-t-il eu une liaison ?'),
(79, 7, 'Comment Jenny Shepard trouve-t-elle la mort au court de la saison 5 ?'),
(80, 8, 'Lequel de ces navires ne se retrouvent pas dans le « Toucher-couler » ?'),
(81, 8, 'Laquelle de ces couleurs n\'existe pas au Trivial poursuite traditionnel ?'),
(82, 8, 'Laquelle de ces lettres vaut 10 points au scrabble ?'),
(83, 8, 'Quelle est la rue qui coute le moins cher au Monopoly français ?'),
(84, 8, 'Dans le monopoly d\'origine combien gagnait-on en passant par la case départ ?'),
(85, 8, 'Parmi ces pays, lequel n\'est pas présent sur le plateau du jeu « Risk » ?'),
(86, 8, 'Combien y a-t-il de flèches au Backgammon ?'),
(87, 8, 'Lequel de ces déplacement n\'existe pas aux échecs ?'),
(88, 8, 'Au jeu du Cluedo qui est professeur ?'),
(89, 8, 'Comment appelle-t-on le groupe de cartes au 1000 bornes qui comprend : As du volant, camion-citerne, increvable, prioritaire....'),
(90, 9, 'Lequel de ces langages ne peut pas être exécuté côté serveur ?'),
(91, 9, 'Lequel de ces langages a la vitesse d\'éxécution la plus rapide ?'),
(92, 9, 'Quel est l\'animal qui représente habituellement le langage PHP ?'),
(93, 9, 'Lequel de ces systèmes d\'exploitation est sous environnement UNIX ?'),
(94, 9, 'Lequel de ces langages est reconnu pour sa grande portabilité et sa flexibilité ?'),
(95, 9, 'Laquelle de ces propositions n\'est pas un langage de programmation ?'),
(96, 9, 'Quelle commande permet de planifier l\'éxécution de tâches sous UNIX ?'),
(97, 9, 'Quel est le composant principal d\'un ordinateur, sur lequel sont greffés les autres ?'),
(98, 9, 'Quel port externe n\'existe pas sur un ordinateur ?'),
(99, 9, 'Quel nom d\'attaque n\'existe pas dans le domaine de la sécurité ?'),
(100, 10, 'Que signifie HTTP ?'),
(101, 10, 'Que signifie SSL ?'),
(102, 10, 'Que signifie FTP ?'),
(103, 10, 'Laquelle de ces propositions n\'est pas un SGBDR ?'),
(104, 10, 'Que signifie WWW ?'),
(105, 10, 'Que signifie URI ?'),
(106, 10, 'Que signifie IP ?'),
(107, 10, 'Qu\'est-ce que peut évoquer REMOTE_ADDR ?'),
(108, 10, 'Laquelle de ces propositions n\'est pas une IP correcte ?'),
(109, 10, 'Laquelle de ces propositions n\'est pas une MAC correcte ?'),
(110, NULL, 'oijiojiojiojo');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_question` int(6) DEFAULT NULL,
  `reponse` varchar(255) DEFAULT NULL,
  `check_reponse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5FB6DEC7E62CA5DB` (`id_question`)
) ENGINE=MyISAM AUTO_INCREMENT=331 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `id_question`, `reponse`, `check_reponse`) VALUES
(1, 0, 'Un fou', 1),
(2, 0, 'Une tour', 0),
(3, 0, 'Un pion', 0),
(4, 1, 'Sorbet Citron', 1),
(5, 1, 'Chocogrenouille', 0),
(6, 1, 'Dragées Surprise', 0),
(7, 2, '5972', 1),
(8, 2, '4732', 0),
(9, 2, '6849', 0),
(10, 3, 'George Weasley', 1),
(11, 3, 'Fred Weasley', 0),
(12, 3, 'Drago Malefoy', 0),
(13, 4, 'La droite', 1),
(14, 4, 'La gauche', 0),
(15, 4, 'Les deux', 0),
(16, 5, 'Deux directeurs de Poudlard', 1),
(17, 5, 'Deux amants célèbres de Poudlard', 0),
(18, 5, 'Deux préfets en chef', 0),
(19, 6, 'Wilhelmina', 1),
(20, 6, 'Libellia', 0),
(21, 6, 'Carlotta', 0),
(22, 7, 'Prewett', 1),
(23, 7, 'Foist', 0),
(24, 7, 'Jugson', 0),
(25, 8, 'Rowle', 1),
(26, 8, 'Crabbe', 0),
(27, 8, 'Goyle', 0),
(28, 9, '1981', 1),
(29, 9, '1982', 0),
(30, 9, '1983', 0),
(31, 10, 'Appellation d\'Origine Contrôlée', 1),
(32, 10, 'Aliment Original Contrôlé', 0),
(33, 10, 'Association des Obligations des Consommateurs', 0),
(34, 11, 'Centre Régional des Oeuvres Universitaires et Scolaires', 1),
(35, 11, 'Centre de Restauration et d\'Organisation Universitaire et Secondaire', 0),
(36, 11, 'Comité Régional pour l\'Organisation Universitaire et Scolaire', 0),
(37, 12, 'Fournisseur d\'Accès Internet', 0),
(38, 12, 'Fournisseur d\'Alimention et d\'Informatique', 1),
(39, 12, 'Fédération à l\'Accès Informatique', 0),
(40, 13, 'Institut National de la Statistique et des Études Économiques', 1),
(41, 13, 'Institut National de Service pour l\'Économie et l\'Enseignement', 0),
(42, 13, 'Institution Nationalisé pour les Statistiques des Établissements Économiques', 0),
(43, 14, 'Acide Desoxyriboucléique', 1),
(44, 14, 'Atome Desoxygénénucléique', 0),
(45, 14, 'Aspérité Desoxygéné et Nucléanbique', 0),
(46, 15, 'Service d\'Aide Médicale Urgente', 1),
(47, 15, 'Service d\'Ambulance et de Médecine d\'Urgence', 0),
(48, 15, 'Service Auxiliaire Mutualisé d\'Urgence', 0),
(49, 16, 'Société Française de Radiotéléphone', 1),
(50, 16, 'Société Francophone des Réseaux', 0),
(51, 16, 'Société Financière et Radio-téléphonique', 0),
(52, 17, 'Fédération Nationale d\'Achat des Cadres', 1),
(53, 17, 'Franchise Nationale d\'Art et de Culture', 0),
(54, 17, 'Firme Nationale d\'Achat Culturel', 0),
(55, 18, 'Régie autonome des transports parisiens', 1),
(56, 18, 'Reseaux automatisé des transports parisiens', 0),
(57, 18, 'Régie automatique des transports de Paris', 0),
(58, 19, 'Salaire Minimum Interprofessionnel de Croissance', 1),
(59, 19, 'Salaire Médian d\'Intérêt Communautaire', 0),
(60, 19, 'Salaire Moyen d\'Insertion de Croissance', 0),
(61, 20, 'Mettre des rênes', 1),
(62, 20, 'Etre dépendent de quelque chose', 0),
(63, 20, 'Etre à l\'origine d\'un fait', 0),
(64, 21, 'Un ensemble de règles établies', 1),
(65, 21, 'Le fait de savoir parler plusieurs langues', 0),
(66, 21, 'Une série de chiffre', 0),
(67, 22, 'Elle peut être étirée vers l\'avant', 1),
(68, 22, 'Elle peut se diviser en deux', 0),
(69, 22, 'Elle peut s\'enrouler sur elle même', 0),
(70, 23, 'Un cloché', 1),
(71, 23, 'Une maison de campagne', 0),
(72, 23, 'Une forteresse', 0),
(73, 24, 'C\'est le nom des habitants d\'un lieu', 1),
(74, 24, 'C\'est un synonyme du mot gentillesse', 0),
(75, 24, 'C\'est le nom du mouvement que l\'on fait avec un tournevis', 0),
(76, 25, 'Un combat au corps à corps', 1),
(77, 25, 'Une demande d\'audience', 0),
(78, 25, 'Une sorte de dague', 0),
(79, 26, 'Une espèce de calamar', 1),
(80, 26, 'Un poisson qui ressemble à une raie', 0),
(81, 26, 'Un engin automoteur sous-marin', 0),
(82, 27, 'Le code de conduite d\'une profession', 1),
(83, 27, 'Une partie de la médecine qui étudie la peau', 0),
(84, 27, 'L\'étude des facultés psychiques des dauphins', 0),
(85, 28, 'Une contrainte qui entrave la liberté', 1),
(86, 28, 'Une sorte de montre', 0),
(87, 28, 'Une pièce de tissu', 0),
(88, 29, 'Qui n\'a qu\'un sens', 1),
(89, 29, 'Qui a plusieurs sens', 0),
(90, 29, 'Qui est sans contrainte', 0),
(91, 30, 'Le biscuit rose', 1),
(92, 30, 'Le trou rémois', 0),
(93, 30, 'Le cidre rosé', 0),
(94, 31, 'La pâte de fruit à la mirabelle', 1),
(95, 31, 'Le chaource', 0),
(96, 31, 'L\'andouillette', 0),
(97, 32, 'Haute Loire', 1),
(98, 32, 'Allier', 0),
(99, 32, 'Cantal', 0),
(100, 33, 'Le Calvados', 1),
(101, 33, 'Le cantal', 0),
(102, 33, 'L\'ardèche', 0),
(103, 34, 'Saint Félicien', 1),
(104, 34, 'Livarot', 0),
(105, 34, 'Neufchâtel', 0),
(106, 35, 'Le cassoulet', 1),
(107, 35, 'La tapenade', 0),
(108, 35, 'Les calissons', 0),
(109, 36, 'Les rillons', 1),
(110, 36, 'Le confis', 0),
(111, 36, 'Le magret', 0),
(112, 37, 'Les madeleines', 1),
(113, 37, 'Les craquelins', 0),
(114, 37, 'Les gavottes', 0),
(115, 38, 'Bordelaise', 1),
(116, 38, 'Toulousaine', 0),
(117, 38, 'Marseillaise', 0),
(118, 39, 'L\'Alsace', 1),
(119, 39, 'La lorraine', 0),
(120, 39, 'La Franche comté', 0),
(121, 40, 'Abraham', 1),
(122, 40, 'Georges', 0),
(123, 40, 'Francis', 0),
(124, 41, 'Itchy et Scratchy show', 1),
(125, 41, 'Les tronçonneuses folles', 0),
(126, 41, 'Cat and dog', 0),
(127, 42, 'Du saxophone', 1),
(128, 42, 'De la trompette', 0),
(129, 42, 'De la clarinette', 0),
(130, 43, 'Milhouse', 1),
(131, 43, 'Martin', 0),
(132, 43, 'Ralph', 0),
(133, 44, 'C\'est le chef de la police', 1),
(134, 44, 'Il est vendeur de BD', 0),
(135, 44, 'C\'est le vrai nom de l\'homme Abeille', 0),
(136, 45, 'Tahiti Bob', 1),
(137, 45, 'Krusty le clown', 0),
(138, 45, 'L\'homme Abeille', 0),
(139, 46, 'L\'assistant du président de la centrale nucléaire', 1),
(140, 46, 'Un collègue d\'Homer Simpson', 0),
(141, 46, 'Le président de la centrale nucléaire où travaille Homer', 0),
(142, 47, 'Ecossais', 1),
(143, 47, 'Canadien', 0),
(144, 47, 'Australien', 0),
(145, 48, 'Les donuts', 1),
(146, 48, 'Les pizzas', 0),
(147, 48, 'Les hamburgers', 0),
(148, 49, 'Springfield', 1),
(149, 49, 'Sheffield', 0),
(150, 49, 'Shortfield', 0),
(151, 50, 'Matt Groening', 1),
(152, 50, 'Seth Mac Farlane', 0),
(153, 50, 'Glenn Eichler', 0),
(154, 51, 'Bouvier', 1),
(155, 51, 'Polsen', 0),
(156, 51, 'March', 0),
(157, 52, 'De la course de lévriers', 1),
(158, 52, 'C\'était un chien d\'aveugle', 0),
(159, 52, 'Il était chien policer', 0),
(160, 53, 'Dans les gradins d\'un stade', 1),
(161, 53, 'Elle disparaît en mer', 0),
(162, 53, 'Dans la maison des Simpson', 0),
(163, 54, 'Oh punaise!', 1),
(164, 54, 'Oh mon dieu!', 0),
(165, 54, 'Oh bravo!', 0),
(166, 55, 'La Duff', 1),
(167, 55, 'La Kronekein', 0),
(168, 55, 'La Spiner', 0),
(169, 56, 'Elle a une addiction aux jeux d\'argent', 1),
(170, 56, 'Elle se drogue secrètement', 0),
(171, 56, 'Elle boit souvent', 0),
(172, 57, 'Mona', 1),
(173, 57, 'Gina', 0),
(174, 57, 'Dina', 0),
(175, 58, 'Shelbyville', 1),
(176, 58, 'Summerville', 0),
(177, 58, 'Stringville', 0),
(178, 59, 'Il a des tendances suicidaires', 1),
(179, 59, 'Il est ventriloque', 0),
(180, 59, 'Il vole dans les supermarchés', 0),
(181, 60, 'Dans le Colorado', 1),
(182, 60, 'Dans l\'Arizona', 0),
(183, 60, 'Dans l\'Utah', 0),
(184, 61, 'Les réplicateurs', 1),
(185, 61, 'Les réplicants', 0),
(186, 61, 'Les répliqueurs', 0),
(187, 62, '10 Saisons', 1),
(188, 62, '8 Saisons', 0),
(189, 62, '12 Saisons', 0),
(190, 63, 'Ils font du golf avec la porte des étoiles', 1),
(191, 63, 'Ils jouent au tennis dans les couloirs de la base', 0),
(192, 63, 'Ils font du camping dans la base', 0),
(193, 64, 'Thor', 1),
(194, 64, 'Loki', 0),
(195, 64, 'Penegal', 0),
(196, 65, 'Martouf', 1),
(197, 65, 'Selmak', 0),
(198, 65, 'Malek', 0),
(199, 66, 'Les Tau\'ri', 1),
(200, 66, 'Les Tok\'ra', 0),
(201, 66, 'Les Oris', 0),
(202, 67, 'Amonet', 1),
(203, 67, 'Amaterasu', 0),
(204, 67, 'Hathor', 0),
(205, 68, 'Des Nox', 1),
(206, 68, 'Des Ori', 0),
(207, 68, 'Des Unas', 0),
(208, 69, 'Il absorbe une dose de radiation', 1),
(209, 69, 'Il est tué par Apophis', 0),
(210, 69, 'Il tombe dans un ravin', 0),
(211, 70, 'Leroy Jethro', 1),
(212, 70, 'Jack Lenny', 0),
(213, 70, 'Lance Jimmy', 0),
(214, 71, 'D\'une balle dans la tête', 1),
(215, 71, 'Lors d\'une explosion', 0),
(216, 71, 'En tombant d\'un toit', 0),
(217, 72, 'Un soda caféine', 1),
(218, 72, 'Un diabolo menthe', 0),
(219, 72, 'Un thé glacé', 0),
(220, 73, 'La fille d\'un trafiquant d\'armes', 1),
(221, 73, 'Une espionne russe', 0),
(222, 73, 'Un agent double de la CIA', 0),
(223, 74, 'La peste', 1),
(224, 74, 'La tuberculose', 0),
(225, 74, 'Le cholera', 0),
(226, 75, 'Le cinéma', 1),
(227, 75, 'Le base-ball', 0),
(228, 75, 'Les voitures de courses', 0),
(229, 76, 'Mossad', 1),
(230, 76, 'KGB', 0),
(231, 76, 'NSA', 0),
(232, 77, 'Tony', 1),
(233, 77, 'Ziva', 0),
(234, 77, 'McGee', 0),
(235, 78, 'Lee', 1),
(236, 78, 'Ziva', 1),
(237, 78, 'Kate', 0),
(238, 79, 'Lors d\'une fusillade', 1),
(239, 79, 'Lors d\'un accident de voiture', 0),
(240, 79, 'Lors d\'une explosion', 0),
(241, 80, 'Un cuirassé', 1),
(242, 80, 'Un sous-marin', 0),
(243, 80, 'Un porte-avions', 0),
(244, 81, 'Rouge', 1),
(245, 81, 'Orange', 0),
(246, 81, 'Vert', 0),
(247, 82, 'K', 1),
(248, 82, 'J', 0),
(249, 82, 'Q', 0),
(250, 83, 'Boulevard de Belleville', 1),
(251, 83, 'Rue de Vaugirard', 0),
(252, 83, 'Rue Lecourbe', 0),
(253, 84, '20 000 francs', 1),
(254, 84, '2 000 francs', 0),
(255, 84, '50 000 francs', 0),
(256, 85, 'Russie', 1),
(257, 85, 'Ukraine', 0),
(258, 85, 'Chine', 0),
(259, 86, '24', 1),
(260, 86, '12', 0),
(261, 86, '32', 0),
(262, 87, 'Le pool', 1),
(263, 87, 'Le roque', 0),
(264, 87, 'En passant', 0),
(265, 88, 'Violet', 1),
(266, 88, 'Olive', 0),
(267, 88, 'Orange', 0),
(268, 89, 'Les bottes', 1),
(269, 89, 'Les parades', 0),
(270, 89, 'Les attaques', 0),
(271, 90, 'HTML', 1),
(272, 90, 'JavaScript', 0),
(273, 90, 'PHP', 0),
(274, 91, 'C', 1),
(275, 91, 'PHP', 0),
(276, 91, 'Python', 0),
(277, 92, 'Elephant', 1),
(278, 92, 'Serpent', 0),
(279, 92, 'Souris', 0),
(280, 93, 'Debian', 1),
(281, 93, 'Windows', 0),
(282, 93, 'Java', 0),
(283, 94, 'Java', 1),
(284, 94, 'Python', 0),
(285, 94, 'C++', 0),
(286, 95, 'Saphir', 1),
(287, 95, 'Ruby', 0),
(288, 95, 'Perl', 0),
(289, 96, 'crontab', 1),
(290, 96, 'task', 0),
(291, 96, 'run', 0),
(292, 97, 'Carte mère', 1),
(293, 97, 'Processeur', 0),
(294, 97, 'Carte graphique', 0),
(295, 98, 'VGE', 1),
(296, 98, 'HDMI', 0),
(297, 98, 'USB', 0),
(298, 99, 'MS-DOS 95', 1),
(299, 99, 'DDOS', 0),
(300, 99, 'Bruteforce', 0),
(301, 100, 'Hyper Text Transfer Protocol', 1),
(302, 100, 'Host Type Text Protocol', 0),
(303, 100, 'Host Trame Transfer Protocol', 0),
(304, 101, 'Secure Socket Layer', 1),
(305, 101, 'Socket Same Loundge', 0),
(306, 101, 'Security Socket Law', 0),
(307, 102, 'File Transfer Protocol', 1),
(308, 102, 'Film Transfert Processus', 0),
(309, 102, 'File Trame Pratical', 0),
(310, 103, 'CSV', 1),
(311, 103, 'MySQL', 0),
(312, 103, 'MongoDB', 0),
(313, 104, 'World Wide Web', 1),
(314, 104, 'Word Wild Web', 0),
(315, 104, 'Warp World Web', 0),
(316, 105, 'Uniform Resource Identifier', 1),
(317, 105, 'Ulimit Redirection Id', 0),
(318, 105, 'Unity Range Information', 0),
(319, 106, 'Internet Protocol', 1),
(320, 106, 'Internic Procedural', 0),
(321, 106, 'Internal Processus', 0),
(322, 107, 'Une Adresse IP', 1),
(323, 107, 'Une Adresse MAC', 0),
(324, 107, 'Une Prise de contrôle', 0),
(325, 108, '128.256.0.1', 1),
(326, 108, '127.0.0.1', 0),
(327, 108, '255.255.0.0', 0),
(328, 109, 'EX:3F:7E:E6:2D:58', 1),
(329, 109, 'EA:9D:00:5B:CE:FF', 0),
(330, 109, 'AA:BB:CC:DD:EE:FF', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mois` int(11) DEFAULT NULL,
  `status_compte` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_connexion` datetime DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `mois`, `status_compte`, `username`, `date_connexion`, `email`, `password`) VALUES
(1, NULL, '1', 'admin', '2017-11-28 13:53:11', 'admin@admin.com', '$2y$13$WxzkwsNwQnwoUasRbRsVl.qe2i94pns2qocETnDfJ12oHbuskhwdq'),
(7, 8, '1', 'test', '2013-03-20 10:01:28', 'test@test.com', '$2y$13$YPIqGNWvLUPOevjBXxrpTe6G/xfMnpdFr.0K6fqvmY/J2e05Ld0EO'),
(9, 0, '1', 'toti', '2017-11-26 15:04:42', 'toto@toto.fr', '$2y$13$oFUeSuQmE5DiqHVQJMk2z.DSyWmUmPDMWvzVe5dhd5VreE.a1fkxK'),
(10, 0, '1', 'test16', NULL, 'test16@toto.fr', '$2y$13$JS.rjSJqMjPBV93ws/gWKeEguAeWG60kBxaYMtDOqVa/xODMcqRCu');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
