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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.adm: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `adm` DISABLE KEYS */;
/*!40000 ALTER TABLE `adm` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.banimento
CREATE TABLE IF NOT EXISTS `banimento` (
  `ID_banimento` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `data_banimento` datetime NOT NULL,
  `motivo` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_banimento`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `FK_banimento_usuario` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.bloomizade: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `bloomizade` DISABLE KEYS */;
/*!40000 ALTER TABLE `bloomizade` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `ID_comentario` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `comentario` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID_comentario`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `comentarios` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.comentarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.conta_inativa
CREATE TABLE IF NOT EXISTS `conta_inativa` (
  `ID_conta_inativa` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `data_inatividade` datetime NOT NULL,
  `motivo` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_conta_inativa`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `usuario_inativo` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.conta_inativa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `conta_inativa` DISABLE KEYS */;
/*!40000 ALTER TABLE `conta_inativa` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.curtidas
CREATE TABLE IF NOT EXISTS `curtidas` (
  `ID_curtida` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) DEFAULT NULL,
  `ID_post` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_curtida`),
  UNIQUE KEY `unique_like` (`ID_usuario`,`ID_post`),
  KEY `ID_post` (`ID_post`),
  CONSTRAINT `curtidas_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`),
  CONSTRAINT `curtidas_ibfk_2` FOREIGN KEY (`ID_post`) REFERENCES `post` (`ID_post`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.curtidas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `curtidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `curtidas` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `ID_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `setor_empresa` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `email_empresa` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.empresa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.mentor
CREATE TABLE IF NOT EXISTS `mentor` (
  `ID_mentor` int(11) NOT NULL AUTO_INCREMENT,
  `nome_mentor` varchar(32) CHARACTER SET utf8 NOT NULL,
  `sobrenome_mentor` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email_mentor` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `setor_mentor` varchar(256) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`ID_mentor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.mentor: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `mentor` DISABLE KEYS */;
/*!40000 ALTER TABLE `mentor` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.oportunidade
CREATE TABLE IF NOT EXISTS `oportunidade` (
  `ID_oportunidade` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) DEFAULT NULL,
  `data_publicacao` datetime NOT NULL,
  `categoria` varchar(150) CHARACTER SET utf8 NOT NULL,
  `descricao` varchar(500) CHARACTER SET utf8 NOT NULL,
  `imagem` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `tipo_personalidade` varchar(50) CHARACTER SET utf8 NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `status_opor` varchar(25) CHARACTER SET utf8 NOT NULL,
  `tempo_expirar` datetime NOT NULL,
  `tipo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `inicio` datetime NOT NULL,
  `link` varchar(64) CHARACTER SET utf8 NOT NULL,
  `tags` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cidade` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `estado` char(2) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `escolaridade` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`ID_oportunidade`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `usuario_oportunidade` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.oportunidade: ~3 rows (aproximadamente)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.oportunidades_expiradas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `oportunidades_expiradas` DISABLE KEYS */;
/*!40000 ALTER TABLE `oportunidades_expiradas` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.oportunidades_negadas
CREATE TABLE IF NOT EXISTS `oportunidades_negadas` (
  `ID_oportunidades_negadas` int(11) NOT NULL AUTO_INCREMENT,
  `ID_oportunidade` int(11) NOT NULL,
  `data_negada` datetime NOT NULL,
  `motivo` varchar(64) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_oportunidades_negadas`),
  KEY `ID_oportunidade` (`ID_oportunidade`),
  CONSTRAINT `oportunidade_negada` FOREIGN KEY (`ID_oportunidade`) REFERENCES `oportunidade` (`ID_oportunidade`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.oportunidades_negadas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `oportunidades_negadas` DISABLE KEYS */;
