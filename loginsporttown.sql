-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 12/06/2025 às 14:35
-- Versão do servidor: 8.0.42
-- Versão do PHP: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loginsporttown`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `camps`
--

CREATE TABLE `camps` (
  `id` int NOT NULL,
  `nome` varchar(500) NOT NULL,
  `nome_dono` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `senha` varchar(225) NOT NULL,
  `nicho` varchar(500) NOT NULL,
  `cep` varchar(200) NOT NULL,
  `logradouro` varchar(200) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `cnpj` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `camps`
--

INSERT INTO `camps` (`id`, `nome`, `nome_dono`, `email`, `senha`, `nicho`, `cep`, `logradouro`, `cidade`, `bairro`, `estado`, `cnpj`, `criado_em`) VALUES
(8, 'Copa TV', 'Papeis', 'papeis@p.com', '$2y$10$33l./6KLU5q4.vtyhDR0Ie9utW0cBoIDJMLzYFT.gTYxBQsCeEIqK', 'Futsal', '01001-000', 'Praça da Sé', 'São Paulo', 'Sé', 'SP', '99.999.999/9999-99', '2025-06-12 13:30:42'),
(9, 'rolinois', 'Papeis', 'papeis@p.com', '$2y$10$8Fe8PMXHObGrNrZeiIhKeu8TiE84eFsHGoMtDYpOXRutVG4fkHFMe', 'Futebol', '01001-000', 'Praça da Sé', 'São Paulo', 'Sé', 'SP', '99.999.999/9999-99', '2025-06-12 13:35:07'),
(10, 'Mayara', 'Mayara', 'sobral@s.com', '$2y$10$4RKiOXPbJ5PtKG464WtBaOmLLUnvl1htKdrF/y.2PInLbs./cLnOm', 'Futebol', '01001-000', 'Praça da Sé', 'São Paulo', 'Sé', 'SP', '55.555.555/5555-55', '2025-06-12 13:46:49'),
(11, 'EliGostoso', 'Mayara', 'sobral@s.com', '$2y$10$yhn0t2cRmnv3SyuNbch4z.Lbg2jHc04mSdMT7T/i11XLrk06QIWkC', 'Futebol', '63502-275', 'Rua Padre Cícero', 'Iguatu', 'Santo Antônio', 'CE', '55.555.555/5555-55', '2025-06-12 14:06:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int NOT NULL,
  `nome` varchar(500) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `email` varchar(500) NOT NULL,
  `senha` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`id`, `nome`, `cnpj`, `email`, `senha`) VALUES
(3, 'Plasticos', '001002', 'plasticos@h.com', '$2y$10$fh236Kq/gkEMfMAWhGE5Gu.KMS8JIRnpvsqdfoVjywsAEjwWjYajm'),
(5, 'Papeis', '99.999.999/9999-99', 'papeis@p.com', '$2y$10$O6zumoxYagmHgJD49m9PCejfTK/E.cRpaadJ1CKAYyK8uatrgUreG'),
(6, 'tesoura', '88.888.888/8888-88', 'tesoura@t.com', '$2y$10$TXNsCF/UdwyOqvNI.8re.uYHpjiMvK1qXZy370RA2IV.5Mqns1fyS'),
(7, 'Mayara', '66.666.666/6666-66', 'Mayara@m.com', '$2y$10$dI/ms85WNY.kCdFAbP.Doe3N4mL/7FljckFqEIw58mbdXxI9ATFdO'),
(8, 'Mayara', '55.555.555/5555-55', 'sobral@s.com', '$2y$10$GpsdX/oLk1qvSM2rOzUczezTzPCTeHhZEa/NIzhSAQ/9TM52D.hJ2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `tipo` enum('usuario','empresa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(140) NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(17, 'Heitor', 'lima@lima.com', '$2y$10$VeQv/j6aNCg5geXAVJpTgOmpX62WFibAfzVzzdBc/LXVmBwXCwS9C'),
(18, 'Witney', 'heitor.lima@aluno.ce.gov.br', '$2y$10$zW7dzJ42dZrJ3961H3VWb.JQJbODa3M70U7eKyGzulV.8JdN194FC'),
(23, 'rolinois', 'intu@i.com', '$2y$10$MLikocNDZm8X/PbOZkLy2.173ENkv.LGbsLIeemCuYXEFROtpbggO'),
(24, 'Mayara', 'Mayara@m.com', '$2y$10$c9dxdDPEHECT1qz0NhrIpumneAEEbTPeMQlwry0B0IS0BniPz1O/.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `camps`
--
ALTER TABLE `camps`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `camps`
--
ALTER TABLE `camps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
