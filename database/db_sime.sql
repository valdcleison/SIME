-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Set-2018 às 20:28
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sime`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_users_create` (`pnomepessoa` VARCHAR(100), `pcpfpessoa` VARCHAR(14), `pemailpessoa` VARCHAR(60), `pusuario` VARCHAR(60), `psenha` VARCHAR(150))  BEGIN
	
    DECLARE vidpessoa INT;
    
    INSERT INTO pessoa (nomepessoa, cpfpessoa) VALUES (pnomepessoa, pcpfpessoa);
    
    SET vidpessoa = LAST_INSERT_ID();
    
    INSERT INTO usuario (emailpessoa, usuario, senha, niveladmin, idpessoa) VALUES (pemailpessoa, pusuario, psenha, 2, vidpessoa);
    
    SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.niveladmin = 2 ORDER BY b.nomepessoa;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_user_update` (`piduser` INT, `pnomepessoa` VARCHAR(100), `pcpfpessoa` VARCHAR(14), `pemailpessoa` VARCHAR(150), `pusuario` VARCHAR(60))  BEGIN
DECLARE vidpessoa INT;

	SELECT idpessoa INTO vidpessoa
	FROM usuario
	WHERE idusuario = piduser;

	UPDATE pessoa
	SET nomepessoa = pnomepessoa,
	cpfpessoa  = pcpfpessoa
	WHERE idpessoa = vidpessoa;

	UPDATE usuario
	SET  
	emailpessoa = pemailpessoa,
	usuario =pusuario 
	WHERE idusuario = piduser;
	
	SELECT * FROM usuario a INNER JOIN pessoa b USING(idpessoa) WHERE a.idusuario = piduser;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `idaluno` int(11) NOT NULL,
  `numeromatricula` varchar(45) NOT NULL,
  `endereco_idendereco` int(11) NOT NULL,
  `contato_idcontato` int(11) NOT NULL,
  `pessoa_idpessoa` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `anoletivo`
--

CREATE TABLE `anoletivo` (
  `idanoletivo` int(11) NOT NULL,
  `anoletivo` int(11) NOT NULL,
  `dtinicio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `idcontato` int(11) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `telefone2` varchar(11) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `idendereco` int(11) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `cep` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `idescola` int(11) NOT NULL,
  `nomeescola` varchar(150) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `localizacao` varchar(150) NOT NULL,
  `contato_idcontato` int(11) NOT NULL,
  `anoletivo_idanoletivo` int(11) NOT NULL,
  `endereco_idendereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

CREATE TABLE `frequencia` (
  `idfrequencia` int(11) NOT NULL,
  `qtalunospresentes` int(11) NOT NULL,
  `qtalunosausentes` int(11) DEFAULT NULL,
  `dtfrequencia` date NOT NULL,
  `hrinicio` datetime DEFAULT NULL,
  `hrtermino` datetime DEFAULT NULL,
  `escola_idescola` int(11) NOT NULL,
  `escola_gestor_idgestor` int(11) NOT NULL,
  `escola_contato_idcontato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequenciaaluno`
--

CREATE TABLE `frequenciaaluno` (
  `idfrequenciaaluno` int(11) NOT NULL,
  `data` date NOT NULL,
  `hrentrada` datetime NOT NULL,
  `hrsaida` datetime NOT NULL,
  `matricula_idmatricula` int(11) NOT NULL,
  `ocorrencia_idocorrencia` int(11) NOT NULL,
  `frequenciaocorrecia_idfrequenciaocorrecia` int(11) NOT NULL,
  `frequencia_idfrequencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequenciaocorrecia`
--

CREATE TABLE `frequenciaocorrecia` (
  `idfrequenciaocorrecia` int(11) NOT NULL,
  `frequenciaocorrecia` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL,
  `aluno_idaluno` int(11) NOT NULL,
  `anoletivo_idanoletivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencia`
--

CREATE TABLE `ocorrencia` (
  `idocorrencia` int(11) NOT NULL,
  `ocorrencia` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `idpessoa` int(11) NOT NULL,
  `nomepessoa` varchar(150) NOT NULL,
  `cpfpessoa` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`idpessoa`, `nomepessoa`, `cpfpessoa`) VALUES
(1, 'valdcleison', '11958005410'),
(2, ':pnomepessoa', 'aa'),
(3, 'wjotas', 'wjotas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel`
--

