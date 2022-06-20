-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-06-2022 a las 23:26:22
-- Versión del servidor: 8.0.29-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `PoligonoSur`
--
CREATE DATABASE IF NOT EXISTS `PoligonoSur` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `PoligonoSur`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `created_at`, `updated_at`) VALUES
(1, '2022-06-20 01:52:25', '2022-06-20 01:52:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classroom`
--

DROP TABLE IF EXISTS `classroom`;
CREATE TABLE `classroom` (
  `id` int NOT NULL,
  `class` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `classroom`
--

INSERT INTO `classroom` (`id`, `class`, `created_at`, `updated_at`) VALUES
(2, 'A121', '2022-06-20 01:40:33', '2022-06-20 01:40:33'),
(3, 'A122', '2022-06-20 01:40:33', '2022-06-20 01:40:33'),
(4, 'A123', '2022-06-20 01:40:33', '2022-06-20 01:40:33'),
(5, 'A124', '2022-06-20 01:40:33', '2022-06-20 01:40:33'),
(6, 'A125', '2022-06-20 01:40:33', '2022-06-20 01:40:33'),
(7, 'A126', '2022-06-20 01:40:33', '2022-06-20 01:40:33'),
(8, 'A127', '2022-06-20 01:40:33', '2022-06-20 01:40:33'),
(9, 'A128', '2022-06-20 01:40:33', '2022-06-20 01:40:33'),
(10, 'A129', '2022-06-20 01:40:33', '2022-06-20 01:40:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int NOT NULL,
  `issue` int NOT NULL,
  `comment` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `author` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `issue`, `comment`, `author`, `created_at`, `updated_at`) VALUES
(1, 2, 'Ya hemos encontrado más cables', 1, '2022-06-20 16:45:47', '2022-06-20 16:45:47');

--
-- Disparadores `comment`
--
DROP TRIGGER IF EXISTS `Comment-Issue-Insert`;
DELIMITER $$
CREATE TRIGGER `Comment-Issue-Insert` AFTER INSERT ON `comment` FOR EACH ROW UPDATE issues 
SET issues.updated_at = new.created_at
WHERE issues.id = new.issue
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Comment-Issue-Update`;
DELIMITER $$
CREATE TRIGGER `Comment-Issue-Update` AFTER UPDATE ON `comment` FOR EACH ROW UPDATE issues 
SET issues.updated_at = new.updated_at
WHERE issues.id = new.issue
OR issues.id = old.issue
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conditions`
--

DROP TABLE IF EXISTS `conditions`;
CREATE TABLE `conditions` (
  `id` int NOT NULL,
  `condition` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `conditions`
--

INSERT INTO `conditions` (`id`, `condition`, `created_at`, `updated_at`) VALUES
(1, 'Nuevo', '2022-06-20 01:30:23', '2022-06-20 01:30:23'),
(2, 'En Proceso', '2022-06-20 01:30:23', '2022-06-20 01:30:23'),
(3, 'Resuelto', '2022-06-20 01:30:55', '2022-06-20 01:30:55'),
(4, 'Pendiente Cierre', '2022-06-20 01:31:23', '2022-06-20 01:31:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condition_issue`
--

DROP TABLE IF EXISTS `condition_issue`;
CREATE TABLE `condition_issue` (
  `id` int NOT NULL,
  `id_issue` int NOT NULL,
  `id_condition` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `condition_issue`
--

INSERT INTO `condition_issue` (`id`, `id_issue`, `id_condition`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-06-20 16:38:30', '2022-06-20 16:38:30'),
(2, 2, 1, '2022-06-20 16:45:18', '2022-06-20 16:45:18'),
(3, 2, 4, '2022-06-20 16:45:18', '2022-06-20 16:45:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `id` int NOT NULL,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `author` int NOT NULL,
  `classroom` int NOT NULL,
  `id_condition` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `closed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `issues`
--

INSERT INTO `issues` (`id`, `title`, `description`, `author`, `classroom`, `id_condition`, `created_at`, `updated_at`, `closed_at`) VALUES
(1, 'Insuficiente memoria RAM', 'Los equipos van demasiado lentos, algunos incluso tienen 4Gb de RAM, hace falta ponerles más', 1, 10, 1, '2022-06-20 16:38:30', '2022-06-20 16:45:47', NULL),
(2, 'Faltan cables para crimpado', 'Se va a enseñar a los alumnos a crimpar pero no hay cables', 1, 2, 4, '2022-06-20 16:45:18', '2022-06-20 22:28:32', '2022-06-20 22:28:32');

--
-- Disparadores `issues`
--
DROP TRIGGER IF EXISTS `Issue-Condition-Insert`;
DELIMITER $$
CREATE TRIGGER `Issue-Condition-Insert` AFTER INSERT ON `issues` FOR EACH ROW INSERT INTO condition_issue (id_issue, id_condition, created_at, updated_at)
VALUES (new.id, new.id_condition, new.created_at, new.created_at)
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Issue-Condition-Update`;
DELIMITER $$
CREATE TRIGGER `Issue-Condition-Update` BEFORE UPDATE ON `issues` FOR EACH ROW IF new.id_condition != old.id_condition THEN
INSERT INTO condition_issue (id_issue, id_condition, created_at, updated_at)
VALUES (new.id, new.id_condition, new.created_at, new.created_at);
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int NOT NULL,
  `state` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Pendiente Confirmar', '2022-06-20 01:32:12', '2022-06-20 01:32:12'),
(2, 'Confirmado', '2022-06-20 01:32:12', '2022-06-20 01:32:12'),
(3, 'De Baja', '2022-06-20 01:32:12', '2022-06-20 01:32:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `telephone` int NOT NULL,
  `warning` tinyint(1) NOT NULL DEFAULT '1',
  `id_state` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `date_birth`, `telephone`, `warning`, `id_state`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Carmen Rufo', 'carmen.rufo.palomo.al@iespoligonosur.org', NULL, '$2y$10$Irgyw/W8KOqxtTK1/RNHwO.XPUSxj2ag6b.7XEIXKyEFShU7mbLya', '1999-09-22', 603638253, 1, 2, 'H3NDvjBCCoMk1tKlLsKdc3qYbBXLknWLPQ5uaggE0SdHKy6ZVPPJ2I32SOQR', '2022-06-20 01:33:04', '2022-06-20 15:19:54'),
(2, 'Manolo Perez', 'manolo.perez.pr@iespoligonosur.org', NULL, '$2y$10$VxIs6MbYuHdhldjSayNckeiAsFV48Pxb5K6p/gmmNqOv8RSeuzm0O', '1995-02-08', 601602603, 1, 3, NULL, '2022-06-20 15:44:59', '2022-06-20 15:49:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidencia` (`issue`),
  ADD KEY `autor` (`author`),
  ADD KEY `autor_2` (`author`);

--
-- Indices de la tabla `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `condition_issue`
--
ALTER TABLE `condition_issue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idIncidencia` (`id_issue`),
  ADD KEY `idEstado` (`id_condition`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`author`),
  ADD KEY `aula` (`classroom`),
  ADD KEY `id_condition` (`id_condition`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id_state` (`id_state`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `conditions`
--
ALTER TABLE `conditions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `condition_issue`
--
ALTER TABLE `condition_issue`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`issue`) REFERENCES `issues` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`author`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `condition_issue`
--
ALTER TABLE `condition_issue`
  ADD CONSTRAINT `condition_issue_ibfk_1` FOREIGN KEY (`id_issue`) REFERENCES `issues` (`id`),
  ADD CONSTRAINT `condition_issue_ibfk_2` FOREIGN KEY (`id_condition`) REFERENCES `conditions` (`id`);

--
-- Filtros para la tabla `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_ibfk_2` FOREIGN KEY (`classroom`) REFERENCES `classroom` (`id`),
  ADD CONSTRAINT `issues_ibfk_3` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `issues_ibfk_4` FOREIGN KEY (`id_condition`) REFERENCES `conditions` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_state`) REFERENCES `states` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
