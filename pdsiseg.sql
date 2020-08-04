-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Maio-2020 às 02:55
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdsiseg`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cesto`
--

CREATE TABLE `cesto` (
  `idUsername` varchar(50) NOT NULL,
  `idProduct` varchar(50) NOT NULL,
  `idUsernameSell` varchar(50) NOT NULL,
  `quantidade` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cestodesigners`
--

CREATE TABLE `cestodesigners` (
  `idUsername` varchar(50) NOT NULL,
  `idProduct` varchar(50) NOT NULL,
  `idStore` varchar(50) NOT NULL,
  `tamanho` varchar(5) NOT NULL,
  `quant` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chat`
--

CREATE TABLE `chat` (
  `id_send` varchar(50) NOT NULL,
  `id_receive` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL,
  `data` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `chat`
--

INSERT INTO `chat` (`id_send`, `id_receive`, `message`, `data`) VALUES
('rodrigo', 'leonor', 'OlÃ¡', '05/09/2020 06:39:18 pm'),
('rodrigo', 'leonor', 'Tudo bem ', '05/09/2020 08:56:50 pm'),
('leonor', 'rodrigo', 'Ola, sim estÃ¡ tudo', '05/09/2020 08:57:38 pm'),
('leonor', 'rodrigo', 'Onde arranjaste aquele vestido ?', '05/09/2020 09:33:14 pm'),
('leonor', 'rodrigo', 'Ã‰ muito giro', '05/09/2020 09:33:30 pm'),
('leonor', 'rodrigo', 'Que fazes ?', '05/09/2020 09:53:30 pm'),
('rodrigo', 'leonor', 'Nada e tu ?', '05/09/2020 09:51:16 pm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_envio`
--

CREATE TABLE `dados_envio` (
  `idPedido` int(10) NOT NULL,
  `morada` varchar(200) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `local` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_enviodesigners`
--

CREATE TABLE `dados_enviodesigners` (
  `idPedido` varchar(15) NOT NULL,
  `morada` varchar(200) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `local` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `followers`
--

CREATE TABLE `followers` (
  `idSeguidor` varchar(50) NOT NULL,
  `idSeguido` varchar(50) NOT NULL,
  `estado_seguir` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `followers`
--

INSERT INTO `followers` (`idSeguidor`, `idSeguido`, `estado_seguir`) VALUES
('rodrigo', 'leonor', 'confirmado'),
('leonor', 'rodrigo', 'confirmado'),
('ze', 'rodrigo', 'confirmado'),
('rodrigo', 'ze', 'confirmado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `looks`
--

CREATE TABLE `looks` (
  `idLook` int(10) NOT NULL,
  `idUtilizador` varchar(50) NOT NULL,
  `nameLook` varchar(30) DEFAULT NULL,
  `typeLook` varchar(20) DEFAULT NULL,
  `product1` varchar(50) DEFAULT NULL,
  `product2` varchar(50) DEFAULT NULL,
  `product3` varchar(50) DEFAULT NULL,
  `product4` varchar(50) DEFAULT NULL,
  `product5` varchar(50) DEFAULT NULL,
  `product6` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `idPedido` int(10) NOT NULL,
  `metodo` varchar(20) NOT NULL,
  `numeroCartao` int(20) DEFAULT NULL,
  `titularCartao` varchar(50) DEFAULT NULL,
  `mesCartao` int(5) DEFAULT NULL,
  `anoCartao` int(5) DEFAULT NULL,
  `cvcCartao` int(3) DEFAULT NULL,
  `entidadeMB` int(5) DEFAULT NULL,
  `referenciaMB` int(10) DEFAULT NULL,
  `precoTotal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentodesigners`
--

CREATE TABLE `pagamentodesigners` (
  `idPedido` int(10) NOT NULL,
  `metodo` varchar(20) NOT NULL,
  `numeroCartao` int(20) DEFAULT NULL,
  `titularCartao` varchar(50) DEFAULT NULL,
  `mesCartao` int(5) DEFAULT NULL,
  `anoCartao` int(5) DEFAULT NULL,
  `cvcCartao` int(3) DEFAULT NULL,
  `entidadeMB` int(10) DEFAULT NULL,
  `referenciaMB` int(10) DEFAULT NULL,
  `precoTotal` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos2mao`
--

CREATE TABLE `pedidos2mao` (
  `idPedido` int(10) NOT NULL,
  `idUsername` varchar(50) NOT NULL,
  `estado_pedido` varchar(20) NOT NULL,
  `data` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidosdesigners`
--

CREATE TABLE `pedidosdesigners` (
  `idPedido` int(10) NOT NULL,
  `idUsername` varchar(70) NOT NULL,
  `estado_pedido` varchar(30) NOT NULL,
  `data` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `productsd`
--

CREATE TABLE `productsd` (
  `id` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `brand` varchar(70) NOT NULL,
  `descricao` varchar(9000) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(20) NOT NULL,
  `utility` varchar(20) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `preco` float NOT NULL,
  `clicks` int(10) NOT NULL,
  `image` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `productsu`
--

CREATE TABLE `productsu` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `brand` varchar(30) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `utility` varchar(30) DEFAULT NULL,
  `gender` varchar(3) DEFAULT NULL,
  `image` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products_pedido`
--

CREATE TABLE `products_pedido` (
  `idPedido` int(10) NOT NULL,
  `idProduct` varchar(50) NOT NULL,
  `idSell` varchar(50) NOT NULL,
  `estado_entrega` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products_pedidodesigners`
--

CREATE TABLE `products_pedidodesigners` (
  `idPedido` int(10) NOT NULL,
  `idProduct` varchar(15) NOT NULL,
  `idSell` varchar(50) NOT NULL,
  `tamanho` varchar(5) NOT NULL,
  `estado_entrega` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `products_wishlist`
--

CREATE TABLE `products_wishlist` (
  `idWishlist` int(10) NOT NULL,
  `idProduct` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reset_token`
--

CREATE TABLE `reset_token` (
  `idUsername` varchar(50) NOT NULL,
  `token` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `stocksstores`
--

CREATE TABLE `stocksstores` (
  `idProduct` varchar(20) NOT NULL,
  `tamanho` varchar(5) NOT NULL,
  `quantidade` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `storage`
--

CREATE TABLE `storage` (
  `idUtilizador` varchar(100) DEFAULT NULL,
  `idStore` varchar(100) DEFAULT NULL,
  `data` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `stores`
--

CREATE TABLE `stores` (
  `storename` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `slogan` varchar(300) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `question` varchar(70) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `plano` varchar(20) NOT NULL,
  `photoUpload` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `stores`
--

INSERT INTO `stores` (`storename`, `password`, `email`, `firstName`, `slogan`, `birthday`, `country`, `question`, `answer`, `plano`, `photoUpload`) VALUES
('lojadoze', '2a30b5bdc3f31b44f61058b96e9994e1e4f7fbfe', 'lojadoze@gmail.com', 'Loja do ZÃ©', 'Tudo o que queres e não queres', '2020-03-13', 'Portugal', '1animal', 'asd', 'Premium', 'sim'),
('buja', '17887ea00a254c74aa50c30fc280277928e6d50a', 'buja@gmail.com', 'Buja', 'Dura Buja sed Buja', '2016-09-12', 'Portugal', 'desportoFavorito', 'buja', 'Free', 'sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subscriptionstores`
--

CREATE TABLE `subscriptionstores` (
  `idSubscription` int(10) NOT NULL,
  `idStore` varchar(70) NOT NULL,
  `metodoPagamento` varchar(30) NOT NULL,
  `cardNumber` varchar(30) DEFAULT NULL,
  `cardMonth` varchar(10) DEFAULT NULL,
  `cardYear` varchar(10) DEFAULT NULL,
  `cardCVC` varchar(20) DEFAULT NULL,
  `actualMonth` varchar(20) NOT NULL,
  `actualYear` varchar(10) NOT NULL,
  `price` varchar(10) NOT NULL,
  `actualDate` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subscriptionusers`
--

CREATE TABLE `subscriptionusers` (
  `idSubscription` int(10) NOT NULL,
  `idUsername` varchar(70) NOT NULL,
  `metodoPagamento` varchar(20) NOT NULL,
  `cardNumber` varchar(30) DEFAULT NULL,
  `cardMonth` varchar(10) DEFAULT NULL,
  `cardYear` varchar(10) DEFAULT NULL,
  `cvc` varchar(30) DEFAULT NULL,
  `actualMonth` varchar(20) NOT NULL,
  `actualYear` varchar(20) NOT NULL,
  `price` varchar(30) NOT NULL,
  `actualDate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `gender` varchar(9) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `question` varchar(70) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `typeAccount` varchar(20) DEFAULT NULL,
  `photoUpload` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `firstName`, `lastName`, `gender`, `birthday`, `country`, `question`, `answer`, `typeAccount`, `photoUpload`) VALUES
('rodrigo', '6dfa9cecb562e345739f2e4eb69e9ebd0fbff687', 'roal@live.com.pt', 'Rodrigo', 'Alcarva', 'M', '1998-11-13', 'Portugal', 'desportoFavorito', 'futebol', 'Free', 'sim'),
('leonor', 'ded16695cd481df6766c673e6499483010dac164', 'leonor@gmail.com', 'Ana', 'Leonor', 'F', '1998-04-23', 'Portugal', 'desportoFavorito', 'sofa', 'Free', 'sim'),
('ze', '2a30b5bdc3f31b44f61058b96e9994e1e4f7fbfe', 'ze@gmail.com', 'JosÃ©', 'QueirÃ³s', 'M', '1996-02-12', 'Portugal', 'desportoFavorito', 'basket', 'Free', 'sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda2mao`
--

CREATE TABLE `venda2mao` (
  `idUsername` varchar(60) NOT NULL,
  `idProduct` varchar(30) NOT NULL,
  `tamanho` varchar(5) DEFAULT NULL,
  `preco` varchar(15) DEFAULT NULL,
  `titulo` varchar(70) DEFAULT NULL,
  `descricao` varchar(9000) DEFAULT NULL,
  `localizacao` varchar(100) DEFAULT NULL,
  `clicks` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `wishlists`
--

CREATE TABLE `wishlists` (
  `idWishlist` int(10) NOT NULL,
  `idUser` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `looks`
--
ALTER TABLE `looks`
  ADD PRIMARY KEY (`idLook`);

--
-- Indexes for table `pagamentodesigners`
--
ALTER TABLE `pagamentodesigners`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indexes for table `pedidos2mao`
--
ALTER TABLE `pedidos2mao`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indexes for table `pedidosdesigners`
--
ALTER TABLE `pedidosdesigners`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indexes for table `productsu`
--
ALTER TABLE `productsu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptionstores`
--
ALTER TABLE `subscriptionstores`
  ADD PRIMARY KEY (`idSubscription`);

--
-- Indexes for table `subscriptionusers`
--
ALTER TABLE `subscriptionusers`
  ADD PRIMARY KEY (`idSubscription`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`idWishlist`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `looks`
--
ALTER TABLE `looks`
  MODIFY `idLook` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pagamentodesigners`
--
ALTER TABLE `pagamentodesigners`
  MODIFY `idPedido` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pedidos2mao`
--
ALTER TABLE `pedidos2mao`
  MODIFY `idPedido` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pedidosdesigners`
--
ALTER TABLE `pedidosdesigners`
  MODIFY `idPedido` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptionstores`
--
ALTER TABLE `subscriptionstores`
  MODIFY `idSubscription` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptionusers`
--
ALTER TABLE `subscriptionusers`
  MODIFY `idSubscription` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `idWishlist` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
