-- fichier original de la BDD

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 24, 2022 at 01:32 PM
-- Server version: 8.0.23
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myfavoritedogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogbreeds`
--

CREATE TABLE `dogbreeds` (
  `id` int NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dogbreeds`
--

INSERT INTO `dogbreeds` (`id`, `title`, `slug`, `image`) VALUES
(114, 'Shiba Inu', 'shiba', NULL),
(115, 'Czechoslovakian Wolfdog', 'cwd', NULL),
(116, 'Siberian Husky', 'husky', NULL),
(118, 'Samoyed', 'sam', NULL),
(119, 'Alaskan Malamute', 'mala', NULL),
(120, 'Tamaskan', 'tam', NULL),
(121, 'Akita Inu', 'akita', NULL),
(122, 'Belgian Malinois', 'malou', NULL),
(123, 'German Shepherd', 'gsd', NULL),
(124, 'Australian Shepherd', 'aussie', NULL),
(125, 'Groenendael Belgian Shepherd', 'gro', NULL),
(126, 'Border Collie', 'border', NULL),
(127, 'Labrador', 'lab', NULL),
(128, 'Golden Retriever', 'golden', NULL),
(129, 'American Akita', 'am-akita', NULL),
(130, 'American Cocker Spaniel', 'am-cock', NULL),
(131, 'American Staffordshire Terrier', 'staffie', NULL),
(132, 'Argentine Dogo', 'dog-arg', NULL),
(133, 'Australian Cattle Dog', 'aussie-cattle-dog', NULL),
(134, 'Basenji', 'basen', NULL),
(135, 'Basset Hound', 'basset', NULL),
(136, 'Beagle', 'beagle', NULL),
(137, 'Bearded Collie', 'beard-collie', NULL),
(138, 'Beauceron', 'beauce', NULL),
(139, 'Berger Picard', 'picard', NULL),
(140, 'Bernese Mountain Dog', 'bouv-bernois', NULL),
(141, 'Bobtail', 'bobtail', NULL),
(142, 'Boston Terrier', 'bost', NULL),
(143, 'Boxer', 'boxer', NULL),
(144, 'Briard', 'briard', NULL),
(145, 'Britanny', 'brit', NULL),
(146, 'Bull Terrier', 'bull-terrier', NULL),
(147, 'Bullmastiff', 'bullmastiff', NULL),
(148, 'Cane Corso', 'canecorso', NULL),
(149, 'Cavalier King Charles', 'ckc', NULL),
(150, 'Chihuahua', 'chihuahua', NULL),
(151, 'White Swiss Shepherd', 'bbs', NULL),
(152, 'Chinese Crested Dog ', 'crested', NULL),
(153, 'Chow Chow', 'chow', NULL),
(154, 'Corgi', 'corgi', NULL),
(155, 'Coton de Tulear', 'coton', NULL),
(156, 'Dachshund', 'dach', NULL),
(157, 'Dalmatian', 'dalma', NULL),
(158, 'Dobermann', 'dobermann', NULL),
(159, 'Dutch Shepherd', 'dutch', NULL),
(160, 'English Cocker', 'cocker', NULL),
(161, 'English Mastiff', 'mastiff', NULL),
(162, 'Eurasier', 'eurasier', NULL),
(163, 'Finnish Spitz', 'fin-spitz', NULL),
(164, 'French Bulldog', 'fr-bulldog', NULL),
(165, 'Great Dane', 'dane', NULL),
(166, 'Whippet', 'whippet', NULL),
(167, 'Greyhound', 'greyhound', NULL),
(168, 'Irish Wolfhound', 'wolfhound', NULL),
(169, 'Jack Russel', 'jack', NULL),
(170, 'Kangal', 'kangal', NULL),
(171, 'Keeshond', 'keeshond', NULL),
(172, 'Kelpie', 'kelpie', NULL),
(173, 'Komondor', 'komon', NULL),
(174, 'Laekenois Belgian Shepherd', 'laekenois', NULL),
(175, 'Leonberger', 'leon', NULL),
(176, 'Lhasa Apso', 'lhasa', NULL),
(177, 'Maltese dog', 'malt', NULL),
(178, 'Newfoundland', 'newfie', NULL),
(179, 'Northern Inuit', 'north-in', NULL),
(180, 'Norwegian Elkhound', 'norwe', NULL),
(181, 'Pekingese', 'pekinois', NULL),
(182, 'Pinscher', 'pinsch', NULL),
(183, 'Pomeranian', 'pome', NULL),
(184, 'Poodle', 'poodle', NULL),
(185, 'Pug', 'pug', NULL),
(186, 'Pyrenean Mountain Dog', 'patou', NULL),
(187, 'Rhodesian-Ridgeback', 'rhod', NULL),
(188, 'Rottweiler', 'rott', NULL),
(189, 'Saarloos Wolfdog', 'swd', NULL),
(190, 'Saint-bernard', 'saint', NULL),
(191, 'Saluki', 'saluki', NULL),
(193, 'Schnauzer', 'schnauzer', NULL),
(194, 'Shar Pei', 'sharpei', NULL),
(195, 'Tervueren Belgian Shepherd', 'tervu', NULL),
(196, 'Tibetan Mastiff', 'tib-mastiff', NULL),
(197, 'Weimaraner', 'weim', NULL),
(198, 'Xoloitzcuintli', 'xolo', NULL),
(199, 'Yakutian Laika', 'laika', NULL),
(200, 'Yorkshire Terrier', 'york', NULL),
(201, 'Afghan Hound', 'afghan', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dogbreeds_meta`
--

CREATE TABLE `dogbreeds_meta` (
  `id` int NOT NULL,
  `breed_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dogbreeds_meta`
--

INSERT INTO `dogbreeds_meta` (`id`, `breed_id`, `tag_id`) VALUES
(156, 114, 1),
(157, 114, 4),
(158, 115, 1),
(159, 115, 2),
(160, 116, 1),
(162, 118, 1),
(163, 119, 1),
(164, 119, 6),
(165, 120, 1),
(166, 120, 2),
(167, 121, 1),
(168, 121, 4),
(169, 122, 2),
(170, 122, 3),
(171, 123, 2),
(172, 123, 3),
(173, 124, 2),
(174, 125, 2),
(175, 126, 2),
(176, 127, 4),
(177, 128, 4),
(178, 116, 7),
(179, 118, 7),
(180, 119, 7),
(182, 121, 8),
(183, 120, 7),
(184, 114, 8),
(185, 129, 1),
(186, 129, 2),
(187, 129, 3),
(188, 129, 8),
(189, 130, 4),
(190, 131, 3),
(191, 131, 9),
(192, 131, 10),
(193, 132, 3),
(194, 132, 10),
(195, 133, 2),
(196, 134, 1),
(197, 135, 4),
(198, 135, 11),
(199, 136, 4),
(200, 137, 2),
(201, 138, 2),
(202, 138, 3),
(203, 139, 2),
(204, 140, 2),
(205, 140, 3),
(206, 141, 2),
(207, 142, 5),
(208, 142, 9),
(209, 142, 10),
(210, 143, 3),
(211, 143, 10),
(212, 144, 2),
(213, 145, 4),
(214, 146, 4),
(215, 146, 9),
(216, 147, 3),
(217, 147, 6),
(218, 147, 10),
(219, 148, 3),
(220, 148, 6),
(221, 148, 10),
(222, 149, 4),
(223, 150, 5),
(224, 151, 2),
(225, 152, 5),
(226, 152, 8),
(227, 152, 11),
(228, 153, 1),
(229, 153, 8),
(230, 154, 5),
(231, 154, 11),
(232, 155, 5),
(233, 156, 4),
(234, 156, 5),
(235, 156, 9),
(236, 157, 4),
(237, 158, 3),
(238, 159, 2),
(239, 159, 3),
(240, 160, 4),
(241, 161, 3),
(242, 161, 6),
(243, 161, 10),
(244, 162, 1),
(245, 162, 7),
(246, 163, 1),
(247, 163, 4),
(248, 163, 7),
(249, 164, 5),
(250, 164, 9),
(251, 164, 10),
(252, 165, 3),
(253, 165, 4),
(254, 165, 6),
(255, 166, 4),
(256, 166, 11),
(257, 167, 4),
(258, 167, 11),
(259, 168, 3),
(260, 168, 4),
(261, 168, 6),
(262, 169, 5),
(263, 169, 9),
(264, 170, 2),
(265, 170, 3),
(266, 170, 6),
(267, 170, 10),
(268, 171, 1),
(269, 171, 5),
(270, 171, 7),
(271, 172, 2),
(272, 173, 2),
(273, 173, 11),
(274, 174, 2),
(275, 174, 3),
(276, 175, 6),
(277, 175, 10),
(278, 176, 5),
(279, 177, 5),
(280, 178, 6),
(281, 178, 10),
(282, 179, 1),
(283, 179, 2),
(284, 179, 7),
(285, 180, 1),
(286, 180, 4),
(287, 180, 7),
(288, 181, 5),
(289, 182, 3),
(290, 182, 4),
(291, 182, 5),
(292, 183, 1),
(293, 183, 5),
(294, 184, 4),
(295, 184, 5),
(296, 185, 5),
(297, 185, 10),
(298, 186, 2),
(299, 186, 6),
(300, 186, 10),
(301, 187, 4),
(302, 187, 11),
(303, 188, 3),
(304, 188, 10),
(305, 189, 1),
(306, 189, 2),
(307, 190, 3),
(308, 190, 6),
(309, 190, 10),
(310, 191, 4),
(311, 191, 11),
(314, 193, 4),
(315, 193, 9),
(316, 194, 1),
(317, 194, 8),
(318, 194, 10),
(319, 195, 2),
(320, 195, 3),
(321, 196, 2),
(322, 196, 3),
(323, 196, 10),
(324, 197, 4),
(325, 198, 11),
(326, 199, 1),
(327, 199, 7),
(328, 200, 5),
(329, 200, 9),
(330, 201, 4),
(331, 201, 11),
(332, 176, 8),
(333, 181, 8),
(334, 196, 8);

-- --------------------------------------------------------

--
-- Table structure for table `dogtags`
--

CREATE TABLE `dogtags` (
  `tag_id` int NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dogtags`
--

INSERT INTO `dogtags` (`tag_id`, `name`) VALUES
(1, 'Primitives'),
(2, 'Shepherds'),
(3, 'Watchdogs'),
(4, 'Hunting dogs'),
(5, 'Toy dogs'),
(6, 'Gentle giants'),
(7, 'Nordics'),
(8, 'Asians'),
(9, 'Terriers'),
(10, 'Molossers'),
(11, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `data` text NOT NULL,
  `link` text NOT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `name`, `data`, `link`, `Date`) VALUES
(93, 'Jesus', '[\"husky\",\"cwd\",\"tam\",\"lab\",\"shiba\"]', 'odzhyOJXSL', '2021-04-02'),
(94, 'Jesus', '[\"shiba\"]', 'nK3bB3BxSu', '2021-04-02'),
(95, 'Myriam', '[\"aussie\",\"cwd\",\"akita\",\"sam\",\"tam\"]', 'E2OD5vhE54', '2021-04-02'),
(96, 'ah', '[\"akita\",\"tam\"]', 'gBel29FUNT', '2021-04-02'),
(97, 'maliste', '[\"chow\",\"lhasa\",\"pekinois\",\"pinsch\",\"poodle\",\"eurasier\",\"keeshond\",\"husky\",\"pome\",\"jack\",\"malt\"]', 'vT0xTJOXOc', '2021-04-08'),
(98, 'test', '[\"crested\",\"am-akita\"]', 'UJBU1YEQbf', '2021-04-10'),
(99, 'Michel', '[\"dach\",\"coton\",\"corgi\"]', 'ePiNlm5qAB', '2021-04-11'),
(100, 'test', '[\"coton\",\"corgi\",\"dach\",\"bullmastiff\"]', 'gsgbLrfRXm', '2021-04-11'),
(101, 'Michael', '[\"am-akita\",\"dalma\",\"tib-mastiff\",\"bull-terrier\",\"dane\",\"rhod\"]', 'euLsEpXpLk', '2021-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int NOT NULL,
  `breed_id` int NOT NULL,
  `photo_url` text NOT NULL,
  `photo_author` text NOT NULL,
  `author_url` text NOT NULL,
  `dog_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `breed_id`, `photo_url`, `photo_author`, `author_url`, `dog_name`) VALUES
(40, 114, 'doge.jpeg', 'Atsuko Satō', 'http://kabochan.blog.jp/', 'Kabosu'),
(41, 115, 'tarkan.jpg', 'Tahoe Beetschen', 'https://tahoe.be', 'Tarkan'),
(42, 116, 'fox.jpg', 'Tahoe Beetschen', 'https://tahoe.be', 'Fox'),
(44, 118, 'alvan-nee-zUDYWilST8c-unsplash.jpeg', 'Alvan Nee', 'https://unsplash.com/@alvannee', ''),
(45, 119, 'stock-photo-178899969.jpeg', 'aburkowa', 'https://500px.com/p/aburkowa?', 'Lupek'),
(46, 120, 'tahoe-bZYJ89REqIE-unsplash.jpeg', 'Tahoe Beetschen', 'https://tahoe.be', 'Scarlet'),
(47, 121, 'stock-photo-50498814.jpeg', 'Keiko _', 'https://500px.com/p/_keiko_', 'Guma'),
(48, 122, 'anna-dudkova-Khzm9fNyAFw-unsplash.jpeg', 'Anna Dudkova', 'https://unsplash.com/@annadudkova', ''),
(49, 123, 'jayalekshman-sj-UF3T6qtjelM-unsplash.jpeg', 'Jayalekshman SJ', 'https://unsplash.com/@lekshman', ''),
(50, 124, 'martin-blanquer-kiTbB7QZoIU-unsplash.jpeg', 'Martin Blanquer', 'https://unsplash.com/@mblq', ''),
(51, 125, 'Daniela_Thalmann-Ulaj.jpg', 'Daniela Thalmann', 'https://500px.com/p/daniiladisein', 'Ulaj'),
(52, 126, 'tadeusz-lakota-DZpYZq0Dmgs-unsplash.jpeg', 'Tadeusz Lakota', 'https://unsplash.com/@tadekl', 'Max'),
(53, 127, 'samuel-thompson-O6UzDPFH36g-unsplash.jpeg', 'Samuel Thompson', 'https://unsplash.com/@samuelthomps0n', 'Frankie'),
(54, 128, 'helena-lopes-IBz1XwoAEOY-unsplash.jpeg', 'Helena Lopes', 'https://unsplash.com/@wildlittlethingsphoto', ''),
(55, 129, '24lhg8gvwvi61.jpeg', 'u/Ctoretto93', 'https://www.reddit.com/user/Ctoretto93/', 'Hachi'),
(56, 130, 'cocker-américain.jpeg', '', '', ''),
(57, 131, 'martin-dalsgaard-bnbukHzNcGs-unsplash.jpeg', 'Martin Dalsgaard', 'https://unsplash.com/@martin_dalsgaard', ''),
(58, 132, 'stock-photo-51617430.jpeg', 'norman tesch', 'https://500px.com/p/tikaldogos?view=photos', ''),
(59, 133, 'daniel-lincoln-_g30Vjnlhkk-unsplash.jpeg', 'Daniel Lincoln', 'https://unsplash.com/@danny_lincoln', ''),
(60, 134, 'stock-photo-280203527.jpeg', 'Aleksandr Krushelnyckyi  • ', 'https://500px.com/p/krushelss?', ''),
(61, 135, 'kyle-smith-SIZ66vF4FKA-unsplash.jpeg', 'kyle smith', 'https://unsplash.com/@roller1', ''),
(62, 136, 'arun-b-s-sp0U9eW2h7c-unsplash.jpeg', 'Arun B.S', 'https://unsplash.com/@arunbsonline', ''),
(63, 137, 'Bearded_collie_and_a_rope.jpeg', 'Pierre Selim', 'https://commons.wikimedia.org/wiki/User:PierreSelim', ''),
(64, 138, 'stock-photo-211243245.jpeg', 'Kerkhofs Nico', 'https://500px.com/p/kerkhofsnico', 'Ziva'),
(65, 139, 'BergerPicard.jpeg', 'Leanam', '', ''),
(66, 140, 'anastasiia-tarasova-ZIV6-8mgURU-unsplash.jpeg', 'Anastasiia Tarasova', 'https://unsplash.com/@tarasovaanastasiia', ''),
(67, 141, 'stock-photo-104291801.jpeg', 'Tiziana Morello', 'https://500px.com/p/tizianamorello?', 'Maggie'),
(68, 142, 'erik-mclean-_hjnojxSSAI-unsplash.jpeg', 'Erik Mclean', 'https://unsplash.com/@introspectivedsgn', ''),
(69, 143, 'yousef-espanioly-Wgaqx7loF2A-unsplash.jpeg', 'Yousef Espanioly', 'https://unsplash.com/@yespanioly', ''),
(70, 144, 'Briard_fauve.jpeg', 'Birgit Balzer', '', ''),
(71, 145, 'Brittany_Spaniel_standing.jpeg', 'Pharaoh Hound', 'https://commons.wikimedia.org/wiki/User:Pharaoh_Hound', ''),
(72, 146, 'stock-photo-240206341.jpeg', 'Владимир Vinogradov ', 'https://500px.com/vov1977', ''),
(73, 147, 'Dog_Bullmastiff_600.jpeg', '', '', ''),
(74, 148, 'CaneCorsoMale.jpeg', 'Nebuno', '', ''),
(75, 149, 'courtney-mihaka-NCAwquMck40-unsplash.jpeg', 'Courtney Mihaka', 'https://unsplash.com/@courtneytia', ''),
(76, 150, 'tamara-bellis-UI7xouE1dpw-unsplash.jpeg', 'Tamara Bellis', 'https://unsplash.com/@tamarabellis', ''),
(77, 151, 'stock-photo-126204023.jpeg', 'Petr Stanislav Gaňa', 'https://500px.com/p/petrgana', ''),
(78, 152, 'photo-1592432360900-db45ed919dfe.jpeg', 'Katie Bernotsky', 'https://unsplash.com/@pupscruffs', 'Finn'),
(79, 153, 'lukasz-rawa-stqcemI22qo-unsplash.jpeg', 'Łukasz Rawa', 'https://unsplash.com/@lukasz_rawa', ''),
(80, 154, 'alvan-nee-egnAFVYS_h0-unsplash.jpeg', 'Alvan Nee', 'https://unsplash.com/@alvannee', ''),
(81, 155, '2560px-Coton_de_Tulear_Puppy-5899.jpeg', 'Slaunger', '', ''),
(82, 156, 'kojirou-sasaki-MwsVNzhFD_o-unsplash.jpeg', 'Kojirou Sasaki', 'https://unsplash.com/@chelsea777', ''),
(83, 157, 'craventure-media-8PedpXO0mUU-unsplash.jpeg', 'Craventure Media', 'https://unsplash.com/@craventure', ''),
(84, 158, 'stock-photo-263812781.jpeg', 'Frank Elbe', 'https://500px.com/p/frank3000?', ''),
(85, 159, 'stock-photo-160443255.jpeg', 'Alex', 'https://500px.com/alolsno', 'Hedda'),
(86, 160, 'max-ducourneau-ylTPNeXPzws-unsplash.jpeg', 'Max Ducourneau', 'https://unsplash.com/@maxdcrn', ''),
(87, 161, 'stock-photo-69755061.jpeg', 'Ramonica', 'https://500px.com/p/ramonica?', 'Ramona'),
(88, 162, 'judi-neumeyer-lRn9q3rOMYY-unsplash.jpg', 'Judi Neumeyer', 'https://unsplash.com/@jneumeyer', ''),
(89, 163, 'FINNISH_SPITZ.jpeg', 'Karelgerda', '', ''),
(90, 164, 'martin-dalsgaard-dIm7tkWqpaE-unsplash.jpeg', 'Martin Dalsgaard', 'https://unsplash.com/@martin_dalsgaard', ''),
(91, 165, 'marcelo-pinto-RN6iJWoyGsA-unsplash.jpeg', 'Marcelo Pinto', 'https://unsplash.com/@elmundodemarx', ''),
(92, 166, 'mitchell-orr-A-P1b--NacQ-unsplash.jpeg', 'Mitchell Orr', 'https://unsplash.com/@mitchorr', ''),
(93, 167, 'stock-photo-283424909.jpeg', 'Jose Pedroso', 'https://500px.com/StckTour', ''),
(94, 168, 'stock-photo-236028199.jpeg', 'Kamila Svobodova ', 'https://500px.com/KamilaSvobodova', ''),
(95, 169, 'rob-fuller-u9GEK0AuOU8-unsplash.jpeg', 'Rob Fuller', 'https://unsplash.com/@robfuller', ''),
(96, 170, 'stock-photo-147676349.jpeg', 'Elif Gokce', 'https://500px.com/p/elfproject?', ''),
(97, 171, 'stock-photo-245599567.jpeg', 'Andreas Minerbi', 'https://500px.com/MrMinerbi', 'Harry'),
(98, 172, 'stock-photo-90590081.jpeg', 'Whitney Jane', 'https://500px.com/p/whitneyjane?view=photos', ''),
(99, 173, 'Komondor_delvin.jpeg', 'Nikki68', 'https://ru.wikipedia.org/wiki/User:Nikki68', ''),
(100, 174, 'stock-photo-1011340073.jpeg', 'Hans Zitzler', 'https://500px.com/Hans_Zitzler', ''),
(101, 175, 'stephanie-lucero-RKlmD8HiFhs-unsplash.jpeg', 'Stephanie Lucero', 'https://unsplash.com/@singsun', ''),
(102, 176, 'gilson-gomes-0Dn7IHmspiM-unsplash.jpeg', 'Gilson Gomes', 'https://unsplash.com/@gilsongomes', ''),
(103, 177, 'Emily_Maltese.jpeg', 'Ann', 'https://www.flickr.com/photos/75976921@N00', ''),
(104, 178, 'stock-photo-1029826953.jpeg', 'Ferdinand Šteharnik', 'https://500px.com/steharnikf', ''),
(105, 179, 'chien-inuit-du-nord-14084.jpeg', '', '', ''),
(106, 180, 'stock-photo-273699951.jpeg', 'Wendy', 'https://500px.com/p/wendy74ca?', 'Luna'),
(107, 181, 'vianney-cahen-R5M3V_rldbo-unsplash.jpeg', 'Vianney CAHEN', 'https://unsplash.com/@number313', 'Hamlet'),
(108, 182, 'karolina-wv-49geUfYKMvM-unsplash.jpeg', 'Karolina Wv', 'https://unsplash.com/@karolinawv', 'Zoozia'),
(109, 183, 'julia-edbrooke-IlS0ZaONRsU-unsplash.jpg', 'Julia Edbrooke', 'https://unsplash.com/@jewelsiepoo', ''),
(110, 184, 'fredrik-ohlander-tGBRQw52Thw-unsplash.jpeg', 'Fredrik Öhlander', 'https://unsplash.com/@fredrikohlander', ''),
(111, 185, 'marcus-cramer-uCuLFCJbtHs-unsplash.jpeg', 'Marcus Cramer', 'https://unsplash.com/@marcuslcramer', 'Doug'),
(112, 186, 'eddy-billard-AI_UTNl6HlE-unsplash.jpeg', 'Eddy Billard', 'https://unsplash.com/@eddybllrd', ''),
(113, 187, 'kealan-burke-DEsQMs67XU8-unsplash.jpeg', 'Kealan Burke', 'https://unsplash.com/@kealanpatrick', ''),
(114, 188, 'stock-photo-242258793.jpeg', 'Steve Howell', 'https://500px.com/stevehowellphotography', ''),
(115, 189, 'stock-photo-192148339.jpeg', 'Martin Janecek', 'https://500px.com/p/mjanecek-photo?', 'Diego'),
(116, 190, 'stephanie-cook-uoFa3DDrd90-unsplash.jpeg', 'Stephanie Cook', 'https://unsplash.com/@stephtcook', ''),
(117, 191, 'artem-sapegin-Ugg-EIfzy0c-unsplash.jpeg', 'Artem Sapegin', 'https://unsplash.com/@sapegin', ''),
(119, 193, 'wade-lambert-L_TQCKg4_aQ-unsplash.jpeg', 'Wade Lambert', 'https://unsplash.com/@wade_lambert', 'Bingo'),
(120, 194, 'stock-photo-176314045.jpeg', 'Yanvarina Robbins', 'https://500px.com/Yanvarina', ''),
(121, 195, 'stock-photo-240210399.jpeg', 'Hélène Chd', 'https://500px.com/diabolomenthe18', ''),
(122, 196, 'The_Tibetan_Mastiff_at_our_Hostel.jpeg', 'timquijano', 'https://www.flickr.com/people/7527824@N04', ''),
(123, 197, 'atanas-teodosiev-jojBcoWTHW8-unsplash.jpeg', 'Atanas Teodosiev', 'https://unsplash.com/@teodosiev', 'Hannah'),
(124, 198, 'stock-photo-1019368807.jpeg', 'Борис Цепко', 'https://500px.com/boryagin1', ''),
(125, 199, 'stock-photo-1021173931.jpeg', 'Adam Doroziński', 'https://500px.com/p/adamdpl', 'Ghost'),
(126, 200, 'justin-veenema-Ku3igYrMhD4-unsplash.jpeg', ' Justin Veenema', 'https://unsplash.com/@justinveenema', ''),
(127, 201, 'julio-bernal-WLGx0fKFSeI-unsplash-sm.jpg', 'Julio Bernal', 'https://unsplash.com/@jbernals', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogbreeds`
--
ALTER TABLE `dogbreeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dogbreeds_meta`
--
ALTER TABLE `dogbreeds_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `breed_id` (`breed_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `dogtags`
--
ALTER TABLE `dogtags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD UNIQUE KEY `breed_id` (`breed_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogbreeds`
--
ALTER TABLE `dogbreeds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `dogbreeds_meta`
--
ALTER TABLE `dogbreeds_meta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=335;

--
-- AUTO_INCREMENT for table `dogtags`
--
ALTER TABLE `dogtags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dogbreeds_meta`
--
ALTER TABLE `dogbreeds_meta`
  ADD CONSTRAINT `dogbreeds_meta_ibfk_1` FOREIGN KEY (`breed_id`) REFERENCES `dogbreeds` (`id`),
  ADD CONSTRAINT `dogbreeds_meta_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `dogtags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`breed_id`) REFERENCES `dogbreeds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