/*!40000 ALTER TABLE `oportunidades_negadas` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.post
CREATE TABLE IF NOT EXISTS `post` (
  `ID_post` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `data_publicacao` datetime NOT NULL,
  `imagem` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `texto` varchar(3000) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID_post`),
  KEY `ID_autor` (`ID_usuario`),
  CONSTRAINT `autor_post` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.post: ~83 rows (aproximadamente)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`ID_post`, `ID_usuario`, `usuario`, `data_publicacao`, `imagem`, `texto`) VALUES
	(1, 6, '', '2023-11-10 22:20:25', '../img/blu-disc.png', 'Oiiii'),
	(2, 6, '', '2023-11-10 22:37:35', '../img/', 'oiiiihjsvadha'),
	(3, 6, '', '2023-11-10 22:39:58', '../img/', 'oiiiihjsvadha'),
	(4, 6, '', '2023-11-10 22:48:07', '../img/', 'oiiiihjsvadha'),
	(5, 6, '_winnie.s', '2023-11-10 22:49:17', '../img/20231024_152203.jpg', 'oi gente, esse Ã© meu post!'),
	(6, 6, '_winnie.s', '2023-11-12 19:39:09', '../img/', 'oioioi'),
	(7, 6, '_winnie.s', '2023-11-12 20:04:19', '../img/blu-disc.png', 'oi gente'),
	(8, 6, '_winnie.s', '2023-11-12 20:04:25', '../img/', 'oi gente'),
	(9, 6, '_winnie.s', '2023-11-12 20:04:41', '../img/20231024_152203.jpg', 'oi gente'),
	(10, 6, '_winnie.s', '2023-11-12 20:04:57', '../img/20231024_152203.jpg', 'oi gente'),
	(11, 6, '_winnie.s', '2023-11-12 20:13:32', '../img/', 'oie'),
	(12, 6, '_winnie.s', '2023-11-12 20:14:45', '../img/', 'OLAAAAAAAA'),
	(13, 6, '_winnie.s', '2023-11-12 20:16:07', '../img/', 'oi'),
	(14, 6, '_winnie.s', '2023-11-12 20:16:32', '../img/', 'oiiii\r\n'),
	(15, 6, '_winnie.s', '2023-11-12 20:22:05', '../img/', 'oii'),
	(16, 6, '_winnie.s', '2023-11-12 20:24:05', '../img/20231024_152203.jpg', 'oie gente!'),
	(17, 6, '_winnie.s', '2023-11-12 20:24:11', '../img/20231024_152203.jpg', 'oie gente!'),
	(18, 6, '_winnie.s', '2023-11-12 20:26:03', '../img/', 'oi gente\r\n'),
	(19, 6, '_winnie.s', '2023-11-12 20:26:11', '../img/20231024_152203.jpg', 'oi genteeeee'),
	(20, 6, '_winnie.s', '2023-11-12 20:27:33', '../img/', 'oi'),
	(21, 6, '_winnie.s', '2023-11-12 20:27:38', '../img/blu-disc.png', 'oi'),
	(22, 6, '_winnie.s', '2023-11-12 20:28:24', '../img/blu-disc.png', 'com imagem'),
	(23, 6, '_winnie.s', '2023-11-12 20:28:30', '../img/blu-personalidade.png', 'com imagem'),
	(24, 6, '_winnie.s', '2023-11-12 20:30:00', '../img/blu-personalidade.png', 'com imageeem'),
	(25, 6, '_winnie.s', '2023-11-12 20:32:41', '../img/blu-personalidade.png', 'com \r\nimageeemdddddddddddddddddddddddddddddddddddddddddddddddddddddd\r\ndddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd\r\ndddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd\r\ndddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd'),
	(26, 6, '_winnie.s', '2023-11-12 20:38:32', '../img/blu-personalidade.png', 'oioiii'),
	(27, 6, '_winnie.s', '2023-11-12 20:39:32', '../img/blu-personalidade.png', 'oi'),
	(28, 6, '_winnie.s', '2023-11-12 20:39:37', '../img/blu-disc.png', 'oi'),
	(29, 6, '_winnie.s', '2023-11-12 20:40:04', '../img/blu-personalidade.png', 'oi'),
	(30, 6, '_winnie.s', '2023-11-12 20:41:35', '../img/blu-personalidade.png', 'oi'),
	(31, 6, '_winnie.s', '2023-11-12 20:42:36', '../img/blu-personalidade.png', 'uouhfdc'),
	(32, 6, '_winnie.s', '2023-11-12 20:43:18', '../img/blu-personalidade.png', 'bgfjkdsc'),
	(33, 6, '_winnie.s', '2023-11-12 20:47:50', '../img/blu-personalidade.png', 'kjbds'),
	(34, 6, '_winnie.s', '2023-11-12 20:50:32', '../img/blu-personalidade.png', 'jejsdfk'),
	(35, 6, '_winnie.s', '2023-11-12 21:01:56', '../img/blu-personalidade.png', 'oiii'),
	(36, 6, '_winnie.s', '2023-11-12 21:05:20', '../img/blu-personalidade.png', 'fedkfkn'),
	(37, 6, '_winnie.s', '2023-11-12 21:07:54', '../img/blu-disc.png', 'dddd'),
	(38, 6, '_winnie.s', '2023-11-12 21:12:21', '../img/blu-personalidade.png', 'olaaaa'),
	(39, 6, '_winnie.s', '2023-11-12 21:13:36', '../img/20231024_152203.jpg', 'oiii'),
	(40, 6, '_winnie.s', '2023-11-12 21:15:33', '../img/blu-personalidade.png', 'oiii'),
	(41, 6, '_winnie.s', '2023-11-12 21:16:19', '../img/20231024_152203.jpg', 'oieee'),
	(42, 6, '_winnie.s', '2023-11-12 21:18:07', '../img/blu-personalidade.png', 'oieee'),
	(43, 6, '_winnie.s', '2023-11-12 21:20:06', '../img/blu-personalidade.png', 'oi'),
	(44, 6, '_winnie.s', '2023-11-12 21:20:24', '../img/blu-personalidade.png', 'ioi'),
	(45, 6, '_winnie.s', '2023-11-12 21:30:29', '../img/', 'oi'),
	(46, 6, '_winnie.s', '2023-11-12 21:30:49', '../img/', 'oi'),
	(47, 6, '_winnie.s', '2023-11-12 21:30:59', '../img/20231024_152203.jpg', 'oi'),
	(48, 6, '_winnie.s', '2023-11-12 21:33:49', '../img/blu-disc.png', 'oi'),
	(49, 6, '_winnie.s', '2023-11-12 21:34:21', '../img/blu-personalidade.png', 'oi'),
	(50, 6, '_winnie.s', '2023-11-12 21:34:33', '../img/Layout da Rifa.png', 'oi'),
	(51, 6, '_winnie.s', '2023-11-12 21:38:55', '../img/', 'oi'),
	(52, 6, '_winnie.s', '2023-11-12 21:39:56', '../img/', 'oi'),
	(53, 6, '_winnie.s', '2023-11-12 21:41:02', '../img/', 'oi'),
	(54, 6, '_winnie.s', '2023-11-12 21:42:46', '../img/', 'oi'),
	(55, 6, '_winnie.s', '2023-11-12 21:46:12', '../img/', 'oi'),
	(56, 6, '_winnie.s', '2023-11-12 21:46:16', '../img/Layout da Rifa.png', 'oi'),
	(57, 6, '_winnie.s', '2023-11-12 21:47:05', '../img/', 'li'),
	(58, 6, '_winnie.s', '2023-11-12 21:48:05', '../img/', 'oa'),
	(59, 6, '_winnie.s', '2023-11-12 21:48:28', '../img/', 'oi'),
	(60, 6, '_winnie.s', '2023-11-12 21:50:43', '../img/', 'oi'),
	(61, 6, '_winnie.s', '2023-11-12 21:51:21', '../img/', 'oi'),
	(62, 6, '_winnie.s', '2023-11-12 21:53:19', '../img/', 'oi'),
	(63, 6, '_winnie.s', '2023-11-12 21:56:21', '../img/', 'ola'),
	(64, 6, '_winnie.s', '2023-11-12 22:03:46', '', 'oi'),
	(65, 6, '_winnie.s', '2023-11-12 22:03:51', '../img/Layout da Rifa.png', 'oi'),
	(66, 6, '_winnie.s', '2023-11-12 22:28:23', '', 'oi'),
	(67, 6, '_winnie.s', '2023-11-12 22:31:01', '', 'oie\r\n'),
	(68, 6, '_winnie.s', '2023-11-12 22:32:50', '', 'oie\r\n'),
	(69, 6, '_winnie.s', '2023-11-12 22:32:56', '', 'oi'),
	(70, 6, '_winnie.s', '2023-11-12 22:38:58', '', 'oi'),
	(71, 6, '_winnie.s', '2023-11-12 22:39:38', '', 'oi'),
	(72, 6, '_winnie.s', '2023-11-12 22:43:08', '', 'oi\r\n'),
	(73, 6, '_winnie.s', '2023-11-12 22:57:54', '', 'oi'),
	(74, 6, '_winnie.s', '2023-11-12 23:03:50', '', 'oi'),
	(75, 6, '_winnie.s', '2023-11-12 23:04:32', '', 'oi'),
	(76, 6, '_winnie.s', '2023-11-12 23:06:24', '', 'oi'),
	(77, 6, '_winnie.s', '2023-11-12 23:06:30', '../img/Layout da Rifa.png', 'oi'),
	(78, 6, '_winnie.s', '2023-11-12 23:07:15', '', 'oioi'),
	(79, 6, '_winnie.s', '2023-11-12 23:07:18', '', 'oioi'),
	(80, 6, '_winnie.s', '2023-11-12 23:07:34', '', 'oi'),
	(81, 6, '_winnie.s', '2023-11-12 23:07:35', '', 'oi'),
	(82, 6, '_winnie.s', '2023-11-12 23:18:42', '', 'ola queridos'),
	(83, 6, '_winnie.s', '2023-11-13 00:06:32', '../img/blu-disc.png', 'oieeeeeeeeeeeeeeeeeeeeeeeee'),
	(84, 6, 'winnierafa3003@gmail.com', '2023-11-13 20:33:15', '../img/20231024_152203.jpg', 'Oi gente!');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.post_excluidos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `post_excluidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_excluidos` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.token
CREATE TABLE IF NOT EXISTS `token` (
  `ID_token` int(11) NOT NULL AUTO_INCREMENT,
  `ID_usuario` int(11) NOT NULL,
  `token` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `revogado` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `criado` datetime NOT NULL,
  `atualizado` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `data_expiracao` datetime NOT NULL,
  PRIMARY KEY (`ID_token`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `usuario_token` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.token: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;

-- Copiando estrutura para tabela bloomie_db.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(256) CHARACTER SET utf8 NOT NULL,
  `nome` varchar(32) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(128) CHARACTER SET utf8 NOT NULL,
  `sobrenome` varchar(32) CHARACTER SET utf8 NOT NULL,
  `estado` char(2) CHARACTER SET utf8 NOT NULL,
  `cidade` varchar(64) CHARACTER SET utf8 NOT NULL,
  `tipo` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `foto_perfil` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `sobre` varchar(2600) CHARACTER SET utf8 DEFAULT NULL,
  `instituicao` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `personalidade` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `data_nasc` date NOT NULL,
  `data_criacao` datetime NOT NULL,
  PRIMARY KEY (`ID_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela bloomie_db.usuario: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`ID_usuario`, `usuario`, `email`, `nome`, `senha`, `sobrenome`, `estado`, `cidade`, `tipo`, `foto_perfil`, `sobre`, `instituicao`, `personalidade`, `data_nasc`, `data_criacao`) VALUES
	(5, 'winnie', 'winnie@gmail.com', '', 'winnie', '', '', '', '', '', '', NULL, '', '2023-11-12', '2023-11-12 18:23:08'),
	(6, '_winnie.s', 'winniestefany303@gmail.com', 'Winnie', '$2y$10$Q/jV4/5ljj/ZV4.GBXBlhen9UCK8c7Ar7/h.xXnpA8EIq6AyegwAu', 'Silva', 'SP', 'SÃ£o Paulo', '', '', '', NULL, 'Dominância', '2023-11-12', '2023-11-12 18:23:21'),
	(7, 'nahtanPNG', 'nathan.ferreiira13@gmail.com', 'Nathan', '$2y$10$HhCyzRhRAOT.x/YO/UzCZOwPjkx.De3Di43MrykeaoXvP6cIjmNPm', 'Ferreira', 'SP', 'SÃ£o Paulo', '', '', '', NULL, NULL, '2023-11-12', '2023-11-12 18:23:20'),
	(8, 'winnioe', 'teste@gmail.com', 'Teste', '$2y$10$WdMBOYAVQQhYwymY9LcsaOeXQorQc904RLytOXbRtqINM8ex6lVG6', 'Teste', 'SE', 'Amparo do SÃ£o Francisco', '', '', '', NULL, NULL, '2023-11-12', '2023-11-12 18:23:19'),
	(10, 'winnio', 'test1e@gmail.com', 'Teste', '$2y$10$g7lKKJR6ZhJ11mytG8E8huIz3IVhqYolDtWFhBwomArcGyAKfEBsm', 'Teste', 'SE', 'Amparo do SÃ£o Francisco', '', '', '', NULL, NULL, '2023-11-12', '2023-11-12 18:23:18'),
	(11, 'testeee', 'testw@gmail.com', 'Teste', '$2y$10$Rq92u4N59pmduKjRVBTM9u92w1gyVv3eBIJUpo86dSjt3865jICxK', 'teste', 'RN', 'ArÃªs', '', '', '', NULL, NULL, '2023-11-12', '2023-11-12 18:23:17'),
	(12, 'winniestefany', 'winnieteste@gmail.com', 'Winnie', 'c592a4cdea42bc838cf8c8b8e223126e', 'Silva', 'SP', 'Adamantina', '', '', '', NULL, NULL, '2023-11-12', '2023-11-12 18:23:23'),
	(13, 'winnierafa', 'winnierafa3003@gmail.com', 'Winnie', '$2y$10$lyWA0FebEnQvpW61IWOT/uGgkLbARCTvXwcxowi8/A4HIuqecLKHq', 'Silva', 'PE', 'Abreu e Lima', NULL, NULL, NULL, NULL, NULL, '1969-12-31', '2023-11-13 20:32:20');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
