-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 31 mars 2021 à 08:27
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `connection`
--

DROP TABLE IF EXISTS `connection`;
CREATE TABLE IF NOT EXISTS `connection` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `connection`
--

INSERT INTO `connection` (`id`, `from_id`, `to_id`, `created_at`, `updated_at`) VALUES
(2, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contenuplaylist`
--

DROP TABLE IF EXISTS `contenuplaylist`;
CREATE TABLE IF NOT EXISTS `contenuplaylist` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `playlist_id` bigint(20) NOT NULL,
  `chanson_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contenuplaylist`
--

INSERT INTO `contenuplaylist` (`id`, `playlist_id`, `chanson_id`, `created_at`, `updated_at`) VALUES
(60, 5, 1, NULL, NULL),
(61, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `chanson_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `like`
--

INSERT INTO `like` (`id`, `user_id`, `chanson_id`, `created_at`, `updated_at`) VALUES
(18, 3, 2, NULL, NULL),
(17, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '2021_03_10_091311_create_like_table', 1),
(20, '2014_10_12_000000_create_users_table', 1),
(21, '2014_10_12_100000_create_password_resets_table', 1),
(22, '2019_08_19_000000_create_failed_jobs_table', 1),
(23, '2021_01_21_073100_create_songs_table', 1),
(24, '2021_02_04_091108_create_connection_table', 1),
(26, '2021_03_16_145250_create_playlist_table', 2),
(27, '2021_03_16_162658_create_contenuplaylist_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `playlist`
--

INSERT INTO `playlist` (`id`, `nom`, `url_image`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Test playlist', '/uploads/1/InrDN2d7ZBPCjWyqT0ffhxwrfKQC2wSyhkBJhiqE.jpg', 1, '2021-03-16 14:49:10', '2021-03-16 14:49:10'),
(4, 'test2', '/uploads/1/vAPg7ef1YEqNodpSltIKDjQahHi5z3OKG8QBxISx.jpg', 1, '2021-03-26 12:54:46', '2021-03-26 12:54:46'),
(5, 'Summer 2k21', '/uploads/1/8QUdRaiIEYvkNyuZXan63Y8a5iMJwxyveHpML6vZ.png', 1, '2021-03-26 14:40:11', '2021-03-26 14:40:11'),
(6, 'RAP', '/uploads/3/wGxRoJ0XOJMMu6rgCytN49hPmbzaO5hN6X16Axwt.png', 3, '2021-03-30 07:38:30', '2021-03-30 07:38:30');

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `votes` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`id`, `title`, `url`, `votes`, `user_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Old Town Road', 'song/1/RADChvjaSU6yyEmnKgoUorNWkHrirviMfIf5GrLt.webm', 0, 1, '/uploads/1/d8j8GyQDSkXwo0IeB8uIxZbnDx59XKbDgB0iDlWs.jpg', '2021-03-16 12:42:02', '2021-03-16 12:42:02'),
(2, 'Shape of you', 'song/1/yIDcA3UDUMLUp5GeN1xdZNY3eBfD6uWV1tpKSZMj.mpga', 0, 1, '/uploads/1/3hTQtVcZfegEJZYGD27OIz5JH3DxVkfDO8ki2W2F.jpg', '2021-03-16 12:45:55', '2021-03-16 12:45:55'),
(3, 'Becky G-Shower', 'song/1/CssjmQ9nzPq2zSyEDB5KO2euhSupW7ox9YIvbM7r.mpga', 0, 1, '/uploads/1/x0vWxNO8swMlI3VuCVmO7Mjcuk5CDQYvtccHlDSD.jpg', '2021-03-16 12:47:08', '2021-03-16 12:47:08'),
(4, 'Old Town Roatestd', 'song/1/u9BxV5g9q7kioK1TTr6NtnKljChzy4x9lSC4alsz.mpga', 0, 1, '/uploads/1/ePcBkYZ8u9X6vNWiySQU1OABJPlPLuSeN6UdRYzA.png', '2021-03-22 12:42:04', '2021-03-22 12:42:04'),
(5, 'GDK - La pregunta', 'song/3/EzE1OZu54A6I6FvTeaAyAiTK2eNBH0849uVO9PsT.mpga', 0, 3, '/uploads/3/9MkIXOr8gNgqDlslTX865ccRCKqnTRIdDNKH2uqC.png', '2021-03-30 06:49:26', '2021-03-30 06:49:26'),
(6, 'test', 'song/3/79s1itaR6ly7QT0XIUxJaMiZNEu1fSOZF89NAmvn.mpga', 0, 3, '/uploads/3/NeGaeagCMUtn6p4kN0tuIryAAx2NNstuJrnMiiD0.png', '2021-03-30 10:34:27', '2021-03-30 10:34:27');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imgprofil` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `description`, `imgprofil`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Louis Boulanger', '<i>testtest</i>', NULL, 'louisbal70@gmail.com', NULL, '$2y$10$x382Khu9JfYkpa1EtFkY6eTyKkXqwufoJCzWOpnzQn/tmnhKhOUYi', NULL, '2021-03-15 08:25:26', '2021-03-22 12:41:50'),
(2, 'Louis Baker', NULL, NULL, 'loulou@gmail.com', NULL, '$2y$10$VdjeurTGsoFQCJbmb9vrnekgSikxZsV4s4VxkjzhF.JZUKzfuHgZq', NULL, '2021-03-15 12:07:27', '2021-03-15 12:07:27'),
(3, 'Loubal71', '<i>test</i>', NULL, 'loulou123@gmail.com', NULL, '$2y$10$sK/31qicFuw0c24OGbTebOIolTOgtMyBTehM5XsrzRmisy1VOiKFO', NULL, '2021-03-30 05:41:31', '2021-03-30 09:11:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
