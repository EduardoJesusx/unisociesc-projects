-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Dez-2021 às 01:23
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `calroni`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL COMMENT 'codigo do pedido gerado por auto incremento',
  `usuarios_idUsuario` int(11) NOT NULL COMMENT 'chave estrangeira da tabela usuarios',
  `dataConfirmacao` datetime NOT NULL COMMENT 'data da confirmação do pedido feita pelo adm',
  `dataFechamento` datetime NOT NULL COMMENT 'data de conclusão do pedido',
  `status` int(11) NOT NULL COMMENT 'status do pedido (0 para pendente, 1 para em produção, 2 para concluído, 3 encerrado)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `usuarios_idUsuario`, `dataConfirmacao`, `dataFechamento`, `status`) VALUES
(1, 1, '2021-02-01 12:25:19', '2021-02-01 12:38:39', 3),
(2, 2, '2021-02-05 08:33:09', '2021-02-05 09:45:09', 2),
(3, 3, '2021-06-02 09:18:59', '2021-06-02 10:23:59', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_tem_produtos`
--

CREATE TABLE `pedidos_tem_produtos` (
  `Produtos_idProduto` int(11) NOT NULL COMMENT 'chave c gerada por uma relação N:N',
  `pedidos_idPedido` int(11) NOT NULL COMMENT 'chave c gerada por uma relação N:N',
  `quantidade` int(11) NOT NULL COMMENT 'Quantidade dos produtos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos_tem_produtos`
--

INSERT INTO `pedidos_tem_produtos` (`Produtos_idProduto`, `pedidos_idPedido`, `quantidade`) VALUES
(1, 1, 3),
(1, 2, 2),
(5, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int(11) NOT NULL COMMENT 'codigo do produto',
  `tipoProduto_idtTipo_produto` int(11) NOT NULL COMMENT 'chave estrangeira da tabela tipo_produto',
  `nome_produtos` varchar(45) NOT NULL COMMENT 'nome do produto',
  `descricao` text NOT NULL COMMENT 'descrição do produto( valor nutricional, restrições alimenticias',
  `preco` decimal(5,2) NOT NULL COMMENT 'valor do produto',
  `imagem` varchar(100) NOT NULL COMMENT 'imagem do produto( nome do produto + md5)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `tipoProduto_idtTipo_produto`, `nome_produtos`, `descricao`, `preco`, `imagem`) VALUES
(1, 1, 'Frango com Catupiry', 'Calzone de frango com Catupiry e orégano, Serve 1 pessoa, Contem Glúten, Lactose.', '10.50', ''),
(2, 1, 'Max Beef', 'Calzone de Carne de panela, com queijo derretido e molho de carne, Serve 1 pessoa, Contem Glúten, Lactose.', '15.30', ''),
(3, 2, 'Dois Amores', 'Calzone de metade chocolate branco e a outra metade chocolate preto, serve 1 pessoa, possui Glúten e Lactose.', '13.50', ''),
(4, 2, 'Prestigio', 'Calzone de chocolate preto com coco ralado, serve 1 pessoa, contem Glúten e Lactose.', '13.00', ''),
(5, 3, 'Coca Cola 2L', 'Refrigerante de Cola.', '12.00', ''),
(6, 3, 'Guaraná 2L', 'Refrigerante de Guaraná.', '12.00', ''),
(7, 3, 'Água com Gás', 'água com gás ', '3.00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoproduto`
--

CREATE TABLE `tipoproduto` (
  `idTipo_produto` int(11) NOT NULL COMMENT 'codigo do produto gerado  por auto incremento',
  `nome_tipoProduto` varchar(45) NOT NULL COMMENT 'nome do tipo do produto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipoproduto`
--

INSERT INTO `tipoproduto` (`idTipo_produto`, `nome_tipoProduto`) VALUES
(1, 'Salgado'),
(2, 'Doce'),
(3, 'Bebidas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idTipo` int(11) NOT NULL COMMENT 'codigo do tipo do usuario gerado por auto incremento',
  `nome_tipoUsuario` varchar(45) NOT NULL COMMENT 'nome dos tipo de usuarios',
  `descricao` text NOT NULL COMMENT 'descrição basica sobre funções do tipo do usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipousuario`
--

INSERT INTO `tipousuario` (`idTipo`, `nome_tipoUsuario`, `descricao`) VALUES
(1, 'ADM', 'O ADM ira fazer a confirmação do pedido no caixa.'),
(2, 'Cozinha', 'Ira ser o usuário que ficara com a tela dos pedidos confirmados.'),
(3, 'Cliente', 'esse usuário será para todos os clientes do restaurante');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL COMMENT 'codigo do usuario gerado por auto incremento',
  `tipo_usuario_idTipo` int(11) NOT NULL COMMENT 'chave estrangeira da tabela tipo_usuario',
  `nome_usuarios` varchar(45) NOT NULL COMMENT 'nome do usuario',
  `senha` varchar(45) NOT NULL COMMENT 'senha do usuario',
  `email` varchar(100) NOT NULL COMMENT 'e-mail do usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `tipo_usuario_idTipo`, `nome_usuarios`, `senha`, `email`) VALUES
(1, 1, 'Pedro', '123', 'adm@teste'),
(2, 2, 'Marcos', '123', 'cozinha@teste'),
(3, 3, 'Roni', '123', 'cliente@teste');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `usuarios_idUsuario` (`usuarios_idUsuario`);

--
-- Índices para tabela `pedidos_tem_produtos`
--
ALTER TABLE `pedidos_tem_produtos`
  ADD KEY `Produtos_idProduto` (`Produtos_idProduto`),
  ADD KEY `Pedidos_idPedido` (`pedidos_idPedido`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `TipoProduto_idTipo_produto` (`tipoProduto_idtTipo_produto`);

--
-- Índices para tabela `tipoproduto`
--
ALTER TABLE `tipoproduto`
  ADD PRIMARY KEY (`idTipo_produto`);

--
-- Índices para tabela `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idTipo`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `tipo_usuario_idTipo` (`tipo_usuario_idTipo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo do pedido gerado por auto incremento', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo do produto', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tipoproduto`
--
ALTER TABLE `tipoproduto`
  MODIFY `idTipo_produto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo do produto gerado  por auto incremento', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo do tipo do usuario gerado por auto incremento', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo do usuario gerado por auto incremento', AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fkUsuarios_idUsuario` FOREIGN KEY (`usuarios_idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Limitadores para a tabela `pedidos_tem_produtos`
--
ALTER TABLE `pedidos_tem_produtos`
  ADD CONSTRAINT `fkPedidos_idPedido` FOREIGN KEY (`pedidos_idPedido`) REFERENCES `pedidos` (`idPedido`),
  ADD CONSTRAINT `fkProdutos_idProduto` FOREIGN KEY (`Produtos_idProduto`) REFERENCES `produtos` (`idProduto`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fkTipoProduto_idTipo_produto` FOREIGN KEY (`tipoProduto_idtTipo_produto`) REFERENCES `tipoproduto` (`idTipo_produto`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fkTipo_usuarios_idTipo` FOREIGN KEY (`tipo_usuario_idTipo`) REFERENCES `tipousuario` (`idTipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
