-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 30 2017 г., 14:08
-- Версия сервера: 5.5.50
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` tinyint(3) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`task_id`, `user_id`, `text`, `image`, `status`) VALUES
(94, 34, 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t.', '94.jpg', '0'),
(95, 35, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. . \r\n', '95.jpg', '1'),
(96, 32, 'Lorem Ipsum és un text de farciment usat per la indústria de la tipografia i la impremta. Lorem Ipsum ha estat el text estàndard de la indústria des de l''any 1500', '96.jpg', '0'),
(97, 33, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed egestas nisl sit amet congue rutrum.t. ', '97.jpg', '1'),
(98, 35, '也称乱数假文或者哑元文本， 是印刷及排版领域所常用的虚拟文字。由于曾经一台匿名的打印机刻意打乱了', '98.jpg', '1'),
(99, 34, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed egestas nisl sit amet congue rutrum. Duis scelerisque magna vitae tellus rhoncus pharetra.', '99.jpg', '0'),
(100, 32, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed egestas nisl sit amet congue rutrum. Duis scelerisque magna vitae tellus rhoncus pharetra.', '100.jpg', '0'),
(101, 36, 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. ', '101.jpg', '0'),
(183, 1, 'Het is al geruime tijd een bekend gegeven dat een lezer, tijdens het bekijken van de layout van een pagina, afgeleid wordt door de tekstuele inhoud. Het belangrijke punt van het gebruik.', '183.jpg', '0'),
(184, 37, 'In tegenstelling tot wat algemeen aangenomen wordt is Lorem Ipsum niet zomaar willekeurige tekst. het heeft zijn wortels in een stuk klassieke latijnse literatuur uit 45.', '184.jpg', '0'),
(185, 1, 'Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende', '185.jpg', '1'),
(186, 1, '也称乱数假文或者哑元文本， 是印刷及排版领域所常用的虚拟文字。由于曾经一台匿名的打印机刻意打乱了', '186.jpg', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `email`, `password`, `is_admin`) VALUES
(1, 'Admin', 'Admin', 'admin@.mail.da', '123', '1'),
(32, 'Randy Ryan MD', 'wcole', 'brain49@douglas.com', 'T!y[]-B43FRlJ', '0'),
(33, 'Glenda Okuneva', 'colten.carter', 'fbarrows@hotmail.com', '}zzwN|SNTTc', '0'),
(34, 'Ericka Spencer', 'mrohan', 'qwerty@.mail.da', '@(K+6Zo;mx''SP<,.TY"', '0'),
(35, 'Oleta Anderson', 'mohr.casimer', 'earnestine08@hotmail.com', ']}|M/b.2Ec<+dX0s', '0'),
(36, 'Verdie Senger', 'oberbrunner.assunta', 'stroman.loma@yahoo.com', '{8zsHw":yc$', '0'),
(37, 'Oleks', 'oleks', 'ou@cxz.ru', '123', '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=187;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
