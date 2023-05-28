CREATE TABLE IF NOT EXISTS `sistema_biblioteca`.`aluno` (
  `alunoId` INT NOT NULL AUTO_INCREMENT,
  `nomeAluno` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `rg` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`alunoId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistema_biblioteca`.`editora` (
  `editoraId` INT NOT NULL AUTO_INCREMENT,
  `nomeEditora` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`editoraId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistema_biblioteca`.`livro` (
  `livroId` INT NOT NULL AUTO_INCREMENT,
  `editoraId` INT NOT NULL,
  `nomeLivro` VARCHAR(45) NOT NULL,
  `anoPublicacao` INT NOT NULL,
  PRIMARY KEY (`livroId`))
  ENGINE = InnoDB;
  
  CREATE TABLE IF NOT EXISTS `sistema_biblioteca`.`autor` (
  `autorId` INT NOT NULL AUTO_INCREMENT,
  `nomeAutor` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`autorId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistema_biblioteca`.`exemplarLivro` (
  `exemplarLivroId` INT NOT NULL AUTO_INCREMENT,
  `livroId` INT NOT NULL,
  `numeroExemplar` INT NULL,
  PRIMARY KEY (`exemplarLivroId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistema_biblioteca`.`autorLivro` (
  `autorLivroId` INT NOT NULL AUTO_INCREMENT,
  `autorId` INT NOT NULL,
  `livroId` INT NOT NULL,
  `autorLivrocol` VARCHAR(45) NULL,
  PRIMARY KEY (`autorLivroId`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistema_biblioteca`.`emprestimoLivro` (
  `emprestimoLivroId` INT NOT NULL AUTO_INCREMENT,
  `exemplarLivroId` INT NOT NULL,
  `alunoId` INT NOT NULL,
  `dataEmprestimo` DATE NOT NULL,
  `dataRetorno` DATE NOT NULL,
  PRIMARY KEY (`emprestimoLivroId`))
ENGINE = InnoDB;

alter table livro
add constraint fk_livro_editora
foreign key (editoraId)
references editora(editoraId) on update cascade;

alter table autorlivro
add constraint fk_autor_autor_livro
foreign key (autorId)
references autor(autorId) on update cascade,
add constraint fk_autor_livro_livro
foreign key(livroId)
references livro(livroId) on update cascade;

alter table exemplarlivro
add constraint fk_exLivro_livro
foreign key (livroId)
references livro (livroId) on update cascade;

alter table emprestimolivro
add constraint fk_exLivro_empLivro
foreign key (exemplarLivroId)
references exemplarlivro (exemplarLivroId) on update cascade,
add constraint fk_empLivro_aluno
foreign key (alunoId)
references aluno (alunoId) on update cascade;

