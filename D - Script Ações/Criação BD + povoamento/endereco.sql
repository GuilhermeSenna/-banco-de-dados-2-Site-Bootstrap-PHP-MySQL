-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Tempo de geração: 15-Nov-2020 às 20:55
-- Versão do servidor: 8.0.21
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `rua` varchar(70) DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`ID`, `rua`, `numero`, `bairro`) VALUES
(1, 'A', 123, 'Centro'),
(4, 'asdaw', 123, 'Centro'),
(5, 'asdaw', 123, 'Centro'),
(6, 'C', 32, 'Salobrinho'),
(7, 'Qualquer', 32, 'Gueto'),
(8, 'Rua da jacá', 234, 'Madureira'),
(9, 'Quadrada', 312, 'Seila'),
(10, 'Circular', 231, 'Central'),
(11, 'Circular', 231, 'Central'),
(12, 'Circular', 231, 'Central'),
(13, 'Circular', 231, 'Central'),
(14, 'asd', 314, '15421');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
