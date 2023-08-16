-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Июн 26 2023 г., 13:52
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int NOT NULL,
  `author_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `author_name`) VALUES
(1, 'Томас Гоббс'),
(2, 'Агата Кристи'),
(3, 'Артур Конан Дойл'),
(4, 'а');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `author_id` int NOT NULL,
  `genre_id` int NOT NULL,
  `publisher_id` int NOT NULL,
  `pages_count` int NOT NULL,
  `publication_year` int NOT NULL,
  `issued_quantity` int NOT NULL,
  `available_quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `image`, `author_id`, `genre_id`, `publisher_id`, `pages_count`, `publication_year`, `issued_quantity`, `available_quantity`) VALUES
(36, 'Тест', 'Тест', 'book-img-1.jpg', 2, 7, 1, 2, 2, 2, 2),
(37, 'Тест', 'Тест', 'book-img-1.jpg', 2, 7, 1, 2, 2, 2, 2),
(38, 'ваыа', 'аывавы', '', 1, 3, 3, 34, 43, 2, 3),
(39, '432432', 'sssssssss', '', 1, 2, 1, 234, 43, 2, 342),
(40, 'ваыв', 'аываы', '', 1, 2, 2, 3424, 4234, 2, 3),
(41, '2331', '213', '', 1, 1, 2, 231, 21, 2231, 2131),
(42, '4ва', 'выавы', '', 1, 1, 2, 34, 43, 2, 3),
(43, 'dsf', 'fdsfs', '', 1, 1, 2, 34, 43, 43, 34),
(44, 'dfs', 'dsf', 'shoes-img2.png', 1, 2, 1, 34, 43, 43, 434);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `genre_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `genre_name`) VALUES
(1, 'Трактат'),
(2, 'Детектив'),
(3, 'Научная фантастика'),
(7, 'Драма'),
(8, 'р');

-- --------------------------------------------------------

--
-- Структура таблицы `issues_magazine`
--

CREATE TABLE `issues_magazine` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `book_id` int NOT NULL,
  `status_id` int NOT NULL,
  `unique_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `issues_magazine`
--

INSERT INTO `issues_magazine` (`id`, `student_id`, `book_id`, `status_id`, `unique_number`) VALUES
(62, 1, 42, 1, '4'),
(63, 3, 40, 1, '5'),
(64, 1, 42, 1, '4'),
(65, 3, 40, 1, '5');

-- --------------------------------------------------------

--
-- Структура таблицы `publishers`
--

CREATE TABLE `publishers` (
  `id` int NOT NULL,
  `publisher_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `publishers`
--

INSERT INTO `publishers` (`id`, `publisher_name`) VALUES
(1, 'Неизвестное издательство'),
(2, 'Известное издательство'),
(3, 'test'),
(4, 'test'),
(5, 'а'),
(6, 'а'),
(7, 'а');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'librarian');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int NOT NULL,
  `status_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `status_name`) VALUES
(1, 'Выдана'),
(2, 'Возвращена');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `study_group` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `full_name`, `study_group`) VALUES
(1, 'Студент 1', 2),
(2, 'Студент 2', 1),
(3, 'Студент 1', 2),
(4, 'Студент 2', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `study_groups`
--

CREATE TABLE `study_groups` (
  `id` int NOT NULL,
  `group_name` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `study_groups`
--

INSERT INTO `study_groups` (`id`, `group_name`) VALUES
(1, 'ИП-912К'),
(2, 'ИП-911К');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(24) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `second_name` varchar(30) NOT NULL,
  `patronymic_name` varchar(30) NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `first_name`, `second_name`, `patronymic_name`, `role_id`) VALUES
(12, 't', '$2y$10$sYNZC4I5tAkr5EbbjyUdYO.jeYRHN90/syUg.NwSQogCl2/xSabQm', 't', 't', 't', 2),
(13, 'd', '$2y$10$HGFpIVmMLA3PRf67zJ6XDetWVdCTwSdJ/IQ8mMcUbDytP6KI/H9/S', 'd', 'd', 'd', 1),
(14, 'f', '$2y$10$viUgiVnYwkT6eB1vyonKIeZV5PJBWnwYk1L3r3Hp0CgXel0ImwZcy', 'f', 'f', 'f', 2),
(15, 'd', '$2y$10$Jp7BhloWX7noEODXBhyLketgQpo0IiVFdjGDLd24KNe0RGYlOxCm6', 'd', 'd', 'd', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `publisher_id` (`publisher_id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `issues_magazine`
--
ALTER TABLE `issues_magazine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`student_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `study_group` (`study_group`);

--
-- Индексы таблицы `study_groups`
--
ALTER TABLE `study_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `issues_magazine`
--
ALTER TABLE `issues_magazine`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `study_groups`
--
ALTER TABLE `study_groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `books_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `books_ibfk_4` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`);

--
-- Ограничения внешнего ключа таблицы `issues_magazine`
--
ALTER TABLE `issues_magazine`
  ADD CONSTRAINT `issues_magazine_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `issues_magazine_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `issues_magazine_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`study_group`) REFERENCES `study_groups` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
