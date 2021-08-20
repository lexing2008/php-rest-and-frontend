-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 20 2021 г., 21:24
-- Версия сервера: 5.5.62
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_test_learn`
--

-- --------------------------------------------------------

--
-- Структура таблицы `api_users`
--

CREATE TABLE `api_users` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'id пользователя',
  `login` varchar(30) NOT NULL COMMENT 'логин пользователя',
  `password` varchar(32) NOT NULL COMMENT 'хэш пароля'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `api_users`
--

INSERT INTO `api_users` (`id`, `login`, `password`) VALUES
(1, 'user', '6a00187b16a0be613e509fa9218c9011');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_hashes`
--

CREATE TABLE `auth_hashes` (
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'id пользователя',
  `hash` varchar(32) CHARACTER SET utf8 NOT NULL COMMENT 'хэш куки',
  `lifetime` int(10) NOT NULL COMMENT 'время жизни хэша'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Таблица хранит хэши куки';

--
-- Дамп данных таблицы `auth_hashes`
--

INSERT INTO `auth_hashes` (`user_id`, `hash`, `lifetime`) VALUES
(1, '9d60b3c01efe01999045f9873b116d75', 0),
(1, '4832819362bb04731b2c480781f5b9b1', 0),
(1, 'afc592533028d5f0752207c59f1a27d4', 1661010869),
(1, '9af7f36d09bd229d6b2a4c51b6a52a7d', 1661018918),
(1, 'a2fba490663869b0f2a7cbc5d70c8198', 1661019015),
(1, 'd8749a043d023916057d731ae118eb5e', 1661019092),
(1, '50fa70c4fe757868957258ffa9661740', 1661019239),
(1, '5a95301a8e865777e6329d7a182ab981', 1661019325),
(1, '003fa4903a3e11c04babee495a04bbf7', 1661019419),
(1, '8aa41c0801e40b73cb133ecd7a311202', 1661019465),
(1, 'e5921291a214bf1d22e5c585dc0c76e1', 1661019652);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL COMMENT 'id студента',
  `login` varchar(20) NOT NULL COMMENT 'логин студента',
  `name` varchar(40) NOT NULL COMMENT 'имя студента'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Студенты';

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `login`, `name`) VALUES
(1, 'login1', 'student1'),
(2, 'login2', 'student2'),
(3, 'login3', 'student3'),
(4, 'login4', 'student4'),
(5, 'login5', 'student5'),
(6, 'login6', 'student6'),
(7, 'login7', 'student7'),
(8, 'login8', 'student8'),
(9, 'login9', 'student9'),
(10, 'login10', 'student10'),
(11, 'login11', 'student11'),
(12, 'login12', 'student12');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `api_users`
--
ALTER TABLE `api_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login` (`login`,`password`);

--
-- Индексы таблицы `auth_hashes`
--
ALTER TABLE `auth_hashes`
  ADD KEY `user_id` (`user_id`,`hash`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `api_users`
--
ALTER TABLE `api_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'id пользователя', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id студента', AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
