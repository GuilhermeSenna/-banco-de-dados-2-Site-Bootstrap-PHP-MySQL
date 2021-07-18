-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Tempo de geração: 15-Nov-2020 às 20:56
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
-- Estrutura da tabela `venda`
--

DROP TABLE IF EXISTS `venda`;
CREATE TABLE IF NOT EXISTS `venda` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `pedidoID` int DEFAULT NULL,
  `clienteID` int DEFAULT NULL,
  `data_venda` date DEFAULT NULL,
  `desconto_venda` int DEFAULT NULL,
  `valorBruto_venda` float DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_foreign_key_vendaCliente` (`clienteID`),
  KEY `fk_foreign_key_vendaPedido` (`pedidoID`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`ID`, `pedidoID`, `clienteID`, `data_venda`, `desconto_venda`, `valorBruto_venda`) VALUES
(62, 20, 2, '2020-11-15', 2, 32.4),
(63, 23, 2, '2020-11-15', 2, 15.4),
(64, 26, 2, '2020-11-15', 2, 55.93);

--
-- Acionadores `venda`
--
DROP TRIGGER IF EXISTS `Tgr_ItensVenda_Insert`;
DELIMITER $$
CREATE TRIGGER `Tgr_ItensVenda_Insert` AFTER INSERT ON `venda` FOR EACH ROW BEGIN
	DECLARE idprod INT;
    DECLARE quantprod INT;
	SET idprod = 0;
    SET quantprod = 0;
    
    SELECT produto.ID into idprod
	FROM pedido
	INNER JOIN produto
	ON pedido.produtoID = produto.ID
	WHERE pedido.id = NEW.pedidoID;
    
    SELECT pedido.quantidade into quantprod
	FROM pedido 
	INNER JOIN venda 
	ON venda.pedidoID = pedido.ID
	WHERE pedido.ID = NEW.pedidoID;
    
    UPDATE produto
    SET quantidade = quantidade - quantprod
    WHERE ID = idprod;
END
$$
DELIMITER ;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_foreign_key_vendaCliente` FOREIGN KEY (`clienteID`) REFERENCES `cliente` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_foreign_key_vendaPedido` FOREIGN KEY (`pedidoID`) REFERENCES `pedido` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
