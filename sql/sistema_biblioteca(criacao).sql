-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/05/2023 às 02:14
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `alunoId` int(11) NOT NULL,
  `nomeAluno` varchar(45) NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `rg` varchar(45) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `dataNascimento` date NOT NULL,
  `email` varchar(15) NOT NULL,
  `cep` varchar(15) NOT NULL,
  `logradouro` varchar(15) NOT NULL,
  `bairroId` int(11) NOT NULL,
  `cidadeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `autor`
--

CREATE TABLE `autor` (
  `autorId` int(11) NOT NULL,
  `nomeAutor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autor`
--

INSERT INTO `autor` (`autorId`, `nomeAutor`) VALUES
(1, 'Paula Tejano');

-- --------------------------------------------------------

--
-- Estrutura para tabela `autorlivro`
--

CREATE TABLE `autorlivro` (
  `autorLivroId` int(11) NOT NULL,
  `autorId` int(11) NOT NULL,
  `livroId` int(11) NOT NULL,
  `autorLivrocol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `autorlivro`
--

INSERT INTO `autorlivro` (`autorLivroId`, `autorId`, `livroId`, `autorLivrocol`) VALUES
(1, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `bairro`
--

CREATE TABLE `bairro` (
  `bairroId` int(11) NOT NULL,
  `nomeBairro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidade`
--

CREATE TABLE `cidade` (
  `cidadeId` int(11) NOT NULL,
  `nomeCidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `editora`
--

CREATE TABLE `editora` (
  `editoraId` int(11) NOT NULL,
  `nomeEditora` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `editora`
--

INSERT INTO `editora` (`editoraId`, `nomeEditora`) VALUES
(20, 'Lindomar Editorial');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimolivro`
--

CREATE TABLE `emprestimolivro` (
  `emprestimoLivroId` int(11) NOT NULL,
  `exemplarLivroId` int(11) NOT NULL,
  `alunoId` int(11) NOT NULL,
  `dataEmprestimo` date NOT NULL,
  `dataRetorno` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `exemplarlivro`
--

CREATE TABLE `exemplarlivro` (
  `exemplarLivroId` int(11) NOT NULL,
  `livroId` int(11) NOT NULL,
  `numeroExemplar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE `livro` (
  `livroId` int(11) NOT NULL,
  `editoraId` int(11) NOT NULL,
  `nomeLivro` varchar(45) NOT NULL,
  `anoPublicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livro`
--

INSERT INTO `livro` (`livroId`, `editoraId`, `nomeLivro`, `anoPublicacao`) VALUES
(2, 20, 'CRUD PHP', 2023);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`alunoId`),
  ADD KEY `fk_bairro_aluno` (`bairroId`),
  ADD KEY `fk_cidade_aluno` (`cidadeId`);

--
-- Índices de tabela `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`autorId`);

--
-- Índices de tabela `autorlivro`
--
ALTER TABLE `autorlivro`
  ADD PRIMARY KEY (`autorLivroId`),
  ADD KEY `fk_autor_autor_livro` (`autorId`),
  ADD KEY `fk_autor_livro_livro` (`livroId`);

--
-- Índices de tabela `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`bairroId`);

--
-- Índices de tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`cidadeId`);

--
-- Índices de tabela `editora`
--
ALTER TABLE `editora`
  ADD PRIMARY KEY (`editoraId`);

--
-- Índices de tabela `emprestimolivro`
--
ALTER TABLE `emprestimolivro`
  ADD PRIMARY KEY (`emprestimoLivroId`),
  ADD KEY `fk_exLivro_empLivro` (`exemplarLivroId`),
  ADD KEY `fk_empLivro_aluno` (`alunoId`);

--
-- Índices de tabela `exemplarlivro`
--
ALTER TABLE `exemplarlivro`
  ADD PRIMARY KEY (`exemplarLivroId`),
  ADD KEY `fk_exLivro_livro` (`livroId`);

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`livroId`),
  ADD KEY `fk_livro_editora` (`editoraId`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `alunoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `autor`
--
ALTER TABLE `autor`
  MODIFY `autorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `autorlivro`
--
ALTER TABLE `autorlivro`
  MODIFY `autorLivroId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `bairro`
--
ALTER TABLE `bairro`
  MODIFY `bairroId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `cidadeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `editora`
--
ALTER TABLE `editora`
  MODIFY `editoraId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `emprestimolivro`
--
ALTER TABLE `emprestimolivro`
  MODIFY `emprestimoLivroId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `exemplarlivro`
--
ALTER TABLE `exemplarlivro`
  MODIFY `exemplarLivroId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `livroId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_bairro_aluno` FOREIGN KEY (`bairroId`) REFERENCES `bairro` (`bairroId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cidade_aluno` FOREIGN KEY (`cidadeId`) REFERENCES `cidade` (`cidadeId`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `autorlivro`
--
ALTER TABLE `autorlivro`
  ADD CONSTRAINT `fk_autor_autor_livro` FOREIGN KEY (`autorId`) REFERENCES `autor` (`autorId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_autor_livro_livro` FOREIGN KEY (`livroId`) REFERENCES `livro` (`livroId`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `emprestimolivro`
--
ALTER TABLE `emprestimolivro`
  ADD CONSTRAINT `fk_empLivro_aluno` FOREIGN KEY (`alunoId`) REFERENCES `aluno` (`alunoId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_exLivro_empLivro` FOREIGN KEY (`exemplarLivroId`) REFERENCES `exemplarlivro` (`exemplarLivroId`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `exemplarlivro`
--
ALTER TABLE `exemplarlivro`
  ADD CONSTRAINT `fk_exLivro_livro` FOREIGN KEY (`livroId`) REFERENCES `livro` (`livroId`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `fk_livro_editora` FOREIGN KEY (`editoraId`) REFERENCES `editora` (`editoraId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
