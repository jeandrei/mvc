-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2021 at 03:37 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS shareposts;

CREATE DATABASE shareposts CHARACTER SET utf8 COLLATE utf8_general_ci;

use shareposts;

--
-- Banco de dados: `shareposts`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estrutura para tabela `bairro`
--

CREATE TABLE `bairro` (
  `bairroId` int(11) NOT NULL,
  `bairroNome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `pessoaId` int(11) NOT NULL,
  `pessoaNome` varchar(255) NOT NULL,
  `pessoaEmail` varchar(255) NOT NULL,
  `pessoaTelefone` varchar(16) NOT NULL,
  `pessoaCelular` varchar(16) DEFAULT NULL,
  `pessoaMunicipio` varchar(255) DEFAULT NULL,
  `bairroId` int(11) DEFAULT NULL,  
  `pessoaLogradouro` varchar(255) DEFAULT NULL,
  `pessoaNumero` int(11) DEFAULT NULL,
  `pessoaUf` char(2) DEFAULT NULL,
  `pessoaNascimento` date NOT NULL,
  `pessoaDeficiencia` varchar(1) NOT NULL DEFAULT '0',
  `pessoaCpf` varchar(15) DEFAULT NULL,
  `pessoaCnpj` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Jeandrei', 'jeandreiwalter@gmail.com', '$2y$10$lyyCqzV/cJw5A8TpddC47Ow8K2iVHOHbKl.Nzs0fm/CgjuDBRZoMq', '2018-11-23 10:19:18'),
(2, 'teste1', 'teste1r@gmail.com', '$2y$10$Y3Phy8lW7ACZ41qrXjqOjuS26Jzj5WEoWa3mjNrNwWcHpyPKnOtji', '2018-11-27 15:29:36'),
(3, 'teste', 'jean.walter@penha.sc.gov.br', '$2y$10$EwxO3Gf78AQdSoVhVf6yxefdZFR2n3ON2w.t9XnyXsZPLJTNXfTGi', '2019-01-09 16:46:20'),
(4, 'jeandrei', 'jeandreiwalter@educapenha.com.br', '$2y$10$RczfzoEUQTT69IMzK6BxYO9nlzd/r.BP7e1JyUaPNV0Hjva1c2ZOq', '2020-06-21 19:13:23');



--
-- Despejando dados para a tabela `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`) VALUES
(2, 1, 'Post Two', 'This is a test for post two', '2018-11-27 20:01:26');


--
-- Despejando dados para a tabela `bairro`
--

INSERT INTO `bairro` (`bairroId`, `bairroNome`) VALUES
(1, 'Armação'),
(2, 'Gravata'),
(3, 'Santa Lídia'),
(4, 'Praia Alegre'),
(5, 'Centro'),
(6, 'São Nicolau'),
(7, 'NSra de Fátima'),
(8, 'São Cristovão'),
(9, 'São Francisco de Assis');

--
-- Despejando dados para a tabela `pessoa`
--
INSERT INTO `pessoa` (
                      `pessoaId`, 
                      `pessoaNome`, 
                      `pessoaEmail`, 
                      `pessoaTelefone`, 
                      `pessoaCelular`, 
                      `pessoaMunicipio`, 
                      `bairroId`, 
                      `pessoaLogradouro`, 
                      `pessoaNumero`,
                      `pessoaUf`,
                      `pessoaNascimento`,
                      `pessoaDeficiencia`,
                      `pessoaCpf`,
                      `pessoaCnpj`
                      ) VALUES 
                      (1,'Pessoa 01', 'pessoa01@gmail.com','(47) 3345-9853','(47) 99116-8963','Município 01',1,'Rua 01','01','SC','2018-11-23',0,'001','0001'),
                      (2,'Pessoa 02', 'pessoa02@gmail.com','(47) 3345-5854','(47) 99116-8963','Município 02',2,'Rua 02','02','SC','2018-11-23',0,'002','0002'),
                      (3,'Pessoa 03', 'pessoa03@gmail.com','(47) 3345-2457','(47) 99116-8963','Município 03',2,'Rua 03','03','SC','2018-11-23',1,'003','0003'),
                      (4,'Pessoa 04', 'pessoa04@gmail.com','(47) 3345-8965','(47) 99116-8963','Município 04',3,'Rua 04','04','SC','2018-11-23',1,'004','0004'),
                      (5,'Pessoa 05', 'pessoa05@gmail.com','(47) 3345-2369','(47) 99116-8963','Município 05',3,'Rua 05','05','SC','2018-11-23',1,'005','0005'),
                      (6,'Pessoa 06', 'pessoa06@gmail.com','(47) 3345-9852','(47) 99116-8963','Município 06',3,'Rua 06','06','SC','2018-11-23',1,'006','0006'),
                      (7,'Pessoa 07', 'pessoa07@gmail.com','(47) 3345-4853','(47) 99116-8963','Município 07',4,'Rua 07','07','SC','2018-11-23',0,'007','0007'),
                      (8,'Pessoa 08', 'pessoa08@gmail.com','(47) 3345-8452','(47) 99116-8963','Município 08',4,'Rua 08','08','SC','2018-11-23',0,'008','0008'),
                      (9,'Pessoa 09', 'pessoa09@gmail.com','(47) 3345-7821','(47) 99116-8963','Município 09',4,'Rua 09','09','SC','2018-11-23',0,'009','0009'),
                      (10,'Pessoa 10', 'pessoa10@gmail.com','(47) 3345-4831','(47) 99116-8963','Município 10',5,'Rua 10','10','SC','2018-11-23',0,'001O','00010'),
                      (11,'Pessoa 11', 'pessoa11@gmail.com','(47) 3345-4578','(47) 99116-8963','Município 11',5,'Rua 11','11','SC','2018-11-23',0,'0011','00011'),
                      (12,'Pessoa 12', 'pessoa12@gmail.com','(47) 3345-1287','(47) 99116-8963','Município 12',5,'Rua 12','12','SC','2018-11-23',1,'0012','00012'),
                      (13,'Pessoa 13', 'pessoa13@gmail.com','(47) 3345-3658','(47) 99116-8963','Município 13',5,'Rua 13','13','SC','2018-11-23',1,'0013','00013'),
                      (14,'Pessoa 14', 'pessoa14@gmail.com','(47) 3345-2147','(47) 99116-8963','Município 14',3,'Rua 14','14','SC','2018-11-23',1,'0014','00014'),
                      (15,'Pessoa 15', 'pessoa15@gmail.com','(47) 3345-2369','(47) 99116-8963','Município 15',3,'Rua 15','15','SC','2018-11-23',1,'0015','00015'),
                      (16,'Pessoa 16', 'pessoa16@gmail.com','(47) 3345-3698','(47) 99116-8963','Município 16',3,'Rua 16','16','SC','2018-11-23',1,'0016','00016'),
                      (17,'Pessoa 17', 'pessoa17@gmail.com','(47) 3345-2847','(47) 99116-8963','Município 17',1,'Rua 17','17','SC','2018-11-23',1,'0017','00017'),
                      (18,'Pessoa 18', 'pessoa18@gmail.com','(47) 3345-1369','(47) 99116-8963','Município 18',1,'Rua 18','18','SC','2018-11-23',0,'0018','00018'),
                      (19,'Pessoa 19', 'pessoa19@gmail.com','(47) 3345-8457','(47) 99116-8963','Município 19',4,'Rua 19','19','SC','2018-11-23',0,'0019','00019'),
                      (20,'Pessoa 20', 'pessoa20@gmail.com','(47) 3345-1348','(47) 99116-8963','Município 20',4,'Rua 20','20','SC','2018-11-23',1,'0020','00020'),
                      (21,'Pessoa 21', 'pessoa21@gmail.com','(47) 3345-8932','(47) 99116-8963','Município 21',4,'Rua 21','21','SC','2018-11-23',0,'0021','00021'),
                      (22,'Pessoa 22', 'pessoa22@gmail.com','(47) 3345-5287','(47) 99116-8963','Município 22',4,'Rua 22','22','SC','2018-11-23',0,'0022','00022'),
                      (23,'Pessoa 23', 'pessoa23@gmail.com','(47) 3345-5269','(47) 99116-8963','Município 23',4,'Rua 23','23','SC','2018-11-23',0,'0023','00023'),
                      (24,'Pessoa 24', 'pessoa24@gmail.com','(47) 3345-5697','(47) 99116-8963','Município 24',1,'Rua 24','24','SC','2018-11-23',0,'0024','00024'),
                      (25,'Pessoa 25', 'pessoa25@gmail.com','(47) 3345-8397','(47) 99116-8963','Município 25',1,'Rua 25','25','SC','2018-11-23',0,'0025','00025');






--
-- Índices de tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`bairroId`);

--
-- Índices de tabela `users`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`pessoaId`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

--
-- AUTO_INCREMENT de tabela `bairro`
--
ALTER TABLE `bairro`
  MODIFY `bairroId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `pessoaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

