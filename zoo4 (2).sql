-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2025 a las 16:21:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zoo4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animal`
--

CREATE TABLE `animal` (
  `animal_id` int(10) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `etat` varchar(50) NOT NULL,
  `race_id` int(10) NOT NULL,
  `habitat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `animal`
--

INSERT INTO `animal` (`animal_id`, `prenom`, `etat`, `race_id`, `habitat_id`) VALUES
(3, 'Georges', 'bone', 17, 7),
(4, 'George', 'bone', 9, 8),
(5, 'Daisyielle', 'ok', 21, 8),
(11, 'edus', 'fs', 17, 12),
(16, 'bis', 'fs', 40, 7),
(18, 'Daisie', 'ok', 40, 8),
(19, 'cerdi', 'ok', 11, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assoimage_animal`
--

CREATE TABLE `assoimage_animal` (
  `animal_id` int(10) NOT NULL,
  `image_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assoimage_habitat`
--

CREATE TABLE `assoimage_habitat` (
  `habitat_id` int(10) NOT NULL,
  `image_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avis`
--

CREATE TABLE `avis` (
  `avis_id` int(10) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `commentaire` varchar(50) NOT NULL,
  `isvisible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `avis`
--

INSERT INTO `avis` (`avis_id`, `pseudo`, `commentaire`, `isvisible`) VALUES
(4, 'Jean-Marc', 'Fascinant, avec des installations impeccables!', 1),
(5, 'Jules', 'Zoo impressionnant, parfait pour les enfants.', 1),
(6, 'Eduardo', 'Espaces vastes et bien entretenus', 1),
(7, 'Valérie', 'Zoo respectant l\'habitat naturel des animaux.', 1),
(8, 'Hervé', 'Spectacles captivants et soigneurs passionnés.', 1),
(10, 'Aurélien', 'Zoo bien organisé.', 1),
(11, 'Thomas', 'Aires de pique-nique agréables pour se détendre.', 1),
(12, 'David', 'Diversité incroyable d\'animaux !', 1),
(13, 'Hugues', 'Panneaux informatifs pour apprendre en s\'amusant.', 1),
(14, 'Anne', 'Visite guidée enrichissante !', 1),
(15, 'Marc', 'Les aires de restauration étaient bondées...', 1),
(16, 'Marco', 'Très bon zoo ! A refaire !', 1),
(17, 'Jules', 'Zoo au top !', 1),
(18, 'Maikel', 'tres bien', 1),
(19, 'junior', 'Tres bien ', 1),
(24, 'maikel', 'bien', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitat`
--

CREATE TABLE `habitat` (
  `habitat_id` int(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `commentaire_habitat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitat`
--

INSERT INTO `habitat` (`habitat_id`, `nom`, `description`, `commentaire_habitat`) VALUES
(7, 'Enclos pour zèbres', 'Enclos pour zèbres', 'fsfsf'),
(8, 'Enclos pour lion', 'restauration', ''),
(10, 'Visite guidée', 'gt', 'fsfsf'),
(12, 'Visite guidéeghf', 'sdf', 'fsfs'),
(13, 'Paradas', 'restauration', ''),
(14, 'klaus', 'bus touristique', ''),
(15, 'ed', 'edu', ''),
(16, 'Habitat des oisseaux', 'hábitat pour les oisseaux du zoo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `image_data` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nourriture_animal`
--

CREATE TABLE `nourriture_animal` (
  `nourriture_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `nourriture` varchar(300) NOT NULL,
  `heure` time NOT NULL,
  `quantite` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `race`
--

CREATE TABLE `race` (
  `race_id` int(10) NOT NULL,
  `abel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `race`
--

INSERT INTO `race` (`race_id`, `abel`) VALUES
(1, 'Zèbre de Quagga'),
(2, 'Zèbre de Grévy'),
(3, 'Crocodile de Johnston'),
(4, 'Chimpanzé'),
(5, 'Gorille'),
(6, 'Orang outan'),
(7, 'Cougard'),
(8, 'Leopard'),
(9, 'Lion'),
(10, 'Tigre'),
(11, 'Ours'),
(12, 'Panthère'),
(13, 'Hypo_nain'),
(14, 'Hippopotame'),
(15, 'Manchot'),
(16, 'Phoque'),
(17, 'Aigle'),
(18, 'Faucon'),
(19, 'Calao'),
(20, 'Perroquet'),
(21, 'Gris du Gabon'),
(22, 'Pygargue a tète blanche'),
(23, 'Ibis'),
(25, 'Loup'),
(26, 'Éléphant'),
(27, 'Goeldi'),
(28, 'Singe'),
(29, 'Toucan'),
(30, 'Rénard'),
(31, 'Marabout'),
(32, 'Hibou'),
(33, 'Girafe'),
(34, 'Camaleon'),
(35, 'Boa emeraude'),
(36, 'Iguane'),
(37, 'Lézard'),
(38, 'Python'),
(39, 'Bison'),
(40, 'Buffle'),
(41, 'Chèvre montagne'),
(42, 'Gazelle'),
(43, 'Oryx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rapport_veterinaire`
--

CREATE TABLE `rapport_veterinaire` (
  `rapport_veterinaire_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `detail` varchar(50) NOT NULL,
  `etatAvis` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `animal_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rapport_veterinaire`
--

INSERT INTO `rapport_veterinaire` (`rapport_veterinaire_id`, `date`, `detail`, `etatAvis`, `username`, `animal_id`) VALUES
(5, '2024-08-09', 'teres', 'rres', 'edu@gmail.com', 11),
(6, '2024-09-20', 'fr', 'gt', 'edu@gmail.com', 4),
(7, '2024-09-20', 'gh', 'fgf', 'edu@gmail.com', 4),
(8, '2024-10-16', 'Très en forme', 'bien', 'Julien', 4),
(9, '2024-10-16', 'Très en forme', ' En très bonne forme aujourd\'hui !', 'Julien', 4),
(10, '2024-10-16', 'pas tres bien', 'Pas très bien.', 'Julien', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `role_id` int(10) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`role_id`, `label`) VALUES
(1, 'veto'),
(3, 'admin'),
(4, 'employe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE `service` (
  `service_id` int(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `service`
--

INSERT INTO `service` (`service_id`, `nom`, `description`) VALUES
(8, 'Parades', 'Profitez de notre parade tous les jours à 16h !'),
(17, 'Visite en traines', 'Découvrez le zoo facilement grâce à notre train !'),
(18, 'Visite guidé', 'Découvrez le zoo grâce à notre guide gratuit !'),
(21, 'ed', 'restauration'),
(23, 'klaus', 'habitat aménagé pour les éléphants'),
(24, 'Paradasf', 'habitat aménagé pour les éléphants');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id_setting` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `donnee` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id_setting`, `nom`, `donnee`) VALUES
(1, 'ouvertureZoo', '11:55'),
(2, 'fermetureZoo', '19:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `utilisateur`
--

CREATE TABLE `utilisateur` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `utilisateur`
--

INSERT INTO `utilisateur` (`username`, `password`, `nom`, `prenom`, `role_id`) VALUES
('edu', '1234567890', '', '', 1),
('edu@gmail.com', 'Abc-9862246267', 'defg', 'deffgh', 1),
('eduardo@gmail.com', 'Edu-633333', 'Jarry', 'Hermosilla', 1),
('hehermosilla@gmail.com ', 'eduardoHerm', '', '', 4),
('jose', 'joseadministrateur', 'ARCADIA', 'José', 3),
('Julien', 'veterinaireveto', 'SIMON', 'Julien', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `race_id` (`race_id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Indices de la tabla `assoimage_animal`
--
ALTER TABLE `assoimage_animal`
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indices de la tabla `assoimage_habitat`
--
ALTER TABLE `assoimage_habitat`
  ADD KEY `habitat_id` (`habitat_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Indices de la tabla `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`avis_id`);

--
-- Indices de la tabla `habitat`
--
ALTER TABLE `habitat`
  ADD PRIMARY KEY (`habitat_id`);

--
-- Indices de la tabla `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indices de la tabla `nourriture_animal`
--
ALTER TABLE `nourriture_animal`
  ADD PRIMARY KEY (`nourriture_id`);

--
-- Indices de la tabla `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`race_id`);

--
-- Indices de la tabla `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  ADD PRIMARY KEY (`rapport_veterinaire_id`),
  ADD KEY `username` (`username`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indices de la tabla `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `avis`
--
ALTER TABLE `avis`
  MODIFY `avis_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `habitat`
--
ALTER TABLE `habitat`
  MODIFY `habitat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nourriture_animal`
--
ALTER TABLE `nourriture_animal`
  MODIFY `nourriture_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  MODIFY `rapport_veterinaire_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`race_id`) REFERENCES `race` (`race_id`),
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`habitat_id`);

--
-- Filtros para la tabla `assoimage_animal`
--
ALTER TABLE `assoimage_animal`
  ADD CONSTRAINT `assoimage_animal_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`),
  ADD CONSTRAINT `assoimage_animal_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`);

--
-- Filtros para la tabla `assoimage_habitat`
--
ALTER TABLE `assoimage_habitat`
  ADD CONSTRAINT `assoimage_habitat_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitat` (`habitat_id`),
  ADD CONSTRAINT `assoimage_habitat_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`);

--
-- Filtros para la tabla `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  ADD CONSTRAINT `rapport_veterinaire_ibfk_1` FOREIGN KEY (`username`) REFERENCES `utilisateur` (`username`),
  ADD CONSTRAINT `rapport_veterinaire_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`animal_id`);

--
-- Filtros para la tabla `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
