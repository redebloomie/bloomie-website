-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.33 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para bloomie_db
CREATE DATABASE IF NOT EXISTS `bloomie_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bloomie_db`;

-- Copiando estrutura para tabela bloomie_db.adm
CREATE TABLE IF NOT EXISTS `adm` (
  `ID_adm` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  PRIMARY KEY (`ID_adm`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `ID_usuario` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.adm: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `adm` DISABLE KEYS */;
/*!40000 ALTER TABLE `adm` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.banimento
CREATE TABLE IF NOT EXISTS `banimento` (
  `ID_banimento` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `data_banimento` datetime NOT NULL,
  `motivo` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_banimento`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `FK_banimento_usuario` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.banimento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `banimento` DISABLE KEYS */;
/*!40000 ALTER TABLE `banimento` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.bloomizade
CREATE TABLE IF NOT EXISTS `bloomizade` (
  `bloomizade` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) DEFAULT NULL,
  `ID_bloomigo` int(11) DEFAULT NULL,
  PRIMARY KEY (`bloomizade`),
  KEY `ID_usuario` (`ID_usuario`),
  KEY `ID_bloomigo` (`ID_bloomigo`),
  CONSTRAINT `usuario1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuario2` FOREIGN KEY (`ID_bloomigo`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.bloomizade: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `bloomizade` DISABLE KEYS */;
/*!40000 ALTER TABLE `bloomizade` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `ID_comentario` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `comentario` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`ID_comentario`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `comentarios` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.comentarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.conta_inativa
CREATE TABLE IF NOT EXISTS `conta_inativa` (
  `ID_conta_inativa` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `data_inatividade` datetime NOT NULL,
  `motivo` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_conta_inativa`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `usuario_inativo` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.conta_inativa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `conta_inativa` DISABLE KEYS */;
/*!40000 ALTER TABLE `conta_inativa` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.curtidas
CREATE TABLE IF NOT EXISTS `curtidas` (
  `ID_curtida` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  PRIMARY KEY (`ID_curtida`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `curtida` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.curtidas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `curtidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `curtidas` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `ID_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(250) NOT NULL DEFAULT '',
  `setor_empresa` varchar(250) NOT NULL DEFAULT '',
  `email_empresa` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.empresa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.estudante
CREATE TABLE IF NOT EXISTS `estudante` (
  `ID_estudante` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `instituicao` varchar(150) DEFAULT NULL,
  `interesse1` varchar(64) DEFAULT NULL,
  `interesse2` varchar(64) DEFAULT NULL,
  `interesse3` varchar(64) DEFAULT NULL,
  `interesse4` varchar(64) DEFAULT NULL,
  `interesse5` varchar(64) DEFAULT NULL,
  `data_nasc` date NOT NULL,
  `personalidade` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID_estudante`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `estudante` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.estudante: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estudante` DISABLE KEYS */;
INSERT INTO `estudante` (`ID_estudante`, `ID_usuario`, `instituicao`, `interesse1`, `interesse2`, `interesse3`, `interesse4`, `interesse5`, `data_nasc`, `personalidade`) VALUES
	(1, 10, NULL, NULL, NULL, NULL, NULL, NULL, '1969-12-31', ''),
	(2, 11, NULL, NULL, NULL, NULL, NULL, NULL, '1969-12-31', ''),
	(3, 12, NULL, NULL, NULL, NULL, NULL, NULL, '1969-12-31', '');
/*!40000 ALTER TABLE `estudante` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.mentor
CREATE TABLE IF NOT EXISTS `mentor` (
  `ID_mentor` int(11) NOT NULL AUTO_INCREMENT,
  `nome_mentor` varchar(32) NOT NULL,
  `sobrenome_mentor` varchar(32) NOT NULL,
  `email_mentor` varchar(256) DEFAULT NULL,
  `setor_mentor` varchar(256) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID_mentor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.mentor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mentor` DISABLE KEYS */;
/*!40000 ALTER TABLE `mentor` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.oportunidade
CREATE TABLE IF NOT EXISTS `oportunidade` (
  `ID_oportunidade` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) DEFAULT NULL,
  `data_publicacao` datetime NOT NULL,
  `categoria` varchar(150) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `imagem` varchar(64) DEFAULT NULL,
  `tipo_personalidade` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `status_opor` varchar(25) NOT NULL,
  `tempo_expirar` datetime NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `inicio` datetime NOT NULL,
  `link` varchar(64) NOT NULL,
  `tags` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) NOT NULL DEFAULT '0',
  `estado` char(2) NOT NULL DEFAULT '0',
  `escolaridade` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID_oportunidade`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `usuario_oportunidade` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.oportunidade: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `oportunidade` DISABLE KEYS */;
INSERT INTO `oportunidade` (`ID_oportunidade`, `ID_usuario`, `data_publicacao`, `categoria`, `descricao`, `imagem`, `tipo_personalidade`, `titulo`, `status_opor`, `tempo_expirar`, `tipo`, `inicio`, `link`, `tags`, `cidade`, `estado`, `escolaridade`) VALUES
	(4, NULL, '2023-10-29 02:57:02', '', 'DescriÃ§Ã£o da oportunidade', NULL, 'influente', 'Oportunidade', 'ativa', '2023-11-01 00:00:00', NULL, '2023-10-03 00:00:00', 'bloomie.com', NULL, 'Ãgua Branca', 'PB', 'Ensino fundamental incompleto'),
	(5, NULL, '2023-10-29 02:57:38', '', 'DescriÃ§Ã£o da oportunidade', NULL, 'influente', 'Oportunidade', 'ativa', '2023-11-01 00:00:00', NULL, '2023-10-03 00:00:00', 'bloomie.com', NULL, 'Ãgua Branca', 'PB', 'Ensino fundamental incompleto'),
	(6, NULL, '2023-10-29 03:00:13', 'EstÃ¡gios', 'DescriÃ§Ã£o da oportunidade', NULL, 'dominante', 'Oportunidade', 'inativa', '2023-10-13 00:00:00', NULL, '2023-10-11 00:00:00', 'bloomie.com', NULL, 'Ãgua Branca', 'PB', 'Ensino fundamental incompleto');
/*!40000 ALTER TABLE `oportunidade` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.oportunidades_expiradas
CREATE TABLE IF NOT EXISTS `oportunidades_expiradas` (
  `ID_oportunidades_expiradas` int(11) NOT NULL AUTO_INCREMENT,
  `ID_oportunidade` int(11) NOT NULL,
  `data_expiracao` datetime NOT NULL,
  PRIMARY KEY (`ID_oportunidades_expiradas`),
  KEY `ID_oportunidade` (`ID_oportunidade`),
  CONSTRAINT `oportunidade_expirada` FOREIGN KEY (`ID_oportunidade`) REFERENCES `oportunidade` (`ID_oportunidade`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.oportunidades_expiradas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `oportunidades_expiradas` DISABLE KEYS */;
/*!40000 ALTER TABLE `oportunidades_expiradas` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.oportunidades_negadas
CREATE TABLE IF NOT EXISTS `oportunidades_negadas` (
  `ID_oportunidades_negadas` int(11) NOT NULL AUTO_INCREMENT,
  `ID_oportunidade` int(11) NOT NULL,
  `data_negada` datetime NOT NULL,
  `motivo` varchar(64) NOT NULL,
  PRIMARY KEY (`ID_oportunidades_negadas`),
  KEY `ID_oportunidade` (`ID_oportunidade`),
  CONSTRAINT `oportunidade_negada` FOREIGN KEY (`ID_oportunidade`) REFERENCES `oportunidade` (`ID_oportunidade`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.oportunidades_negadas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `oportunidades_negadas` DISABLE KEYS */;
/*!40000 ALTER TABLE `oportunidades_negadas` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.post
CREATE TABLE IF NOT EXISTS `post` (
  `ID_post` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `data_publicacao` datetime NOT NULL,
  `documento` varchar(64) DEFAULT NULL,
  `imagem` varchar(64) DEFAULT NULL,
  `texto` varchar(3000) NOT NULL,
  PRIMARY KEY (`ID_post`),
  KEY `ID_autor` (`ID_usuario`),
  CONSTRAINT `autor_post` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.post: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.posts_banidos
CREATE TABLE IF NOT EXISTS `posts_banidos` (
  `ID_posts_banidos` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `ID_ADM` int(11) NOT NULL,
  PRIMARY KEY (`ID_posts_banidos`),
  KEY `ID_usuario` (`ID_usuario`),
  KEY `ID_ADM` (`ID_ADM`),
  CONSTRAINT `adm_post_banido` FOREIGN KEY (`ID_ADM`) REFERENCES `adm` (`ID_adm`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuario_post_banido` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.posts_banidos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `posts_banidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_banidos` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.post_excluidos
CREATE TABLE IF NOT EXISTS `post_excluidos` (
  `ID_posts_excluidos` int(11) NOT NULL,
  `ID_post` int(11) NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  `data_exclusao` datetime NOT NULL,
  PRIMARY KEY (`ID_posts_excluidos`),
  KEY `ID_post` (`ID_post`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `post_excluido` FOREIGN KEY (`ID_post`) REFERENCES `post` (`ID_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuario_post_excluido` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.post_excluidos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `post_excluidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_excluidos` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.token
CREATE TABLE IF NOT EXISTS `token` (
  `ID_token` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `token` varchar(250) NOT NULL DEFAULT '',
  `revogado` varchar(250) NOT NULL DEFAULT '',
  `criado` datetime NOT NULL,
  `atualizado` varchar(250) NOT NULL DEFAULT '',
  `data_expiracao` datetime NOT NULL,
  PRIMARY KEY (`ID_token`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `usuario_token` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.token: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(32) NOT NULL,
  `email` varchar(256) NOT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `senha` varchar(128) NOT NULL DEFAULT '',
  `nome` varchar(32) DEFAULT '',
  `sobrenome` varchar(32) DEFAULT '',
  `estado` char(2) DEFAULT '',
  `cidade` varchar(64) DEFAULT '',
  `tipo` varchar(32) DEFAULT '',
  `foto_perfil` varchar(64) DEFAULT '',
  `sobre` varchar(2600) DEFAULT '',
  PRIMARY KEY (`ID_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.usuario: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`ID_usuario`, `usuario`, `email`, `data_criacao`, `senha`, `nome`, `sobrenome`, `estado`, `cidade`, `tipo`, `foto_perfil`, `sobre`) VALUES
	(5, 'winnie', 'winnie@gmail.com', '2023-10-29 15:22:38', 'winnie', '', '', '', '', '', '', ''),
	(6, '_winnie.s', 'winniestefany303@gmail.com', NULL, '$2y$10$Q/jV4/5ljj/ZV4.GBXBlhen9UCK8c7Ar7/h.xXnpA8EIq6AyegwAu', 'Winnie', 'Silva', 'SP', 'SÃ£o Paulo', '', '', ''),
	(7, 'nahtanPNG', 'nathan.ferreiira13@gmail.com', NULL, '$2y$10$HhCyzRhRAOT.x/YO/UzCZOwPjkx.De3Di43MrykeaoXvP6cIjmNPm', 'Nathan', 'Ferreira', 'SP', 'SÃ£o Paulo', '', '', ''),
	(8, 'winnioe', 'teste@gmail.com', NULL, '$2y$10$WdMBOYAVQQhYwymY9LcsaOeXQorQc904RLytOXbRtqINM8ex6lVG6', 'Teste', 'Teste', 'SE', 'Amparo do SÃ£o Francisco', '', '', ''),
	(10, 'winnio', 'test1e@gmail.com', NULL, '$2y$10$g7lKKJR6ZhJ11mytG8E8huIz3IVhqYolDtWFhBwomArcGyAKfEBsm', 'Teste', 'Teste', 'SE', 'Amparo do SÃ£o Francisco', '', '', ''),
	(11, 'testeee', 'testw@gmail.com', NULL, '$2y$10$Rq92u4N59pmduKjRVBTM9u92w1gyVv3eBIJUpo86dSjt3865jICxK', 'Teste', 'teste', 'RN', 'ArÃªs', '', '', ''),
	(12, 'winniestefany', 'winnieteste@gmail.com', NULL, 'c592a4cdea42bc838cf8c8b8e223126e', 'Winnie', 'Silva', 'SP', 'Adamantina', '', '', '');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