CREATE TABLE `responsavel` (
  `idresponsavel` int(11) NOT NULL,
  `contato_idcontato` int(11) NOT NULL,
  `endereco_idendereco` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretario`
--

CREATE TABLE `secretario` (
  `idsecretario` int(11) NOT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `pessoa_idpessoa` int(11) NOT NULL,
  `contato_idcontato` int(11) NOT NULL,
  `endereco_idendereco` int(11) NOT NULL,
  `usuario_idusuario` int(11) NOT NULL,
  `escola_idescola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacoes`
--

CREATE TABLE `solicitacoes` (
  `idsolicitacoes` int(11) NOT NULL,
  `dtsolicitacoes` date NOT NULL,
  `escola_idescola` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `emailpessoa` varchar(30) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `niveladmin` int(11) NOT NULL,
  `idpessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idusuario`, `emailpessoa`, `usuario`, `senha`, `niveladmin`, `idpessoa`) VALUES
(1, 'admin@sime.com.br', 'admin', '$2y$12$SfF0fPgB/42E5g9.uZYSq.wo4WLTjrqsnAwQ4mbQfmv515xtUHf6y', 2, 1),
(2, 'sa', 'aaa', 'aaa', 2, 2),
(3, 'wjotas', 'wjotas', 'wjotas', 2, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuariorecuperarsenha`
--

CREATE TABLE `usuariorecuperarsenha` (
  `idusuariorecuperarsenha` int(11) NOT NULL,
  `dtrecuperacao` datetime DEFAULT NULL,
  `iprecuperacao` varchar(45) NOT NULL,
  `dtregistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`idaluno`),
  ADD KEY `fk_aluno_endereco1_idx` (`endereco_idendereco`),
  ADD KEY `fk_aluno_contato1_idx` (`contato_idcontato`),
  ADD KEY `fk_aluno_pessoa1_idx` (`pessoa_idpessoa`),
  ADD KEY `fk_aluno_usuario1_idx` (`usuario_idusuario`);

--
-- Indexes for table `anoletivo`
--
ALTER TABLE `anoletivo`
  ADD PRIMARY KEY (`idanoletivo`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`idcontato`);

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idendereco`);

--
-- Indexes for table `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`idescola`,`contato_idcontato`),
  ADD KEY `fk_escola_contato1_idx` (`contato_idcontato`),
  ADD KEY `fk_escola_anoletivo1_idx` (`anoletivo_idanoletivo`),
  ADD KEY `fk_escola_endereco1_idx` (`endereco_idendereco`);

--
-- Indexes for table `frequencia`
--
ALTER TABLE `frequencia`
  ADD PRIMARY KEY (`idfrequencia`),
  ADD KEY `fk_frequencia_escola1_idx` (`escola_idescola`,`escola_gestor_idgestor`,`escola_contato_idcontato`),
  ADD KEY `fk_frequencia_escola1` (`escola_idescola`,`escola_contato_idcontato`);

--
-- Indexes for table `frequenciaaluno`
--
ALTER TABLE `frequenciaaluno`
  ADD PRIMARY KEY (`idfrequenciaaluno`),
  ADD KEY `fk_frequenciaaluno_matricula1_idx` (`matricula_idmatricula`),
  ADD KEY `fk_frequenciaaluno_ocorrencia1_idx` (`ocorrencia_idocorrencia`),
  ADD KEY `fk_frequenciaaluno_frequenciaocorrecia1_idx` (`frequenciaocorrecia_idfrequenciaocorrecia`),
  ADD KEY `fk_frequenciaaluno_frequencia1_idx` (`frequencia_idfrequencia`);

--
-- Indexes for table `frequenciaocorrecia`
--
ALTER TABLE `frequenciaocorrecia`
  ADD PRIMARY KEY (`idfrequenciaocorrecia`);

--
-- Indexes for table `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`idmatricula`,`anoletivo_idanoletivo`),
  ADD KEY `fk_matricula_aluno1_idx` (`aluno_idaluno`),
  ADD KEY `fk_matricula_anoletivo1_idx` (`anoletivo_idanoletivo`);

--
-- Indexes for table `ocorrencia`
--
ALTER TABLE `ocorrencia`
  ADD PRIMARY KEY (`idocorrencia`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`idpessoa`);

--
-- Indexes for table `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`idresponsavel`),
  ADD KEY `endereco_idendereco_idx` (`endereco_idendereco`),
  ADD KEY `contato_idcontato_idx` (`contato_idcontato`),
  ADD KEY `usuario_idusuario_idx` (`usuario_idusuario`);

--
-- Indexes for table `secretario`
--
ALTER TABLE `secretario`
  ADD PRIMARY KEY (`idsecretario`,`pessoa_idpessoa`),
  ADD KEY `fk_secretario_pessoa1_idx` (`pessoa_idpessoa`),
  ADD KEY `fk_secretario_contato1_idx` (`contato_idcontato`),
  ADD KEY `fk_secretario_endereco1_idx` (`endereco_idendereco`),
  ADD KEY `fk_secretario_usuario1_idx` (`usuario_idusuario`),
  ADD KEY `fk_secretario_escola1_idx` (`escola_idescola`);

--
-- Indexes for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD PRIMARY KEY (`idsolicitacoes`),
  ADD KEY `fk_solicitacoes_escola_idx` (`escola_idescola`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idpessoa_idx` (`idpessoa`);

