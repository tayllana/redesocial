

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `conteudo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `conteudo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `relacionamentos` (
  `id` int(11) NOT NULL,
  `de` int(11) NOT NULL,
  `para` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `usuario_id` (`usuario_id`);

ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `relacionamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `de` (`de`),
  ADD KEY `para` (`para`);


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `relacionamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

ALTER TABLE `relacionamentos`
  ADD CONSTRAINT `relacionamentos_ibfk_1` FOREIGN KEY (`de`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `relacionamentos_ibfk_2` FOREIGN KEY (`para`) REFERENCES `usuarios` (`id`);
COMMIT;
