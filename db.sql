-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 11 2019 г., 16:31
-- Версия сервера: 8.0.16
-- Версия PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc_tasks`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$B6IGUyIj2hnpNZpztL8nteQsA.sLaxZY1kmVjVZlVe9BsRQt7Kp/a');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `email`, `content`, `status`) VALUES
(1, 'dfg', 'dfgfdg@adasd.com', 'asdsad', 1),
(2, 'ttt', 'sdf@asd.com', 'asasdsad234234', 2),
(3, 'sdfdsf', 'asdsad@asd.com', 'asdasd', 1),
(4, 'fdgdfg', 'sasd@asddsa.com', 'sfkjsd hksdfh jksd', 0),
(5, 'sdfsdf', 'cvbcvaasd@asda.com', 'sdasd', 0),
(6, 'dfgfd', 'dfgfdg@asds.com', 'sdfsdf', 0),
(7, 'babken', 'babken@sadsad.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur faucibus vulputate leo in tincidunt. In eget molestie augue. Morbi a convallis metus, sed scelerisque felis. Integer nec maximus purus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed sed ex posuere, facilisis est ornare, ultricies libero. Vestibulum hendrerit, lectus at semper gravida, urna massa ultrices neque, eu varius nisl lorem fermentum dui. In pharetra ex vitae sollicitudin placerat.\r\n\r\nFusce egestas vestibulum massa, quis vestibulum est. Nullam a enim laoreet, consectetur mauris in, fringilla tortor. Sed blandit dignissim purus, eu volutpat diam sollicitudin suscipit. Etiam vehicula libero non ultricies placerat. Proin eu mauris eu nunc blandit dapibus. In auctor risus justo, ut scelerisque lectus fringilla non. Nulla sed elementum nunc. Maecenas volutpat euismod mi vitae pellentesque. Mauris aliquet mollis lacus, a pulvinar risus pulvinar eu. Aliquam porttitor interdum mi sit amet tristique. Sed dictum ipsum lacus, id imperdiet dui tincidunt et.\r\n\r\nPhasellus semper magna velit, rhoncus sodales lorem tempus at. Ut dignissim odio ac mi congue, at accumsan orci commodo. Nunc nec ornare risus. Mauris auctor urna nec sollicitudin auctor. Sed sodales ipsum vel malesuada convallis. Maecenas et purus eget ante ullamcorper commodo sit amet in leo. Praesent vehicula suscipit faucibus. Sed scelerisque sodales diam, quis tempor augue suscipit et. Praesent ut ornare odio. Donec malesuada nulla non laoreet accumsan. Maecenas mollis, eros ac mollis ornare, orci lorem varius sem, vel iaculis mauris sapien eget augue. Donec elementum tellus nunc, ut elementum', 0),
(8, 'sdfdsf', 'sdasd@asdad.asd', 'asdasd', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
