-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 27 2021 г., 01:28
-- Версия сервера: 8.0.19
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `autocarrier`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` bigint NOT NULL,
  `login` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `buses`
--

CREATE TABLE `buses` (
  `id_auto` bigint NOT NULL DEFAULT '0',
  `model` varchar(25) NOT NULL,
  `driver_1` bigint NOT NULL,
  `driver_2` bigint NOT NULL,
  `driver_3` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buses`
--

INSERT INTO `buses` (`id_auto`, `model`, `driver_1`, `driver_2`, `driver_3`) VALUES
(101, 'VolgaBus', 0, 2, 3),
(123, 'Hyundai', 4, 5, 6),
(221, 'Mersedes', 7, 0, 2),
(311, 'VolgaBus', 3, 4, 5),
(320, 'Hyundai', 6, 7, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cashiers`
--

CREATE TABLE `cashiers` (
  `Id_cashier` bigint NOT NULL,
  `Name` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Surname` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cashiers`
--

INSERT INTO `cashiers` (`Id_cashier`, `Name`, `Surname`) VALUES
(0, 'Владимир', 'Сидоров'),
(1, 'Петр', 'Лоев'),
(2, 'Артем', 'Валуев'),
(3, 'Василий', 'Головченко');

-- --------------------------------------------------------

--
-- Структура таблицы `drivers`
--

CREATE TABLE `drivers` (
  `id_staff` bigint NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `drivers`
--

INSERT INTO `drivers` (`id_staff`, `name`, `surname`) VALUES
(0, 'Андрей', 'Петров'),
(1, 'Антон', 'Иванов'),
(2, 'Дмитрий', 'Савченко'),
(3, 'Николай', 'Яковлев'),
(4, 'Антон', 'Власов'),
(5, 'Константин', 'Чернов'),
(6, 'Яков', 'Семенов'),
(7, 'Максим', 'Федоров');

-- --------------------------------------------------------

--
-- Структура таблицы `routelist`
--

CREATE TABLE `routelist` (
  `id_list` bigint NOT NULL,
  `route` bigint NOT NULL,
  `date` date NOT NULL,
  `bus` bigint NOT NULL,
  `driver` bigint NOT NULL,
  `cashier` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `routelist`
--

INSERT INTO `routelist` (`id_list`, `route`, `date`, `bus`, `driver`, `cashier`) VALUES
(1, 4, '2021-05-10', 101, 0, 0),
(2, 7, '2021-05-10', 123, 4, 1),
(3, 3, '2021-05-10', 221, 7, 2),
(4, 3, '2021-05-11', 311, 3, 3),
(5, 2, '2021-05-11', 320, 1, 0),
(6, 6, '2021-05-11', 123, 6, 1),
(7, 1, '2021-05-12', 123, 5, 1),
(8, 42, '2021-05-12', 320, 7, 0),
(9, 7, '2021-05-12', 221, 2, 3),
(10, 4, '2021-05-13', 123, 4, 0),
(11, 3, '2021-05-13', 221, 0, 1),
(12, 29, '2021-05-13', 311, 5, 2),
(13, 8, '2021-05-14', 320, 6, 0),
(14, 29, '2021-05-14', 311, 3, 3),
(15, 42, '2021-05-14', 123, 4, 1),
(19, 2, '2021-05-15', 101, 0, 3),
(20, 4, '2021-05-15', 123, 4, 2),
(21, 7, '2021-05-15', 221, 2, 1),
(22, 4, '2021-05-16', 320, 7, 0),
(23, 8, '2021-05-16', 311, 3, 1),
(24, 3, '2021-05-16', 101, 0, 2),
(25, 7, '2021-05-31', 123, 0, 0),
(26, 42, '2021-06-09', 101, 3, 3),
(27, 1, '2021-06-30', 311, 4, 0),
(36, 1, '2021-06-09', 101, 0, 0),
(37, 1, '2021-06-16', 101, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `routes`
--

CREATE TABLE `routes` (
  `id_route` bigint NOT NULL DEFAULT '0',
  `start_point` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `finish_point` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `routes`
--

INSERT INTO `routes` (`id_route`, `start_point`, `finish_point`) VALUES
(1, 'C. Rynok', 'suvorovsky'),
(2, 'C. Rynok', 'Avtosborochniy'),
(3, 'Vokzal', 'Lesnichestvo'),
(4, 'C. Rynok', 'GPZ-10'),
(6, 'C. Rynok', 'OBL. Bolnitsa 1'),
(7, 'Vokzal', 'Mozayskaya'),
(8, 'GPZ-10', 'MegaMAG'),
(29, 'Vokzal', 'Sadi Utro'),
(42, 'C. Rynok', 'Platovsky');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id_auto`),
  ADD KEY `id_auto` (`id_auto`),
  ADD KEY `driver_1` (`driver_1`),
  ADD KEY `driver_2` (`driver_2`),
  ADD KEY `driver_3` (`driver_3`);

--
-- Индексы таблицы `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`Id_cashier`);

--
-- Индексы таблицы `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id_staff`);

--
-- Индексы таблицы `routelist`
--
ALTER TABLE `routelist`
  ADD PRIMARY KEY (`id_list`),
  ADD UNIQUE KEY `id_list` (`id_list`),
  ADD KEY `bus` (`bus`),
  ADD KEY `driver` (`driver`),
  ADD KEY `route` (`route`),
  ADD KEY `cashier` (`cashier`);

--
-- Индексы таблицы `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id_route`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `routelist`
--
ALTER TABLE `routelist`
  MODIFY `id_list` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `buses`
--
ALTER TABLE `buses`
  ADD CONSTRAINT `buses_ibfk_1` FOREIGN KEY (`driver_1`) REFERENCES `drivers` (`id_staff`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `buses_ibfk_2` FOREIGN KEY (`driver_2`) REFERENCES `drivers` (`id_staff`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `buses_ibfk_3` FOREIGN KEY (`driver_3`) REFERENCES `drivers` (`id_staff`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `routelist`
--
ALTER TABLE `routelist`
  ADD CONSTRAINT `routelist_ibfk_1` FOREIGN KEY (`bus`) REFERENCES `buses` (`id_auto`),
  ADD CONSTRAINT `routelist_ibfk_2` FOREIGN KEY (`driver`) REFERENCES `drivers` (`id_staff`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `routelist_ibfk_4` FOREIGN KEY (`route`) REFERENCES `routes` (`id_route`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `routelist_ibfk_5` FOREIGN KEY (`cashier`) REFERENCES `cashiers` (`Id_cashier`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
