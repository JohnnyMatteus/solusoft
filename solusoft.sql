-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23-Mar-2020 às 02:19
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solusoft`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `sexo`, `email`) VALUES
(1, 'Johnny Santos', '016.111.255-86', 'Masculino', 'jmatteus20@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_pedidos`
--

CREATE TABLE `itens_pedidos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `itens_pedidos`
--

INSERT INTO `itens_pedidos` (`id`, `pedido_id`, `produto_id`, `quantidade`) VALUES
(3, 16, 2, 2),
(5, 16, 2, 1),
(6, 21, 2, 3),
(7, 22, 2, 123),
(8, 23, 2, 3),
(9, 24, 2, 3),
(10, 25, 2, 3),
(11, 26, 2, 1234),
(12, 27, 2, 3),
(13, 28, 2, 3),
(14, 29, 2, 32),
(15, 30, 2, 32),
(16, 31, 2, 32),
(17, 32, 2, 32),
(18, 33, 2, 3),
(19, 34, 2, 1),
(20, 35, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `observacao` longtext,
  `forma_pagamento` varchar(45) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `data`, `observacao`, `forma_pagamento`, `cliente_id`) VALUES
(16, '2019-01-29', 'Teste2', 'Cartão de Crédito', 1),
(20, '2020-03-22', 'teste', 'cartao_de_debto', 1),
(21, '2020-03-22', 'teste', 'cartao_de_debto', 1),
(22, '2020-03-22', 'teste', 'cartao_de_credito', 1),
(23, '2020-03-22', 'Teste', 'cartao_de_debto', 1),
(24, '2020-03-22', 'teste', 'cartao_de_debto', 1),
(25, '2020-03-22', 'teste', 'cartao_de_credito', 1),
(26, '2020-03-22', 'teste', 'cartao_de_debto', 1),
(27, '2020-03-22', 'teste', 'cartao_de_credito', 1),
(28, '2020-03-22', 'tste', 'cartao_de_debto', 1),
(29, '2020-03-22', 'teste', 'cartao_de_credito', 1),
(30, '2020-03-22', 'teste', 'cartao_de_credito', 1),
(31, '2020-03-22', 'teste', 'cartao_de_credito', 1),
(32, '2020-03-22', 'teste', 'cartao_de_credito', 1),
(33, '2020-03-22', 'teste', 'dinheiro', 1),
(34, '2020-03-22', 'teste', 'cartao_de_debto', 1),
(35, '2020-03-22', 'teste', 'cartao_de_debto', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cor` varchar(45) DEFAULT NULL,
  `tamanho` varchar(45) DEFAULT NULL,
  `valor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `cor`, `tamanho`, `valor`) VALUES
(2, 'Tenis Nike Shox', 'Branco', '42', 1500),
(3, 'Tenis Adidas', 'Dourado', '41', 859);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itens_pedidos`
--
ALTER TABLE `itens_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `itens_pedidos`
--
ALTER TABLE `itens_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `itens_pedidos`
--
ALTER TABLE `itens_pedidos`
  ADD CONSTRAINT `itens_pedidos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `itens_pedidos_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
