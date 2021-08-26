-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 03 2021 г., 19:14
-- Версия сервера: 5.7.27-30
-- Версия PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u0985581_210730`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pref_admin_users`
--

CREATE TABLE `pref_admin_users` (
  `id` int(10) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pref_admin_users`
--

INSERT INTO `pref_admin_users` (`id`, `login`, `password`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Структура таблицы `pref_tasks`
--

CREATE TABLE `pref_tasks` (
  `id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `completed` int(10) NOT NULL,
  `is_change` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pref_tasks`
--

INSERT INTO `pref_tasks` (`id`, `user_name`, `user_email`, `description`, `completed`, `is_change`) VALUES
(1, 'Аркадий', 'test1@mail.ru', '1 задача', 1, 1),
(2, 'Борис', 'test2@mail.ru', '2 задачаf', 0, 1),
(3, 'Виталий', 'test3@mail.ru', '3 задача (отредактирована)', 1, 1),
(4, 'Геннадий', 'test4@mail.ru', '4 задачаfee', 0, 1),
(5, 'Дмитрий', 'test5@mail.ru', '5 задача5', 0, 1),
(6, 'Евгений', 'test6@mail.ru', '6 задача', 0, 0),
(7, 'Жанна', 'test7@mail.ru', '7 задача', 0, 0),
(8, 'Зинаида', 'test8@mail.ru', '8 задача', 0, 0),
(9, 'Иван', 'test9@mail.ru', '9 задача', 0, 0),
(10, 'Кирилл', 'test10@mail.ru', '10 задача', 0, 0),
(11, 'Леонид', 'test11@mail.ru', '11 задача', 0, 0),
(12, 'Марина', 'test12@mail.ru', '12 задача', 0, 0),
(13, 'Николай', 'test13@mail.ru', '13 задача', 0, 0),
(29, 'test', 'test@test.com', 'test job', 0, 0),
(30, 'test2', 'test2@test.com', '&lt;текст&gt;', 0, 0),
(31, 'Незарегистрированный', 'test3@test.com', 'Задача', 0, 1),
(32, 'Незарегистрированный 2', 'test4@test.com', 'Задачаffe', 1, 1),
(33, 'aaa', 'aaa@aaa.aaa', 'aaa', 0, 0),
(34, 'zzz', 'zzz@aaa.aaa', 'zzz1111155555', 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `pref_admin_users`
--
ALTER TABLE `pref_admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pref_tasks`
--
ALTER TABLE `pref_tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `pref_admin_users`
--
ALTER TABLE `pref_admin_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `pref_tasks`
--
ALTER TABLE `pref_tasks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
