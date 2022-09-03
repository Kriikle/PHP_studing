-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 03 2022 г., 19:08
-- Версия сервера: 5.7.38
-- Версия PHP: 8.1.5


--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messege`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `Blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `User_id` int(11) NOT NULL,
  `Name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`Blog_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(62) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pasword` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `City` varchar(62) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `Login` (`Login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `messege`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `messege_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `users` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