--
-- Indexes for table `usuariorecuperarsenha`
--
ALTER TABLE `usuariorecuperarsenha`
  ADD PRIMARY KEY (`idusuariorecuperarsenha`),
  ADD KEY `fk_usuariorecuperarsenha_usuario1_idx` (`usuario_idusuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `idaluno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anoletivo`
--
ALTER TABLE `anoletivo`
  MODIFY `idanoletivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `idcontato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idendereco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `escola`
--
ALTER TABLE `escola`
  MODIFY `idescola` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frequencia`
--
ALTER TABLE `frequencia`
  MODIFY `idfrequencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frequenciaaluno`
--
ALTER TABLE `frequenciaaluno`
  MODIFY `idfrequenciaaluno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matricula`
--
ALTER TABLE `matricula`
  MODIFY `idmatricula` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ocorrencia`
--
ALTER TABLE `ocorrencia`
  MODIFY `idocorrencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `idpessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `idresponsavel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secretario`
--
ALTER TABLE `secretario`
  MODIFY `idsecretario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solicitacoes`
--
ALTER TABLE `solicitacoes`
  MODIFY `idsolicitacoes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuariorecuperarsenha`
--
ALTER TABLE `usuariorecuperarsenha`
  MODIFY `idusuariorecuperarsenha` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_contato1` FOREIGN KEY (`contato_idcontato`) REFERENCES `contato` (`idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aluno_endereco1` FOREIGN KEY (`endereco_idendereco`) REFERENCES `endereco` (`idendereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aluno_pessoa1` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aluno_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `escola`
--
ALTER TABLE `escola`
  ADD CONSTRAINT `fk_escola_anoletivo1` FOREIGN KEY (`anoletivo_idanoletivo`) REFERENCES `anoletivo` (`idanoletivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_escola_contato1` FOREIGN KEY (`contato_idcontato`) REFERENCES `contato` (`idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_escola_endereco1` FOREIGN KEY (`endereco_idendereco`) REFERENCES `endereco` (`idendereco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD CONSTRAINT `fk_frequencia_escola1` FOREIGN KEY (`escola_idescola`,`escola_contato_idcontato`) REFERENCES `escola` (`idescola`, `contato_idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `frequenciaaluno`
--
ALTER TABLE `frequenciaaluno`
  ADD CONSTRAINT `fk_frequenciaaluno_frequencia1` FOREIGN KEY (`frequencia_idfrequencia`) REFERENCES `frequencia` (`idfrequencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frequenciaaluno_frequenciaocorrecia1` FOREIGN KEY (`frequenciaocorrecia_idfrequenciaocorrecia`) REFERENCES `frequenciaocorrecia` (`idfrequenciaocorrecia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frequenciaaluno_matricula1` FOREIGN KEY (`matricula_idmatricula`) REFERENCES `matricula` (`idmatricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_frequenciaaluno_ocorrencia1` FOREIGN KEY (`ocorrencia_idocorrencia`) REFERENCES `ocorrencia` (`idocorrencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_matricula_aluno1` FOREIGN KEY (`aluno_idaluno`) REFERENCES `aluno` (`idaluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_anoletivo1` FOREIGN KEY (`anoletivo_idanoletivo`) REFERENCES `anoletivo` (`idanoletivo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `responsavel`
--
ALTER TABLE `responsavel`
  ADD CONSTRAINT `contato_idcontato` FOREIGN KEY (`contato_idcontato`) REFERENCES `contato` (`idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `endereco_idendereco` FOREIGN KEY (`endereco_idendereco`) REFERENCES `endereco` (`idendereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_idusuario` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `secretario`
--
ALTER TABLE `secretario`
  ADD CONSTRAINT `fk_secretario_contato1` FOREIGN KEY (`contato_idcontato`) REFERENCES `contato` (`idcontato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_secretario_endereco1` FOREIGN KEY (`endereco_idendereco`) REFERENCES `endereco` (`idendereco`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_secretario_escola1` FOREIGN KEY (`escola_idescola`) REFERENCES `escola` (`idescola`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_secretario_pessoa1` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_secretario_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `solicitacoes`
--
ALTER TABLE `solicitacoes`
  ADD CONSTRAINT `fk_solicitacoes_escola` FOREIGN KEY (`escola_idescola`) REFERENCES `escola` (`idescola`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `idpessoa` FOREIGN KEY (`idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuariorecuperarsenha`
--
ALTER TABLE `usuariorecuperarsenha`
  ADD CONSTRAINT `fk_usuariorecuperarsenha_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
