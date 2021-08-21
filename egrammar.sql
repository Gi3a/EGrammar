-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 22 2021 г., 01:01
-- Версия сервера: 8.0.15
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `egrammar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `text_ru` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text_en` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id`, `text_ru`, `text_en`) VALUES
(1, 'Я иду играть в теннис', 'I\'m going to play tennis'),
(2, 'Сегодня у меня день рождение', 'Today is my birthday'),
(3, 'Сколько тебе лет', 'How old are you'),
(4, 'Никогда не сдавайся', 'Never give up'),
(5, 'Как приготовить пирог с тунцом', 'How to make tuna pie');

-- --------------------------------------------------------

--
-- Структура таблицы `tests_logs`
--

CREATE TABLE `tests_logs` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `text_en` text NOT NULL,
  `text_ru` text NOT NULL,
  `correct` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests_logs`
--

INSERT INTO `tests_logs` (`id`, `test_id`, `text_en`, `text_ru`, `correct`, `user_id`) VALUES
(44, 1, 'I\'m going to play tennis', 'Я иду играть в теннис', '<span class=\'swal_red\'>going </span><span class=\'swal_red\'>play </span><span class=\'swal_red\'>I\'m </span><span class=\'swal_red\'>to </span><span class=\'swal_green\'>tennis </span>', 2),
(45, 2, 'Today is my birthday', 'Сегодня у меня день рождение', '<span class=\'swal_green\'>Today </span><span class=\'swal_green\'>is </span><span class=\'swal_green\'>my </span><span class=\'swal_green\'>birthday </span>', 2),
(64, 1, 'I\'m going to play tennis', 'Я иду играть в теннис', '<span class=\'swal_red\'>tennis </span><span class=\'swal_red\'>play </span><span class=\'swal_green\'>to </span><span class=\'swal_red\'>going </span><span class=\'swal_red\'>I\'m </span>', 6),
(65, 2, 'Today is my birthday', 'Сегодня у меня день рождение', '<span class=\'swal_green\'>Today </span><span class=\'swal_green\'>is </span><span class=\'swal_green\'>my </span><span class=\'swal_green\'>birthday </span>', 6),
(86, 1, 'I\'m going to play tennis', 'Я иду играть в теннис', '<span class=\'swal_green\'>I\'m </span><span class=\'swal_green\'>going </span><span class=\'swal_green\'>to </span><span class=\'swal_green\'>play </span><span class=\'swal_green\'>tennis </span>', 7),
(87, 2, 'Today is my birthday', 'Сегодня у меня день рождение', '<span class=\'swal_red\'>is </span><span class=\'swal_red\'>my </span><span class=\'swal_red\'>birthday </span><span class=\'swal_red\'>Today </span>', 7),
(88, 3, 'How old are you', 'Сколько тебе лет', '<span class=\'swal_green\'>How </span><span class=\'swal_green\'>old </span><span class=\'swal_red\'>you </span><span class=\'swal_red\'>are </span>', 7),
(89, 4, 'Never give up', 'Никогда не сдавайся', '<span class=\'swal_red\'>give </span><span class=\'swal_red\'>Never </span><span class=\'swal_green\'>up </span>', 7),
(90, 5, 'How to make tuna pie', 'Как приготовить пирог с тунцом', '<span class=\'swal_green\'>How </span><span class=\'swal_green\'>to </span><span class=\'swal_green\'>make </span><span class=\'swal_red\'>pie </span><span class=\'swal_red\'>tuna </span>', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `result` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `result`, `status`) VALUES
(1, 'sad', 'user', NULL, 1),
(2, 'dasasda', 'user', '1', 3),
(3, 'sdadas', 'user', NULL, 1),
(4, 'asd', 'user', '0', 1),
(5, 'sda', 'user', NULL, 1),
(6, 'ad', 'user', '1', 3),
(7, 'Петр', 'user', '1', 6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tests_logs`
--
ALTER TABLE `tests_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tests_logs`
--
ALTER TABLE `tests_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tests_logs`
--
ALTER TABLE `tests_logs`
  ADD CONSTRAINT `test_id` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
