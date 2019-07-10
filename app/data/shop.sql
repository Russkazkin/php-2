-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Июл 10 2019 г., 05:16
-- Версия сервера: 10.3.15-MariaDB-1:10.3.15+maria~bionic
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `session_id`, `product_id`, `user_id`, `order_id`, `created`, `modified`) VALUES
(2, '46ef5160af3aefa4c4d6993893634ee0', 2, 2, 2, '2019-07-07 06:53:11', '2019-07-08 05:22:57'),
(6, '46ef5160af3aefa4c4d6993893634ee0', 96, 2, 2, '2019-07-07 09:44:58', '2019-07-08 05:22:57'),
(8, '46ef5160af3aefa4c4d6993893634ee0', 1, 2, 2, '2019-07-08 05:05:29', '2019-07-08 05:22:57'),
(9, 'd5274f4b2b91ca926861bbee89b64967', 1, 1, 3, '2019-07-09 05:31:24', '2019-07-09 05:31:36'),
(10, 'd5274f4b2b91ca926861bbee89b64967', 98, 1, 3, '2019-07-09 05:31:25', '2019-07-09 05:31:36'),
(11, 'd5274f4b2b91ca926861bbee89b64967', 104, 1, 3, '2019-07-09 05:31:28', '2019-07-09 05:31:36'),
(13, '316374b5e529c6041ea4aa4006fd0aa5', 98, NULL, 5, '2019-07-10 04:49:11', '2019-07-10 05:06:30'),
(14, '316374b5e529c6041ea4aa4006fd0aa5', 100, NULL, 5, '2019-07-10 04:49:12', '2019-07-10 05:06:30'),
(15, '316374b5e529c6041ea4aa4006fd0aa5', 101, NULL, 5, '2019-07-10 04:49:13', '2019-07-10 05:06:30'),
(16, '316374b5e529c6041ea4aa4006fd0aa5', 104, NULL, 5, '2019-07-10 04:49:15', '2019-07-10 05:06:30'),
(17, 'd3060640516a77bee57b3471d0f4690b', 1, NULL, 4, '2019-07-10 05:01:17', '2019-07-10 05:03:25'),
(18, 'd3060640516a77bee57b3471d0f4690b', 2, NULL, 4, '2019-07-10 05:01:18', '2019-07-10 05:03:25'),
(19, '3f21ba267c738ca7e9cb3dec9fff4e36', 1, NULL, 6, '2019-07-10 05:14:35', '2019-07-10 05:15:02'),
(20, '3f21ba267c738ca7e9cb3dec9fff4e36', 2, NULL, 6, '2019-07-10 05:14:36', '2019-07-10 05:15:02'),
(21, '3f21ba267c738ca7e9cb3dec9fff4e36', 1, NULL, 6, '2019-07-10 05:14:37', '2019-07-10 05:15:02'),
(22, '3f21ba267c738ca7e9cb3dec9fff4e36', 2, NULL, 6, '2019-07-10 05:14:39', '2019-07-10 05:15:02'),
(23, '3f21ba267c738ca7e9cb3dec9fff4e36', 96, NULL, 6, '2019-07-10 05:14:39', '2019-07-10 05:15:02');

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Хлебо-булочные изделия', 'Хлеб, выпечка, весовое печенье', '2019-06-03 16:19:34', '2019-06-03 16:19:34'),
(2, 'Молочные продукты', 'Молоко и кисломолочные напитки', '2019-06-03 16:20:11', '2019-06-03 16:20:11'),
(3, 'Колбасы', 'Все виды колбас', '2019-06-04 06:13:38', '2019-06-04 06:13:38'),
(4, 'Безалкогольные напитки', 'Соки, воды', '2019-06-17 06:41:56', '2019-06-17 06:41:56');

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Кубанская буренка', 'Краснодарский молокозавод', '2019-06-03 11:55:37', '2019-06-03 11:55:37'),
(2, 'Центральный хлебокомбинат', 'Краснодарский хлеб', '2019-06-03 11:55:37', '2019-06-03 11:55:37'),
(102, 'Pepsi', 'Сочинский завод PEPSI', '2019-06-17 06:41:02', '2019-06-17 06:41:02');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `created`, `modified`) VALUES
(2, 2, 3, '2019-07-08 05:22:57', '2019-07-09 17:03:53'),
(3, 1, 4, '2019-07-09 05:31:36', '2019-07-10 05:07:15'),
(4, 3, 2, '2019-07-10 05:03:25', '2019-07-10 05:03:41'),
(5, 3, 2, '2019-07-10 05:06:30', '2019-07-10 05:06:33'),
(6, 3, 2, '2019-07-10 05:15:02', '2019-07-10 05:15:05');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 1,
  `manufacturer_id` int(11) NOT NULL DEFAULT 1,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `category_id`, `manufacturer_id`, `name`, `description`, `price`, `img`, `created`, `modified`) VALUES
(1, 2, 1, 'Молоко пастеризованное, 1л (полиэтиленовый пакет)', 'Молоко пастеризованное, 1л (полиэтиленовый пакет)', '56.00', 'milk.png', '2019-06-02 05:42:13', '2019-06-07 10:51:51'),
(2, 2, 1, 'Кефир, 1л (полиэтиленовый пакет)', 'Кефир, 1л (полиэтиленовый пакет, жирность 1%)', '49.00', 'kefir.png', '2019-06-02 05:43:14', '2019-06-07 10:51:41'),
(96, 2, 1, 'Сметана, полиэтиленовый пакет', 'Жирность 15%', '35.00', 'smetana.png', '2019-06-06 07:49:15', '2019-06-06 07:49:15'),
(98, 1, 2, 'Хлеб \"Бородинский\"', 'Хлеб ржаной, Высший сорт', '25.00', 'hleb.png', '2019-06-06 08:19:46', '2019-06-06 11:41:14'),
(100, 2, 1, 'Батон нарезной', 'Батон белый нарезной в полиэтиленовом пакете', '56.45', 'placeholder.png', '2019-06-06 09:26:20', '2019-06-06 09:26:20'),
(101, 2, 1, 'Молоко топленое, полиэтиленовый пакет', 'Жирность 3.5%', '58.90', 'placeholder.png', '2019-06-06 09:43:58', '2019-06-06 12:08:24'),
(104, 4, 102, 'Pepsi, 2л', 'Напиток безалкогольный Pepsi. Объем 2 литра', '75.00', 'pepsi.png', '2019-06-17 06:48:35', '2019-06-17 06:48:35');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(64) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `name`, `email`, `created`, `modified`, `last_login`) VALUES
(1, 'ruslan', 'Aui.ef6VhZa1M', 'Rus Skazkin', 'admin@localhost', '2019-06-10 12:57:03', '2019-06-10 12:57:03', '2019-06-10 12:57:03'),
(2, 'user', 'Au.rea.wRj1mM', 'user', 'user@localhost', '2019-06-11 05:27:35', '2019-06-11 05:27:35', '2019-06-11 05:27:35'),
(3, 'admin', 'AutID61LF5kso', 'Super Admin', 'admin@localhost', '2019-07-10 04:43:06', '2019-07-10 04:43:06', '2019-07-10 04:43:06');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
