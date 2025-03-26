-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Mar-2025 às 14:26
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `provap1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `gatos`
--

CREATE TABLE `gatos` (
  `gat_cod` int(11) NOT NULL,
  `gat_nome` varchar(30) NOT NULL,
  `gat_raca` varchar(25) NOT NULL,
  `gat_cor` varchar(30) NOT NULL,
  `gat_sexo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `gatos`
--

INSERT INTO `gatos` (`gat_cod`, `gat_nome`, `gat_raca`, `gat_cor`, `gat_sexo`) VALUES
(1, 'Sasha', 'persa', 'branco', 'F'),
(2, 'Bob', 'ragdoll', 'branco', 'M'),
(3, 'Pipoca', 'maine coon', 'marrom', 'F'),
(4, 'Mel', 'siamês', 'branco', 'F'),
(5, 'Mingau', 'snowshoe', 'marrom', 'M');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `gatos`
--
ALTER TABLE `gatos`
  ADD PRIMARY KEY (`gat_cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `gatos`
--
ALTER TABLE `gatos`
  MODIFY `gat_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
