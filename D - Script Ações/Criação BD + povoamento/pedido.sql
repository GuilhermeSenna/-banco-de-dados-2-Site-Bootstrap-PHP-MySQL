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
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `produtoID` int DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_foreign_key_pedidoProduto` (`produtoID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`ID`, `produtoID`, `quantidade`) VALUES
(20, 1, 1),
(23, 2, 1),
(26, 6, 7);

--
-- Acionadores `pedido`
--
DROP TRIGGER IF EXISTS `Tgr_Estoquepedidos_Insert`;
DELIMITER $$
CREATE TRIGGER `Tgr_Estoquepedidos_Insert` BEFORE UPDATE ON `pedido` FOR EACH ROW BEGIN
	IF NEW.quantidade > (
		Select quantidade
        from produto P
        where NEW.produtoID = P.id
    )THEN
    signal sqlstate '45000' set message_text ='A quantidade solicitada é maior do que a que há em estoque';
    END IF;
END
$$
DELIMITER ;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_foreign_key_pedidoProduto` FOREIGN KEY (`produtoID`) REFERENCES `produto` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
