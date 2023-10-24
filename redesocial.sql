-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2023 at 08:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redesocial`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `conteudo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `conteudo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `id_usuario`, `type`, `data`, `conteudo`) VALUES
(1, 6, 'text', '2023-10-16 19:45:30', 'drg'),
(2, 6, 'text', '2023-10-16 19:45:33', 'fscd'),
(3, 6, 'text', '2023-10-16 19:46:15', 'dvsd'),
(4, 6, 'text', '2023-10-16 21:00:49', 'VocÃª me odeia');

-- --------------------------------------------------------

--
-- Table structure for table `relacionamentos`
--

CREATE TABLE `relacionamentos` (
  `id` int(11) NOT NULL,
  `de` int(11) NOT NULL,
  `para` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `aniversario` date DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `emprego` varchar(100) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `capa` varchar(100) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `nome`, `aniversario`, `cidade`, `emprego`, `avatar`, `capa`, `token`) VALUES
(4, 'tayllanawislla@gmail.com', '$2y$10$sURIjKdzVce1O.5/I0hTPehjcPSsXa56ZKBXNgBafr3E795uLCLUe', 'tayllana Wislla Da Costa Amador', '2000-09-15', NULL, NULL, 'default.jpg', 'cover.jpg', '3e83969720a385ee4f562f5315fcb13b'),
(5, 'victor.garbin21@gmail.com', '$2y$10$qStMm7nxuOo.oCUhfMYHIeXsOkrU8W/dh3jinx.56lzeInmDINfQK', 'tayllana Wislla Da Costa Amador', '2000-09-15', NULL, NULL, 'default.jpg', 'cover.jpg', '2e68c01ac0c7a55bc81901589b9ce961'),
(6, 'avictor.garbin21@gmail.com', '$2y$10$TqT7zoC1QPXFtAGrtLhHMetXJ74WDK5vV7rGCFcZvEeeKPgNIELIq', 'Klevson Matheus', '2000-09-15', NULL, NULL, 'default.jpg', 'cover.jpg', '22afb9b4783c7913ae19f9fb0c7b3346');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relacionamentos`
--
ALTER TABLE `relacionamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `de` (`de`),
  ADD KEY `para` (`para`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `relacionamentos`
--
ALTER TABLE `relacionamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `relacionamentos`
--
ALTER TABLE `relacionamentos`
  ADD CONSTRAINT `relacionamentos_ibfk_1` FOREIGN KEY (`de`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `relacionamentos_ibfk_2` FOREIGN KEY (`para`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;