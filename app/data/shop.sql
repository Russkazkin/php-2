-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Июн 18 2019 г., 14:04
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
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `session_id`, `product_id`, `user_id`, `created`, `modified`) VALUES
(49, '19af66c647079b7a1c3e5bceddf8fd49', 96, NULL, '2019-06-16 06:45:27', '2019-06-16 06:45:44'),
(51, '19af66c647079b7a1c3e5bceddf8fd49', 1, 2, '2019-06-17 06:13:12', '2019-06-17 06:13:12'),
(52, '19af66c647079b7a1c3e5bceddf8fd49', 98, 2, '2019-06-17 06:26:34', '2019-06-17 06:26:34'),
(53, '19af66c647079b7a1c3e5bceddf8fd49', 104, 2, '2019-06-17 06:56:57', '2019-06-17 06:56:57');

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
(2, 'user', 'Au.rea.wRj1mM', 'user', 'user@localhost', '2019-06-11 05:27:35', '2019-06-11 05:27:35', '2019-06-11 05:27:35');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
