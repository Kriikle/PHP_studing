-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 22 2022 г., 00:56
-- Версия сервера: 5.7.38
-- Версия PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `isSendingPush` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admins_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `isSendingPush`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 1, 7, NULL, NULL),
(7, 1, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(5, 'PC Games', 'Wow games!', '2022-09-21 15:44:54', '2022-09-21 15:44:54'),
(6, 'XBOX Games', 'Wow games!', '2022-09-21 15:45:04', '2022-09-21 15:45:04');

-- --------------------------------------------------------

--
-- Структура таблицы `category_product`
--

CREATE TABLE IF NOT EXISTS `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_product_category_id_foreign` (`category_id`),
  KEY `category_product_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`) VALUES
(1, 5, 5),
(2, 5, 2),
(4, 6, 5),
(7, 5, 1),
(8, 5, 8),
(9, 6, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(30, '2014_10_12_000000_create_users_table', 1),
(31, '2014_10_12_100000_create_password_resets_table', 1),
(32, '2019_08_19_000000_create_failed_jobs_table', 1),
(33, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(34, '2022_09_19_095358_create_products_table', 1),
(35, '2022_09_19_100155_create_categories_table', 1),
(36, '2022_09_19_102611_create_category_product_table', 1),
(37, '2022_09_19_110100_create_orders_table', 1),
(38, '2022_09_21_071015_create_admins_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prize` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `status`, `prize`, `created_at`, `updated_at`) VALUES
(22, 7, 1, 'consideration', 1222, '2022-09-21 18:27:09', '2022-09-21 18:27:09'),
(23, 7, 1, 'consideration', 1222, '2022-09-21 18:32:02', '2022-09-21 18:32:02');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('bonykirill@mail.ru', '$2y$10$0YlOe0tDa5RuoniCouvt/OedguqkeskZArX2SgmMX7FL5djLe2FL2', '2022-09-20 18:09:07');

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prize` bigint(20) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `prize`, `img`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Warcraft', 1222, '1_productLogo.png', 'Warcraft is a franchise of video games, novels, and other media created by Blizzard Entertainment. The series is made up of five core games: Warcraft: Orcs & Humans, Warcraft II: Tides of Darkness, Warcraft III: Reign of Chaos, World of Warcraft, and Hearthstone. The first three of these core games are in the real-time strategy genre, where opposing players command virtual armies in battle against each other or a computer-controlled enemy. The fourth and best-selling title of the franchise is a massively multiplayer online role-playing game (MMORPG), where players control their character and interact with each other in a virtual world. Warcraft is one of the highest-grossing video game franchises of all time, having grossed $11.2 billion in lifetime revenue, as of 2018.', '2022-09-20 15:50:23', '2022-09-21 17:50:10'),
(2, 'RocetLeague', 897, '2_productLogo.png', 'Rocket League — аркадная гоночная игра в жанре футбола, разработанная и изданная компанией Psyonix для Windows, PlayStation 4. Выход игры состоялся 7 июля 2015 года для платформ Windows и PlayStation 4. В 2016 году игра выпускается для Xbox One и для Linux и macOS, но поддержка последних была прекращена в 2020 году.', '2022-09-20 16:51:47', '2022-09-21 17:51:09'),
(4, 'Witcher', 1112, '4_productLogo.png', 'Wither is good', '2022-09-21 11:29:33', '2022-09-21 17:50:17'),
(5, 'Overwatch', 1221, '5_productLogo.png', 'Fight', '2022-09-21 13:50:47', '2022-09-21 17:50:26'),
(6, 'Call of duty black ops', 1577, '6_productLogo.png', 'Games is games', '2022-09-21 16:47:29', '2022-09-21 17:50:37'),
(7, 'Batman', 1312, '7_productLogo.png', 'Games is games', '2022-09-21 16:48:50', '2022-09-21 17:50:43'),
(8, 'Deus ex', 799, '8_productLogo.png', 'Wow games!', '2022-09-21 16:49:34', '2022-09-21 17:50:53'),
(9, 'dishonored 2', 699, '9_productLogo.png', 'Wow games!', '2022-09-21 17:31:50', '2022-09-21 17:31:50');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Admin', 'Admin@adm.com', NULL, '$2y$10$s7dmcpcAL7BL/ze.44xKV.K..5GiqrewIUW1Bl9FxRImCP2CC7tF6', NULL, '2022-09-21 18:07:29', '2022-09-21 18:07:29'),
(7, 'Kirill', 'kirill.laikenen@yandex.ru', '2022-09-21 18:22:13', '$2y$10$mtmxgWjzLJkK7xsnv5zuX.py6S8NSSBzRc90U6JCNiMgdPVU0Z8T6', NULL, '2022-09-21 18:21:20', '2022-09-21 18:22:13');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
