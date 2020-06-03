-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.20 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5992
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para tcc
DROP DATABASE IF EXISTS `tcc`;
CREATE DATABASE IF NOT EXISTS `tcc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tcc`;

-- Copiando estrutura para tabela tcc.cargos
DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nome` varchar(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tcc.cargos: ~2 rows (aproximadamente)
DELETE FROM `cargos`;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` (`id`, `nome`) VALUES
	(1, 'Administrador'),
	(2, 'Médico Veterinário');
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.clientes
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(128) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `rg` varchar(16) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT NULL,
  `cadastrado_por` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_cadastrado_por` (`cadastrado_por`),
  CONSTRAINT `cliente_cadastrado_por` FOREIGN KEY (`cadastrado_por`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tcc.clientes: ~2 rows (aproximadamente)
DELETE FROM `clientes`;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nome_completo`, `cpf`, `rg`, `data_cadastro`, `cadastrado_por`) VALUES
	(2, 'Vitor Vasconcellos', '457.267.518-09', '384976463', NULL, 1),
	(3, 'Bruna Borges Unzelte', '405.932.398-57', '', NULL, 1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.clientes_emails
DROP TABLE IF EXISTS `clientes_emails`;
CREATE TABLE IF NOT EXISTS `clientes_emails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_email` (`cliente_id`),
  CONSTRAINT `cliente_email` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tcc.clientes_emails: ~3 rows (aproximadamente)
DELETE FROM `clientes_emails`;
/*!40000 ALTER TABLE `clientes_emails` DISABLE KEYS */;
INSERT INTO `clientes_emails` (`id`, `cliente_id`, `email`) VALUES
	(1, 2, 'vvasconcellos1@gmail.com'),
	(2, 3, 'borgesbrunap@gmail.com'),
	(3, 2, 'contato@vitorvasconcellos.com.br');
/*!40000 ALTER TABLE `clientes_emails` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.clientes_enderecos
DROP TABLE IF EXISTS `clientes_enderecos`;
CREATE TABLE IF NOT EXISTS `clientes_enderecos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `numero` varchar(8) DEFAULT NULL,
  `complemento` varchar(16) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_endereco` (`cliente_id`),
  CONSTRAINT `cliente_endereco` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tcc.clientes_enderecos: ~2 rows (aproximadamente)
DELETE FROM `clientes_enderecos`;
/*!40000 ALTER TABLE `clientes_enderecos` DISABLE KEYS */;
INSERT INTO `clientes_enderecos` (`id`, `cliente_id`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `uf`) VALUES
	(1, 2, '09820-150', 'Rua Professor Antônio Nascimento', '201', '13A', 'Demarchi', 'São Bernardo do Campo', 'SP'),
	(2, 3, '09921-000', 'Avenida das Nações', '519', '', 'Taboão', 'Diadema', 'SP');
/*!40000 ALTER TABLE `clientes_enderecos` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.clientes_telefones
DROP TABLE IF EXISTS `clientes_telefones`;
CREATE TABLE IF NOT EXISTS `clientes_telefones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int DEFAULT NULL,
  `telefone` varchar(16) DEFAULT NULL,
  `whatsapp` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_telefone` (`cliente_id`),
  CONSTRAINT `cliente_telefone` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tcc.clientes_telefones: ~2 rows (aproximadamente)
DELETE FROM `clientes_telefones`;
/*!40000 ALTER TABLE `clientes_telefones` DISABLE KEYS */;
INSERT INTO `clientes_telefones` (`id`, `cliente_id`, `telefone`, `whatsapp`) VALUES
	(1, 2, '(11) 95045-1456', 1),
	(2, 3, '(11) 98827-5220', 1);
/*!40000 ALTER TABLE `clientes_telefones` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.consultas
DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data` timestamp NULL DEFAULT NULL,
  `funcionario_id` bigint unsigned NOT NULL DEFAULT '0',
  `paciente_id` int NOT NULL DEFAULT '0',
  `observacoes` varchar(2048) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `consulta_funcionario` (`funcionario_id`),
  KEY `consulta_paciente` (`paciente_id`),
  CONSTRAINT `consulta_funcionario` FOREIGN KEY (`funcionario_id`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `consulta_paciente` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tcc.consultas: ~0 rows (aproximadamente)
DELETE FROM `consultas`;
/*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
INSERT INTO `consultas` (`id`, `data`, `funcionario_id`, `paciente_id`, `observacoes`) VALUES
	(1, '2020-06-03 00:35:35', 1, 8, 'dasdsadsa'),
	(2, '2020-06-03 00:37:20', 1, 8, 'dasdsadsa');
/*!40000 ALTER TABLE `consultas` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.especies
DROP TABLE IF EXISTS `especies`;
CREATE TABLE IF NOT EXISTS `especies` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tcc.especies: ~4 rows (aproximadamente)
DELETE FROM `especies`;
/*!40000 ALTER TABLE `especies` DISABLE KEYS */;
INSERT INTO `especies` (`id`, `nome`) VALUES
	(1, 'Equino'),
	(2, 'Felino'),
	(3, 'Canino'),
	(4, 'Suíno');
/*!40000 ALTER TABLE `especies` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tcc.migrations: ~0 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.pacientes
DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT NULL,
  `cliente_id` int DEFAULT NULL,
  `raca_id` bigint DEFAULT NULL,
  `cadastrado_por` bigint unsigned DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `cor` varchar(32) DEFAULT NULL,
  `porte` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paciente_cadastrado_por` (`cadastrado_por`),
  KEY `paciente_especie` (`raca_id`) USING BTREE,
  KEY `paciente_cliente` (`cliente_id`),
  CONSTRAINT `paciente_cadastrado_por` FOREIGN KEY (`cadastrado_por`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `paciente_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `paciente_raca` FOREIGN KEY (`raca_id`) REFERENCES `racas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tcc.pacientes: ~2 rows (aproximadamente)
DELETE FROM `pacientes`;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` (`id`, `nome`, `data_cadastro`, `cliente_id`, `raca_id`, `cadastrado_por`, `sexo`, `cor`, `porte`) VALUES
	(7, 'ARthurr22', NULL, 2, 6, 1, 'M', 'branco2\'1', 'G'),
	(8, 'ARthur', NULL, 2, 2, 1, 'M', 'branco', 'M');
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.racas
DROP TABLE IF EXISTS `racas`;
CREATE TABLE IF NOT EXISTS `racas` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) DEFAULT NULL,
  `especie_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `raca_especie` (`especie_id`),
  CONSTRAINT `raca_especie` FOREIGN KEY (`especie_id`) REFERENCES `especies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela tcc.racas: ~7 rows (aproximadamente)
DELETE FROM `racas`;
/*!40000 ALTER TABLE `racas` DISABLE KEYS */;
INSERT INTO `racas` (`id`, `nome`, `especie_id`) VALUES
	(1, 'Bengal', 2),
	(2, 'Poodle', 3),
	(3, 'Pug', 3),
	(4, 'Golden Retriever', 3),
	(5, 'Boxer', 3),
	(6, 'Siamês', 2),
	(7, 'Russo', 2);
/*!40000 ALTER TABLE `racas` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela tcc.usuarios: ~5 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome_completo`, `email`, `password`, `ativo`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Vitor Vasconcellos', 'vvasconcellos1@gmail.com', '$2y$10$73qZA5WBPFg75n8fTacVkevzLJSavRNMszfCLRseRAxxpTLRL0bLW', 1, NULL, NULL, NULL),
	(2, 'Usuário Teste223', 'vitor@vitor.com2', '$2y$10$73qZA5WBPFg75n8fTacVkevzLJSavRNMszfCLRseRAxxpTLRL0bLW', 1, NULL, NULL, '2020-04-28 23:52:13'),
	(3, 'Usuário Teste 2', 'vitor@vitor.com', '$2y$10$aWIaZPHw9g87aMSi55nE4.T4OkUKWCisF6HLqoptL3YeF8U4GwlHG', 0, NULL, '2020-04-15 22:34:30', '2020-04-15 23:37:32'),
	(4, 'Bruna Borges Unzelte', 'borgesbrunap@gmail.com', '$2y$10$VSWuIOvC.0VUMdhiZ/dYRu/6o22iXmKJ8SbBScUNVQ5K3.H2TFiT2', 1, NULL, '2020-04-15 23:40:35', '2020-04-15 23:40:35'),
	(6, 'Roberto Piagem', 'roberto.piagem@unipaulistana.edu.br', '$2y$10$z...ScmwUBZEtoLxDQwsous/IPM1S1e32Xh5AvfEMpmQ1sy21ExLu', 1, NULL, '2020-04-29 22:34:31', '2020-04-29 22:34:31');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Copiando estrutura para tabela tcc.usuarios_permissoes
DROP TABLE IF EXISTS `usuarios_permissoes`;
CREATE TABLE IF NOT EXISTS `usuarios_permissoes` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint unsigned NOT NULL DEFAULT '0',
  `cargo_id` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `cargo_permissao` (`cargo_id`),
  KEY `usuario_permissao` (`usuario_id`),
  CONSTRAINT `cargo_permissao` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`),
  CONSTRAINT `usuario_permissao` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela tcc.usuarios_permissoes: ~8 rows (aproximadamente)
DELETE FROM `usuarios_permissoes`;
/*!40000 ALTER TABLE `usuarios_permissoes` DISABLE KEYS */;
INSERT INTO `usuarios_permissoes` (`id`, `usuario_id`, `cargo_id`) VALUES
	(1, 1, 1),
	(3, 2, 1),
	(4, 1, 2),
	(5, 4, 1),
	(8, 4, 2),
	(12, 2, 2),
	(13, 6, 1),
	(14, 6, 2);
/*!40000 ALTER TABLE `usuarios_permissoes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
