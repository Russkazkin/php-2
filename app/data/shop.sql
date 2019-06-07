-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Июн 07 2019 г., 16:52
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
  `session_id` int(11) NOT NULL,
  `$product_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 'Колбасы', 'Все виды колбас', '2019-06-04 06:13:38', '2019-06-04 06:13:38');

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
(2, 'Центральный хлебокомбинат', 'Краснодарский хлеб', '2019-06-03 11:55:37', '2019-06-03 11:55:37');

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
(101, 2, 1, 'Молоко топленое, полиэтиленовый пакет', 'Жирность 3.5%', '58.90', 'placeholder.png', '2019-06-06 09:43:58', '2019-06-06 12:08:24');

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
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
