-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Set-2021 às 21:30
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `abfc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `escalacaos`
--

CREATE TABLE `escalacaos` (
  `id` int(11) NOT NULL,
  `idjogo` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `posicao` varchar(5) NOT NULL,
  `nota` int(11) NOT NULL,
  `gol` int(11) NOT NULL,
  `assistencia` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `escalacaos`
--

INSERT INTO `escalacaos` (`id`, `idjogo`, `iduser`, `posicao`, `nota`, `gol`, `assistencia`, `data`) VALUES
(27, 15, 2, 'V', 10, 3, 3, '2021-06-04'),
(28, 15, 3, 'AT', 10, 3, 3, '2021-06-04'),
(29, 7, 2, 'V', 7, 1, 1, '2021-05-28'),
(30, 7, 3, 'M', 6, 1, 1, '2021-05-28'),
(31, 19, 2, 'V', 5, 3, 2, '2020-09-01'),
(32, 19, 3, 'M', 6, 2, 3, '2020-09-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

CREATE TABLE `jogos` (
  `id` int(11) NOT NULL,
  `adversario` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `golspro` int(11) NOT NULL,
  `golscontra` int(11) NOT NULL,
  `local` varchar(100) NOT NULL,
  `quadro` varchar(1) NOT NULL,
  `formacao` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `jogos`
--

INSERT INTO `jogos` (`id`, `adversario`, `data`, `golspro`, `golscontra`, `local`, `quadro`, `formacao`) VALUES
(7, 'Fulano FC', '2021-05-28', 2, 1, 'U.C.R.A.', '1', '4-4-2'),
(8, 'Os Amigos FC', '2021-05-07', 1, 0, 'U.C.R.A.', '1', '4-4-2'),
(9, 'Nós que Ta', '2021-05-14', 5, 4, 'U.C.R.A.', '1', '4-4-2'),
(10, '2º Quadro', '2021-05-21', 1, 2, 'U.C.R.A.', '1', '4-4-2'),
(11, '1º Quadro', '2021-05-21', 2, 1, 'U.C.R.A.', '2', '4-4-2'),
(12, 'Testando FC', '2021-05-07', 0, 4, 'U.C.R.A.', '2', '4-4-2'),
(13, '11 Primos FC', '2021-05-14', 4, 1, 'U.C.R.A.', '2', '4-4-2'),
(14, 'Toca facil FC', '2021-05-28', 0, 3, 'U.C.R.A.', '2', '4-4-2'),
(15, 'Roma FC', '2021-06-04', 6, 2, 'U.C.R.A.', '1', '4-4-2'),
(16, 'Teste', '2021-06-04', 1, 1, 'U.C.R.A.', '2', '4-4-2'),
(17, 'sdsadasdd', '2021-08-01', 0, 0, 'U.C.R.A.', '1', ''),
(18, '77777', '2021-08-08', 0, 0, 'U.C.R.A.', '1', ''),
(19, 'TesteArray', '2020-09-01', 5, 5, 'U.C.R.A.', '1', '4-4-2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas`
--

CREATE TABLE `notas` (
  `userid` int(11) NOT NULL,
  `defesa` int(11) NOT NULL,
  `posicionamento` int(11) NOT NULL,
  `finalizacao` int(11) NOT NULL,
  `inteligencia` int(11) NOT NULL,
  `tecnica` int(11) NOT NULL,
  `fisico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `notas`
--

INSERT INTO `notas` (`userid`, `defesa`, `posicionamento`, `finalizacao`, `inteligencia`, `tecnica`, `fisico`) VALUES
(2, 3, 4, 6, 9, 1, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `postcomments`
--

CREATE TABLE `postcomments` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `datacriacao` date NOT NULL,
  `idpost` int(11) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `body` text NOT NULL,
  `datacriacao` date NOT NULL,
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idjogo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `aniversario` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `avatar`, `aniversario`, `email`, `senha`, `token`) VALUES
(2, 'Carlos Gobbo', 'kk.jpg', '1983-03-03', 'kkgobbo@gmail.com', '$2y$10$qKP3Uur9Jr4N5QkU7E8omuye34uo3R4hJ3ok6rdb/wA4PTQPjocZ6', 'a533cca80a78548b413032835b25a43b'),
(3, 'Pedro Paulo Pereira', '', '1984-09-12', 'ppp@gmail.com', '$2y$10$pNRBYmHpIZE.CgPCKnFTNuBByzIGHHUe3NfGBxivhIxkHrpymSYua', 'a8ab41db4e2914644be4b22ccfe47ecd');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `escalacaos`
--
ALTER TABLE `escalacaos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`userid`);

--
-- Índices para tabela `postcomments`
--
ALTER TABLE `postcomments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `escalacaos`
--
ALTER TABLE `escalacaos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `postcomments`
--
ALTER TABLE `postcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
