-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para bloomie_db
CREATE DATABASE IF NOT EXISTS `bloomie_db` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bloomie_db`;

-- Copiando estrutura para tabela bloomie_db.acessos_oportunidade
CREATE TABLE IF NOT EXISTS `acessos_oportunidade` (
  `ID_acesso` int NOT NULL AUTO_INCREMENT,
  `ID_oportunidade` int DEFAULT NULL,
  `data_acesso` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_acesso`),
  KEY `ID_oportunidade` (`ID_oportunidade`),
  CONSTRAINT `acessos_oportunidade_ibfk_1` FOREIGN KEY (`ID_oportunidade`) REFERENCES `oportunidade` (`ID_oportunidade`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.acessos_oportunidade: ~2 rows (aproximadamente)
INSERT INTO `acessos_oportunidade` (`ID_acesso`, `ID_oportunidade`, `data_acesso`) VALUES
	(1, 6, '2023-11-28 02:16:00'),
	(2, 6, '2023-11-28 02:19:46');

-- Copiando estrutura para tabela bloomie_db.adm
CREATE TABLE IF NOT EXISTS `adm` (
  `ID_adm` int NOT NULL AUTO_INCREMENT,
  `ID_usuario` int NOT NULL,
  PRIMARY KEY (`ID_adm`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `ID_usuario` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.adm: ~0 rows (aproximadamente)

-- Copiando estrutura para evento bloomie_db.Atualizar status oportunidade
DELIMITER //
CREATE EVENT `Atualizar status oportunidade` ON SCHEDULE EVERY 1 DAY STARTS '2023-11-29 00:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
UPDATE oportunidade
SET status_opor = 'expirada'
WHERE status_opor = 'pendente' AND tempo_expirar < NOW();
END//
DELIMITER ;

-- Copiando estrutura para tabela bloomie_db.banimento
CREATE TABLE IF NOT EXISTS `banimento` (
  `ID_banimento` int NOT NULL AUTO_INCREMENT,
  `ID_usuario` int NOT NULL,
  `data_banimento` datetime NOT NULL,
  `motivo` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`ID_banimento`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `FK_banimento_usuario` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.banimento: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela bloomie_db.bloomizade
CREATE TABLE IF NOT EXISTS `bloomizade` (
  `ID_bloomizade` int NOT NULL AUTO_INCREMENT,
  `usuario_id_1` int DEFAULT NULL,
  `usuario_id_2` int DEFAULT NULL,
  `status_soli` enum('pendente','aceito') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'pendente',
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_bloomizade`),
  KEY `usuario_id_1` (`usuario_id_1`),
  KEY `usuario_id_2` (`usuario_id_2`),
  CONSTRAINT `bloomizade_ibfk_1` FOREIGN KEY (`usuario_id_1`) REFERENCES `usuario` (`ID_usuario`),
  CONSTRAINT `bloomizade_ibfk_2` FOREIGN KEY (`usuario_id_2`) REFERENCES `usuario` (`ID_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.bloomizade: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela bloomie_db.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `ID_comentario` int NOT NULL,
  `ID_usuario` int DEFAULT NULL,
  `comentario` varchar(2000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID_comentario`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `comentarios` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.comentarios: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela bloomie_db.contas_inativas
CREATE TABLE IF NOT EXISTS `contas_inativas` (
  `ID_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nome` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `senha` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `sobrenome` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `estado` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cidade` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `personalidade` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `data_nasc` date NOT NULL,
  `data_inatividade` datetime NOT NULL,
  `motivo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.contas_inativas: ~1 rows (aproximadamente)
INSERT INTO `contas_inativas` (`ID_usuario`, `usuario`, `email`, `nome`, `senha`, `sobrenome`, `estado`, `cidade`, `personalidade`, `data_nasc`, `data_inatividade`, `motivo`) VALUES
	(15, 'testeexcluir', 'testeexcluir@gmail.com', 'teste', '$2y$10$orMUegO8vW8C5i9lM.pAy.MXdZv6fO9iK6gakgI/am8ZXKGY.rqgi', 'excluir', 'BA', 'Abaíra', NULL, '1969-12-31', '2023-11-19 02:59:14', 'Exclusão de conta');

-- Copiando estrutura para tabela bloomie_db.curtidas
CREATE TABLE IF NOT EXISTS `curtidas` (
  `ID_curtida` int NOT NULL AUTO_INCREMENT,
  `ID_usuario` int DEFAULT NULL,
  `ID_post` int DEFAULT NULL,
  `data_curtida` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_curtida`),
  KEY `ID_usuario` (`ID_usuario`),
  KEY `ID_post` (`ID_post`),
  CONSTRAINT `curtidas_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`),
  CONSTRAINT `curtidas_ibfk_2` FOREIGN KEY (`ID_post`) REFERENCES `post` (`ID_post`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.curtidas: ~1 rows (aproximadamente)
INSERT INTO `curtidas` (`ID_curtida`, `ID_usuario`, `ID_post`, `data_curtida`) VALUES
	(64, 6, 106, '2023-11-26 00:00:00');

-- Copiando estrutura para tabela bloomie_db.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `ID_empresa` int NOT NULL AUTO_INCREMENT,
  `nome_empresa` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `setor_empresa` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `email_empresa` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`ID_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.empresa: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela bloomie_db.mentor
CREATE TABLE IF NOT EXISTS `mentor` (
  `ID_mentor` int NOT NULL AUTO_INCREMENT,
  `nome_mentor` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `sobrenome_mentor` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email_mentor` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `setor_mentor` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID_mentor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.mentor: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela bloomie_db.oportunidade
CREATE TABLE IF NOT EXISTS `oportunidade` (
  `ID_oportunidade` int NOT NULL AUTO_INCREMENT,
  `ID_usuario` int NOT NULL,
  `data_publicacao` datetime NOT NULL,
  `categoria` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `descricao` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `imagem` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tipo_personalidade` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status_opor` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tempo_expirar` date NOT NULL,
  `tipo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `inicio` date NOT NULL,
  `link` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tags` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cidade` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `estado` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `escolaridade` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `faixa_etaria` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_oportunidade`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `usuario_oportunidade` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.oportunidade: ~36 rows (aproximadamente)
INSERT INTO `oportunidade` (`ID_oportunidade`, `ID_usuario`, `data_publicacao`, `categoria`, `descricao`, `imagem`, `tipo_personalidade`, `titulo`, `status_opor`, `tempo_expirar`, `tipo`, `inicio`, `link`, `tags`, `cidade`, `estado`, `escolaridade`, `faixa_etaria`) VALUES
	(4, 21, '2023-10-29 02:57:02', 'teste', 'DescriÃ§Ã£o da oportunidade', '../img/image 5.png', 'influente', 'Oportunidade', 'inativa', '2023-11-01', NULL, '2023-10-03', 'bloomie.com', NULL, 'Ãgua Branca', 'PB', 'Ensino fundamental incompleto', NULL),
	(5, 11, '2023-10-29 02:57:38', 'teste', 'DescriÃ§Ã£o da oportunidade', '../img/image 5.png', 'influente', 'Oportunidade', 'negada', '2023-11-01', NULL, '2023-10-03', 'bloomie.com', NULL, 'Ãgua Branca', 'PB', 'Ensino fundamental incompleto', NULL),
	(6, 16, '2023-10-29 03:00:13', 'Estágios', 'DescriÃ§Ã£o da oportunidade', '../img/image 5.png', 'dominante', 'MaisCurtido', 'inativa', '2023-10-13', NULL, '2023-10-11', 'bloomie.com', NULL, 'Ãgua Branca', 'PB', 'Ensino fundamental incompleto', '15 - 17 anos'),
	(7, 19, '2023-11-19 16:16:56', 'Bolsas de estudo', 'Descrição da oportunidade', '../img/image 5.png', 'estavel', 'Oportunidade', 'aceita', '2023-11-23', NULL, '2023-11-07', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(8, 6, '2023-11-19 16:22:52', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'ativa', '2023-11-30', NULL, '2023-11-07', 'bloomie.com', NULL, 'Água Branca', 'PB', 'Ensino fundamental completo', NULL),
	(9, 6, '2023-11-19 16:25:05', 'Bolsas de estudo', 'Descrição da oportunidade', '../img/image 5.png', 'estavel', 'Oportunidade', 'negada', '2023-11-30', NULL, '2023-11-10', 'bloomie.com', NULL, 'Amparo do São Francisco', 'SE', 'Ensino superior incompleto', NULL),
	(10, 6, '2023-11-19 16:27:17', 'Bolsas de estudo', 'Descrição da oportunidade', '../img/image 5.png', 'influente', 'Oportunidade', 'inativa', '2023-11-15', NULL, '2023-11-29', 'bloomie.com', NULL, 'Abreulândia', 'TO', 'Ensino fundamental incompleto', NULL),
	(11, 6, '2023-11-19 16:41:15', 'Bolsas de estudo', 'Descrição da oportunidade', '../img/image 5.png', 'influente', 'Oportunidade', 'negada', '2023-11-28', NULL, '2023-11-23', 'bloomie.com', NULL, 'Água Branca', 'PB', 'Ensino fundamental completo', NULL),
	(12, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/blu-DISC.png', 'dominante', 'Oportunidade', 'inativa', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(13, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', '', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(16, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', '', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(18, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', '', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(19, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(20, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(21, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(22, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(23, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(24, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(25, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(26, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(27, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(28, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(29, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(30, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(31, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(32, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'aceita', '2023-11-29', NULL, '2023-11-08', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto', NULL),
	(33, 21, '2023-11-19 19:09:06', 'teste', 'teste', 'teste', 'teste', 'teste', '', '2023-11-19', NULL, '2023-11-19', 'teste', NULL, 'teste', 'PR', 'teste', NULL),
	(34, 16, '2023-10-29 03:00:13', 'Estágios', 'DescriÃ§Ã£o da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'expirada', '2023-10-13', NULL, '2023-10-11', 'bloomie.com', NULL, 'Ãgua Branca', 'PB', 'Ensino fundamental incompleto', NULL),
	(35, 6, '2023-11-19 16:27:17', 'Bolsas de estudo', 'Descrição da oportunidade', '../img/image 5.png', 'influente', 'Oportunidade', 'expirada', '2023-11-15', NULL, '2023-11-29', 'bloomie.com', NULL, 'Abreulândia', 'TO', 'Ensino fundamental incompleto', NULL),
	(36, 6, '2023-11-28 20:22:39', 'Aprendizados', 'Descrição da oportunidade', '../img/20231024_152203.jpg', 'influente', 'teste', 'expirada', '2023-11-30', 'Workshop', '2023-11-01', 'bloomie.com', NULL, 'Abaiara', 'CE', 'Ensino médio incompleto', '15 a 18 anos'),
	(37, 32, '2023-12-06 11:41:21', 'Aprendizados', 'Neste curso introdutório de Excel serão abordados temas, como formatação de planilhas e de gráficos, classificação de dados e aplicação de fórmulas e funções.  Se você precisa dar os primeiros passos no uso de uma ferramenta de auxílio à execução de trabalhos que envolvam cálculos matemáticos, este é o curso certo!', '../img/WhatsApp Image 2023-12-06 at 10.17.01.jpeg', 'conforme', 'Microsoft Excel 2016 - Básico - Fundação Bradesco', 'pendente', '2024-01-04', 'Cursos Online', '2023-12-06', 'https://www.ev.org.br/cursos/comunicacao-e-expressao', NULL, 'São Paulo', 'SP', 'Livre', '15 a 18 anos'),
	(39, 32, '2023-12-06 11:52:00', 'Aprendizados', 'Aprenda a utilizar a Língua Brasileira de Sinais (Libras) e garanta o atendimento e o tratamento adequado às pessoas com deficiência auditiva. A Lei nº 10.436/2002 legitima a Libras como idioma advindo das Comunidades Surdas Brasileiras e obriga o poder público em geral a adotar formas institucionalizadas de apoiar o uso e a difusão dessa língua como meio de comunicação.', '../img/WhatsApp Image 2023-12-06 at 10.44.59.jpeg', 'estavel', 'Introdução à Libras', 'pendente', '2024-01-25', 'Desenvolvimento de Idiomas', '2023-12-06', 'https://www.escolavirtual.gov.br/curso/11', NULL, 'São Paulo', 'SP', 'Livre', '15 a 18 anos'),
	(41, 32, '2023-12-06 20:20:29', 'Aprendizados', 'Em nosso Curso de Informática Básica, você estudará, em quatro módulos, os conceitos fundamentais para quem está iniciando no assunto. Caso sinta dificuldade na compreensão de qualquer tema, a EducaWeb disponibiliza um suporte educacional através de um tutor acadêmico. Você poderá entrar em contato com ele, sempre que houver alguma dúvida, evitando, desta forma, que haja prejuízo na sua aprendizagem em relação ao assunto abordado durante o curso', '../img/WhatsApp Image 2023-12-06 at 10.59.58.jpeg', 'conforme', 'Curso de informática Básica Online - EducaWeb', 'pendente', '2024-01-06', 'Cursos Online', '2023-12-06', 'https://cursoseducaweb.com.br/curso-de-informatica-basica', NULL, 'São Paulo', 'SP', 'Livre', 'Livre'),
	(42, 32, '2023-12-06 20:50:17', 'Estágios', 'A Universidade da Califórnia em Los Angeles (UCLA) está recrutando estudantes internacionais para um summer job nos EUA no seu Instituto de Matemática Pura e Aplicada. As inscrições abrem na segunda semana de novembro e devem ser enviadas até 5 de fevereiro', '../assets/bluBloomie.png', 'conforme', 'Summer job nos EUA da UCLA ', 'pendente', '2024-02-05', 'Estudo no Exterior', '2023-12-06', 'partiuintercambio.org/bolsas-de-estudo/summer-job-nos-eua-ucla/', NULL, 'Amajari', 'RR', 'Ensino médio completo', '18+'),
	(43, 32, '2023-12-06 20:54:04', 'Concursos e competições', 'A comunicação está em nosso dia a dia, seja ela verbal (que é aquela que acontece por meio da linguagem escrita ou falada) ou não verbal (que são os gestos, a expressão facial e corporal, as imagens, os símbolos, etc.).  Neste curso, você vai relembrar vários temas que já aprendeu ao longo de sua jornada estudantil.', '../img/WhatsApp Image 2023-12-06 at 10.27.52.jpeg', 'influente', 'Comunicação e Expressão - Fundação Bradesco', 'pendente', '2024-01-04', 'Desenvolvimento de Habilidades', '2023-12-06', 'https://www.ev.org.br/cursos/comunicacao-e-expressao', NULL, 'Abadia dos Dourados', 'MG', 'Livre', 'Livre'),
	(44, 32, '2023-12-06 20:58:31', 'Voluntariado', 'Em nosso Curso de Informática Básica, você estudará, em quatro módulos, os conceitos fundamentais para quem está iniciando no assunto. Caso sinta dificuldade na compreensão de qualquer tema, a EducaWeb disponibiliza um suporte educacional através de um tutor acadêmico. Você poderá entrar em contato com ele, sempre que houver alguma dúvida, evitando, desta forma, que haja prejuízo na sua aprendizagem em relação ao assunto abordado durante o curso', '../img/WhatsApp Image 2023-12-06 at 10.59.58.jpeg', 'conforme', 'Curso de informática Básica Online - EducaWeb', 'pendente', '2024-02-26', 'Cursos Online', '2023-12-06', 'https://cursoseducaweb.com.br/curso-de-informatica-basica', NULL, 'Abreu e Lima', 'PE', 'Livre', 'Livre');

-- Copiando estrutura para tabela bloomie_db.oportunidades_inativas
CREATE TABLE IF NOT EXISTS `oportunidades_inativas` (
  `ID_oportunidades_inativas` int NOT NULL AUTO_INCREMENT,
  `ID_usuario` int NOT NULL,
  `data_publicacao` datetime NOT NULL,
  `categoria` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `descricao` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `imagem` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tipo_personalidade` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status_opor` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tempo_expirar` datetime NOT NULL,
  `tipo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `inicio` datetime NOT NULL,
  `link` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tags` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cidade` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `estado` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '0',
  `escolaridade` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID_oportunidades_inativas`),
  KEY `fk_usuario` (`ID_usuario`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela bloomie_db.oportunidades_inativas: ~3 rows (aproximadamente)
INSERT INTO `oportunidades_inativas` (`ID_oportunidades_inativas`, `ID_usuario`, `data_publicacao`, `categoria`, `descricao`, `imagem`, `tipo_personalidade`, `titulo`, `status_opor`, `tempo_expirar`, `tipo`, `inicio`, `link`, `tags`, `cidade`, `estado`, `escolaridade`) VALUES
	(4, 21, '2023-10-29 02:57:02', 'teste', 'DescriÃ§Ã£o da oportunidade', '../img/image 5.png', 'influente', 'Oportunidade', 'inativa', '2023-11-01 00:00:00', NULL, '2023-10-03 00:00:00', 'bloomie.com', NULL, 'Ãgua Branca', 'PB', 'Ensino fundamental incompleto'),
	(5, 21, '2023-10-29 02:57:02', 'teste', 'DescriÃ§Ã£o da oportunidade', '../img/image 5.png', 'influente', 'Oportunidade', 'inativa', '2023-11-01 00:00:00', NULL, '2023-10-03 00:00:00', 'bloomie.com', NULL, 'Ãgua Branca', 'PB', 'Ensino fundamental incompleto'),
	(6, 6, '2023-11-19 17:49:13', 'Aprendizados', 'Descrição da oportunidade', '../img/image 5.png', 'dominante', 'Oportunidade', 'inativa', '2023-11-29 00:00:00', NULL, '2023-11-08 00:00:00', 'bloomie.com', NULL, 'Água Branca', 'AL', 'Ensino médio incompleto');

-- Copiando estrutura para tabela bloomie_db.post
CREATE TABLE IF NOT EXISTS `post` (
  `ID_post` int NOT NULL AUTO_INCREMENT,
  `ID_usuario` int NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `data_publicacao` datetime NOT NULL,
  `imagem` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `texto` varchar(3000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`ID_post`),
  KEY `ID_autor` (`ID_usuario`),
  CONSTRAINT `autor_post` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.post: ~145 rows (aproximadamente)
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
	(69, 6, '_winnie.s', '2023-11-18 19:43:33', '', 'oii teste ajax'),
	(70, 6, '_winnie.s', '2023-11-18 19:45:05', '', 'eeeeeeeeeeeeeeee'),
	(71, 6, '_winnie.s', '2023-11-18 19:46:46', '', 'oioioiio'),
	(72, 6, '_winnie.s', '2023-11-18 19:48:02', '', 'oi9ioi'),
	(73, 6, '_winnie.s', '2023-11-18 19:48:07', '', 'oi9ioieeeeeeeeeeeeeeeee'),
	(74, 6, '_winnie.s', '2023-11-18 19:48:20', '../img/image 5.png', 'oi9ioieeeeeeeeeeeeeeeee'),
	(75, 6, '_winnie.s', '2023-11-18 19:51:41', '', 'oiii'),
	(76, 6, '_winnie.s', '2023-11-18 19:51:46', '', 'oiii'),
	(77, 6, '_winnie.s', '2023-11-18 19:51:49', '', 'oiii'),
	(78, 6, '_winnie.s', '2023-11-18 19:51:52', '', 'oiii'),
	(79, 6, '_winnie.s', '2023-11-18 19:51:52', '', 'oiii'),
	(80, 6, '_winnie.s', '2023-11-18 19:52:35', '../img/image 5.png', 'oiii'),
	(81, 6, '_winnie.s', '2023-11-18 19:54:56', '', ''),
	(82, 6, '_winnie.s', '2023-11-18 19:55:22', '', ''),
	(83, 6, '_winnie.s', '2023-11-18 19:56:00', '', ''),
	(84, 6, '_winnie.s', '2023-11-18 20:04:18', '', 'oiii'),
	(85, 6, '_winnie.s', '2023-11-18 20:10:19', '', 'oiii'),
	(86, 6, '_winnie.s', '2023-11-18 20:10:32', '', 'oieee'),
	(87, 6, '_winnie.s', '2023-11-18 20:11:38', '', 'oi gente'),
	(88, 6, '_winnie.s', '2023-11-18 20:13:20', '', 'oi'),
	(89, 6, '_winnie.s', '2023-11-18 20:14:04', '', 'oi'),
	(90, 6, '_winnie.s', '2023-11-18 20:15:25', '', 'ola'),
	(91, 6, '_winnie.s', '2023-11-18 20:15:32', '../img/image 5.png', 'oieieeee'),
	(92, 6, '_winnie.s', '2023-11-18 20:32:35', '', 'olllllllllllllaaaaaaaaaaaaaaaaaaaa'),
	(93, 6, '_winnie.s', '2023-11-18 20:34:12', '', 'olaaaaaaaaaaaaaaaaaaa'),
	(94, 6, '_winnie.s', '2023-11-18 20:34:49', '', 'oi'),
	(95, 6, '_winnie.s', '2023-11-18 20:34:57', '../img/blu-disc.png', 'ooooooooooooiiiiiiii'),
	(96, 6, '_winnie.s', '2023-11-18 20:41:43', '', 'oi'),
	(97, 6, '_winnie.s', '2023-11-18 20:41:52', '../img/image 5.png', 'hdjkasbfejd'),
	(98, 6, '_winnie.s', '2023-11-18 20:43:21', '', 'oii'),
	(99, 6, '_winnie.s', '2023-11-18 20:43:25', '', 'oi'),
	(100, 6, '_winnie.s', '2023-11-18 20:44:59', '', 'jkhvg'),
	(101, 6, '_winnie.s', '2023-11-18 20:46:01', '', 'oi'),
	(102, 6, '_winnie.s', '2023-11-18 20:46:05', '', 'ljhu'),
	(103, 6, '_winnie.s', '2023-11-18 20:46:18', '../img/blu-disc.png', ''),
	(104, 6, '_winnie.s', '2023-11-18 23:22:31', '', 'oi'),
	(105, 6, '_winnie.s', '2023-11-18 23:24:09', '', 'okllllllllllaaaaaaaaa'),
	(106, 7, 'nahtanPNG', '2023-11-19 00:03:28', '../img/blu-disc.png', 'OLA GENTEEEE'),
	(107, 6, '_winnie.s', '2023-11-20 20:00:00', '', 'oi'),
	(108, 6, '_winnie.s', '2023-11-20 20:00:00', '', 'oi'),
	(109, 6, '_winnie.s', '2023-11-20 20:00:00', '', 'oi'),
	(110, 6, 'winnie.s', '2023-11-26 11:24:15', '', ''),
	(111, 6, 'winnie.s', '2023-11-26 11:29:15', '', ''),
	(112, 6, 'winnie.s', '2023-11-26 11:47:10', '', ''),
	(113, 6, 'winnie.s', '2023-11-26 12:13:07', '', 'heyy'),
	(114, 6, 'winnie.s', '2023-11-26 12:13:14', '', 'oi gente'),
	(115, 6, 'winnie.s', '2023-11-26 14:17:59', '', ''),
	(116, 6, 'winnie.s', '2023-11-26 14:24:19', '', ''),
	(117, 6, 'winnie.s', '2023-11-26 14:25:21', '', ''),
	(118, 6, 'winnie.s', '2023-11-26 14:26:22', '', ''),
	(119, 6, 'winnie.s', '2023-11-26 14:39:43', '', ''),
	(120, 6, 'winnie.s', '2023-11-26 14:41:10', '', ''),
	(121, 6, 'winnie.s', '2023-11-26 14:42:05', '', ''),
	(122, 6, 'winnie.s', '2023-11-26 14:50:15', '', ''),
	(123, 6, 'winnie.s', '2023-11-26 14:53:23', '', ''),
	(124, 6, 'winnie.s', '2023-11-26 14:57:05', '', ''),
	(125, 6, 'winnie.s', '2023-11-26 15:03:44', '', ''),
	(126, 6, 'winnie.s', '2023-11-26 15:43:30', '', 'oi\r\n\r\n'),
	(127, 6, 'winnie.s', '2023-11-27 10:38:28', '', 'olaaa\r\n'),
	(128, 6, 'winnie.s', '2023-11-27 10:41:36', '', 'oi'),
	(129, 6, 'winnie.s', '2023-11-27 10:43:20', '', 'oi'),
	(130, 6, 'winnie.s', '2023-11-27 10:45:10', '', 'teste\r\n'),
	(131, 6, 'winnie.s', '2023-11-27 10:46:13', '', 'oxi'),
	(132, 6, 'winnie.s', '2023-11-27 10:46:31', '', 'teste'),
	(133, 6, 'winnie.s', '2023-11-27 10:46:42', '', 'ta funcionando normales'),
	(134, 6, 'winnie.s', '2023-11-27 10:50:14', '', 'teste\r\n'),
	(135, 6, 'winnie.s', '2023-11-27 10:50:30', '', 'teste2'),
	(136, 6, 'winnie.s', '2023-11-27 10:50:47', '', 'test3'),
	(137, 6, 'winnie.s', '2023-11-27 10:51:04', '', 'teste'),
	(138, 6, 'winnie.s', '2023-11-28 17:52:54', '', ''),
	(139, 6, 'winnie.s', '2023-11-28 18:25:26', '', ''),
	(140, 6, 'winnie.s', '2023-11-28 18:25:54', '', ''),
	(141, 6, 'winnie.s', '2023-11-28 18:25:55', '', ''),
	(142, 6, 'winnie.s', '2023-11-28 18:25:56', '', ''),
	(143, 6, 'winnie.s', '2023-11-28 18:25:57', '', ''),
	(144, 6, 'winnie.s', '2023-11-28 18:31:26', '', ''),
	(145, 6, 'winnie.s', '2023-11-28 18:33:06', '', ''),
	(146, 6, 'winnie.s', '2023-11-28 18:35:59', '', ''),
	(147, 6, 'winnie.s', '2023-11-28 18:36:36', '', ''),
	(148, 6, 'winnie.s', '2023-11-28 18:36:41', '', ''),
	(149, 6, 'winnie.s', '2023-11-28 18:36:46', '', 'oiiii'),
	(150, 6, 'winnie.s', '2023-11-28 19:45:12', '', 'oi gentye'),
	(151, 32, 'murie', '2023-12-06 20:15:41', '', 'oi eu sou o murillo\r\n');

-- Copiando estrutura para tabela bloomie_db.posts_banidos
CREATE TABLE IF NOT EXISTS `posts_banidos` (
  `ID_posts_banidos` int NOT NULL AUTO_INCREMENT,
  `ID_usuario` int NOT NULL,
  `ID_ADM` int NOT NULL,
  PRIMARY KEY (`ID_posts_banidos`),
  KEY `ID_usuario` (`ID_usuario`),
  KEY `ID_ADM` (`ID_ADM`),
  CONSTRAINT `adm_post_banido` FOREIGN KEY (`ID_ADM`) REFERENCES `adm` (`ID_adm`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuario_post_banido` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.posts_banidos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela bloomie_db.post_excluidos
CREATE TABLE IF NOT EXISTS `post_excluidos` (
  `ID_posts_excluidos` int NOT NULL,
  `ID_post` int NOT NULL,
  `ID_usuario` int NOT NULL,
  `data_exclusao` datetime NOT NULL,
  PRIMARY KEY (`ID_posts_excluidos`),
  KEY `ID_post` (`ID_post`),
  KEY `ID_usuario` (`ID_usuario`),
  CONSTRAINT `post_excluido` FOREIGN KEY (`ID_post`) REFERENCES `post` (`ID_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuario_post_excluido` FOREIGN KEY (`ID_usuario`) REFERENCES `usuario` (`ID_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.post_excluidos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela bloomie_db.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nome` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `senha` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `sobrenome` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `estado` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cidade` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `tipo` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `foto_perfil` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sobre` varchar(2600) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `instituicao` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `personalidade` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `data_criacao` datetime NOT NULL,
  PRIMARY KEY (`ID_usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Copiando dados para a tabela bloomie_db.usuario: ~23 rows (aproximadamente)
INSERT INTO `usuario` (`ID_usuario`, `usuario`, `email`, `nome`, `senha`, `sobrenome`, `estado`, `cidade`, `tipo`, `foto_perfil`, `sobre`, `instituicao`, `personalidade`, `data_nasc`, `data_criacao`) VALUES
	(5, 'winnie', 'winnie@gmail.com', '', 'winnie', '', '', '', '', '', '', NULL, '', '2023-11-10', '2023-10-01 18:23:08'),
	(6, 'winnie.s', 'winniestefany303@gmail.com', 'winnie', '$2y$10$Q/jV4/5ljj/ZV4.GBXBlhen9UCK8c7Ar7/h.xXnpA8EIq6AyegwAu', 'silva', 'SP', 'SÃ£o Paulo', '', '../img/blu-disc.png', '', NULL, 'influente', '2023-11-12', '2023-11-02 18:23:21'),
	(7, 'nahtanPNG', 'nathan.ferreiira13@gmail.com', 'Nathan', '$2y$10$HhCyzRhRAOT.x/YO/UzCZOwPjkx.De3Di43MrykeaoXvP6cIjmNPm', 'Ferreira', 'SP', 'SÃ£o Paulo', '', '../img/foto_nathan.jpeg', 'Desenvolvedor Full-Stack e co-fundador da TransFast:)', NULL, 'dominante', '2023-11-12', '2023-11-03 03:23:20'),
	(8, 'winnioe', 'teste@gmail.com', 'Teste', '$2y$10$WdMBOYAVQQhYwymY9LcsaOeXQorQc904RLytOXbRtqINM8ex6lVG6', 'Teste', 'SE', 'Amparo do SÃ£o Francisco', '', '', '', NULL, NULL, '2023-11-12', '2023-11-04 18:23:19'),
	(10, 'winnio', 'test1e@gmail.com', 'Teste', '$2y$10$g7lKKJR6ZhJ11mytG8E8huIz3IVhqYolDtWFhBwomArcGyAKfEBsm', 'Teste', 'SE', 'Amparo do SÃ£o Francisco', '', '', '', NULL, NULL, '2023-11-12', '2023-11-05 18:23:18'),
	(11, 'testeee', 'testw@gmail.com', 'Teste', '$2y$10$Rq92u4N59pmduKjRVBTM9u92w1gyVv3eBIJUpo86dSjt3865jICxK', 'teste', 'RN', 'ArÃªs', '', '', '', NULL, NULL, '2023-11-12', '2023-11-06 18:23:17'),
	(12, 'winniestefany', 'winnieteste@gmail.com', 'Winnie', 'c592a4cdea42bc838cf8c8b8e223126e', 'Silva', 'SP', 'Adamantina', '', '', '', NULL, NULL, '2023-11-12', '2023-11-07 18:23:23'),
	(13, 'winnierafa', 'winnierafa3003@gmail.com', 'Winnie', '$2y$10$lyWA0FebEnQvpW61IWOT/uGgkLbARCTvXwcxowi8/A4HIuqecLKHq', 'Silva', 'PE', 'Abreu e Lima', NULL, NULL, NULL, NULL, NULL, '1969-12-31', '2023-11-08 20:32:20'),
	(16, 'testeexcluir', 'testeexcluir@gmail.com', 'testeee', '$2y$10$Y4oSw0c5W0gIlwLo7V/pyebqyUndtMWsu4vuU1WAG0GE/a6MhhpZe', 'excluir', 'BA', 'Abaíra', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-09 03:06:10'),
	(17, 'testeexcluire', 'testeexcluire@gmail.com', 'testeee', '$2y$10$I57gRBVkmcMRUokNN6HH5OujlzVb3dAJjpOmoxrTnfv2NM2o1kuI.', 'excluir', 'PI', 'Acauã', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-10 03:07:02'),
	(18, 'testeexcluiree', 'testeexcluiree@gmail.com', 'testeee', '$2y$10$sgob.zMkpu3EtxRQ0dYZG.HhBF/5zcbV9Na/yQRgrPIMWwkmGKg3y', 'excluir', 'AL', 'Água Branca', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-11 03:09:03'),
	(19, 'testeexcluira', 'testeexcluira@gmail.com', 'Winnie', '$2y$10$TH3q7QNULbfBlg6wfhXQr.y/mumZRPRH6tgVMrjPWoarAStOWC00e', 'Silva', 'TO', 'Abreulândia', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-12 03:11:08'),
	(20, 'testeexcluirae', 'testeexcluirae@gmail.com', 'teste', '$2y$10$nDTgw0qQn6J8O2.G4/UIFusrlxI3bdMvkH34PgYKv8OSGu9YO3DGu', 'excluir', 'MG', 'Abadia dos Dourados', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-13 13:13:51'),
	(21, 'jgsavd', 'hjasbf@gmail.com', 'winnhi', '$2y$10$xV7ApRFF/WZ6hDwc/iq63.Bb8HEEK/N0.KH9NPTOzeXxxRDJzYici', 'Silva', 'PE', 'Alagoinha', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-14 03:18:13'),
	(22, 'jgsavds', 'hjasbfs@gmail.com', 'winnhi', '$2y$10$T4HLB2rUhQhae98oVmXi8ugaU8Qe9Z9XEQDhI5jLlbGkJRA9uUYuq', 'Silva', 'SE', 'Amparo do São Francisco', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-15 03:21:27'),
	(23, 'faef', 'asedf@gmail.com', 'rgzsdzg', '$2y$10$PbUip9L/3i9ycdvhz2udveFqOR.kXCWnjL3bVxrDnJNpk/YT9sQ1O', 'fdzsdfd', 'CE', 'Abaiara', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-16 03:25:18'),
	(24, 'a', 'assedf@gmail.com', 'rgzsddzg', 'd', 'd', 'd', 'Abaiara', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-17 03:25:18'),
	(26, 'd', 'asseddf@gmail.com', 'rgzsddzg', 'd', 'd', 'd', 'Abaiara', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-19 03:25:18'),
	(28, 's', 'assesdf@gmail.com', 's', 'd', 'd', 'd', 'Abaiara', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-18 03:25:18'),
	(29, 'c', 'c', 'rgzsddzg', 'd', 'd', 'd', 'Abaiara', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-22 03:25:18'),
	(30, 'w', 'assedwdf@gmail.com', 'rgzsddzg', 'd', 'd', 'd', 'Abaiara', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-20 03:25:18'),
	(31, 'r', 'assedw4df@gmail.com', 'rgzsddzg', 'd', 'd', 'd', 'Abaiara', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-11-21 03:25:18'),
	(32, 'murie', 'murilloalmeida@gmail.com', 'murillo ', '$2y$10$YeMRR.yazE5jRzsIOXLQMuwbvmmT2HUWSTv8W4gyXTGOkKr4xyMS6', 'alves', 'PE', 'Araripina', NULL, '../assets/bluBloomie.png', NULL, NULL, NULL, '1969-12-31', '2023-12-06 11:22:44');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
