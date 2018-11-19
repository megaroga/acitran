-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.1.9-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela qs.qs_bairros
CREATE TABLE IF NOT EXISTS `qs_bairros` (
  `codigo` int(15) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `cod_cidade` varchar(250) DEFAULT NULL,
  `coord` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela qs.qs_bairros: ~29 rows (aproximadamente)
/*!40000 ALTER TABLE `qs_bairros` DISABLE KEYS */;
INSERT INTO `qs_bairros` (`codigo`, `titulo`, `cod_cidade`, `coord`) VALUES
	(2, 'Jardim América', '1', '-11.941536, -55.512036'),
	(3, 'Jardim Atenas', '1', '-11.837562, -55.484696'),
	(4, 'Jardim Azaleias', '1', '-11.821619, -55.504821'),
	(5, 'Jardim Boa Esperança', '1', '-11.833670, -55.523263'),
	(6, 'Jardim Botânico', '1', '-11.868366, -55.506683'),
	(7, 'Jardim Bougainville', '1', '-11.888716, -55.539880'),
	(8, 'Jardim Celeste', '1', '-11.880520, -55.512594'),
	(9, 'Jardim Conquista', '1', ''),
	(10, 'Jardim das Nações', '1', ''),
	(11, 'Jardim das Oliveiras', '1', ''),
	(12, 'Jardim das Orquídeas', '1', ''),
	(13, 'Jardim das Palmeiras', '1', ''),
	(14, 'Jardim das Violetas', '1', ''),
	(15, 'Jardim Europa', '1', ''),
	(16, 'Jardim Ibirapuera', '1', ''),
	(17, 'Jardim Imperial', '1', ''),
	(18, 'Jardim Itália', '1', ''),
	(19, 'Jardim Itália II', '1', ''),
	(20, 'Jardim Jacarandás', '1', ''),
	(21, 'Jardim Maria Carolina', '1', ''),
	(22, 'Jardim Maria Vindilina I', '1', ''),
	(23, 'Jardim Maria Vindilina II', '1', ''),
	(24, 'Jardim Maria Vindilina III', '1', ''),
	(25, 'Jardim Maringá', '1', ''),
	(26, 'Jardim Menino Jesus', '1', ''),
	(27, 'Jardim Nações I', '1', ''),
	(28, 'Jardim Nações II', '1', ''),
	(29, 'Jardim Primavera', '1', ''),
	(30, 'Jardim Santa Mônica', '1', ''),
	(31, 'Jardim São Paulo', '1', ''),
	(32, 'Jardim São Paulo II', '1', ''),
	(33, 'Jardim Terra Rica', '1', ''),
	(34, 'Jardim Umuarama', '1', ''),
	(35, 'Centro', '1', '-11.853501, -55.503484');
/*!40000 ALTER TABLE `qs_bairros` ENABLE KEYS */;


-- Copiando estrutura para tabela qs.qs_cidades
CREATE TABLE IF NOT EXISTS `qs_cidades` (
  `codigo` int(15) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `uf` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela qs.qs_cidades: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `qs_cidades` DISABLE KEYS */;
INSERT INTO `qs_cidades` (`codigo`, `titulo`, `uf`) VALUES
	(1, 'Sinop', 'MT');
/*!40000 ALTER TABLE `qs_cidades` ENABLE KEYS */;


-- Copiando estrutura para tabela qs.qs_ocorrencias
CREATE TABLE IF NOT EXISTS `qs_ocorrencias` (
  `codigo` int(15) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `cod_cidade` int(10) DEFAULT NULL,
  `cod_bairro` int(10) DEFAULT NULL,
  `coord` varchar(250) DEFAULT NULL,
  `endereco` varchar(250) DEFAULT NULL,
  `veiculo` varchar(250) DEFAULT NULL,
  `qtd_envolvidos` int(6) DEFAULT NULL,
  `qtd_mortes` int(10) DEFAULT NULL,
  `tp_socorro` int(10) DEFAULT NULL,
  `data_ocorrencia` datetime DEFAULT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela qs.qs_ocorrencias: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `qs_ocorrencias` DISABLE KEYS */;
INSERT INTO `qs_ocorrencias` (`codigo`, `titulo`, `cod_cidade`, `cod_bairro`, `coord`, `endereco`, `veiculo`, `qtd_envolvidos`, `qtd_mortes`, `tp_socorro`, `data_ocorrencia`, `data_cadastro`, `tipo`) VALUES
	(1, 'Acidente Imperial, perto  UNEMAT', 1, 17, '-11.842679, -55.517694', 'Rua dos Marfins, 128', 'Moto e bicicleta', 2, 0, 10, '2018-11-01 10:39:00', '2018-11-18 13:42:19', NULL),
	(2, 'Acidente Sibipirunas', 1, 20, '-11.883249, -55.508864', 'Rua Sibipirunas, 404', 'moto e carro', 3, 0, 15, '2018-11-01 10:39:00', '2018-11-18 13:44:54', NULL),
	(3, 'Acidente Caviunas', 0, 25, '-11.857770, -55.517375', 'Rua das Caviúnas', '2 carros', 3, 1, 25, '2018-11-06 23:25:00', '2018-11-18 23:28:15', NULL),
	(4, 'Acidente Boa Esperança', 0, 5, '-11.842062, -55.520722', 'Av. André Maggi', '2 motos', 2, 0, 32, '2018-11-11 23:48:00', '2018-11-18 23:50:22', NULL),
	(5, 'Acidente moto Dombéiais', 0, 11, '-11.821396, -55.508019', 'Rua Dombéiais 145', '2 motos', 2, 0, 29, '2018-11-12 23:51:00', '2018-11-18 23:52:21', NULL),
	(6, 'Acdente chapecó', 0, 33, '-11.881189, -55.492234', 'Rua Chapecó 402', 'Moto e caminhão', 2, 0, 35, '2018-11-13 23:53:00', '2018-11-18 23:54:37', NULL),
	(7, 'Acidente Bougainville', 0, 7, '-11.891068, -55.540309', 'Rua JB14', '2 motos', 3, 0, 38, '2018-11-13 23:54:00', '2018-11-18 23:56:50', NULL),
	(8, 'Acidente Italia II', 0, 19, '-11.849398, -55.534797', 'Rua Roma', '1 camioneta e 1 carro', 4, 0, 26, '2018-11-15 23:57:00', '2018-11-18 23:58:56', NULL),
	(9, 'Acidente Nações - Perdiz', 0, 10, '-11.858776, -55.530778', 'Rua dos Perdiz 150', '1 moto e 1 carro', 3, 0, 25, '2018-11-11 00:01:00', '2018-11-19 00:03:24', NULL),
	(10, 'Acidente São Paulo', 0, 31, '-11.826126, -55.519179', 'Rua Carlos Eduardo 875', '1 camioneta e 1 carro', 5, 1, 28, '2018-11-13 00:04:00', '2018-11-19 00:05:46', NULL),
	(11, 'Acidente motos BR', 0, 34, '-11.910950, -55.508633', 'Rua Colonizador Énio Pipino', '2 motos', 2, 0, 13, '2018-11-16 00:05:00', '2018-11-19 00:07:38', NULL),
	(12, 'Acidente fatal Figueiras', 0, 35, '-11.853501, -55.503484', 'Av. Das Figueiras 1750', '2 carros', 4, 0, 14, '2018-11-16 08:09:00', '2018-11-19 00:10:29', NULL),
	(13, 'Acidente perto do Machado', 0, 35, '-11.850110, -55.508881', 'Av. das Itaúbas 3795', '2 carros', 3, 0, 15, '2018-11-17 10:10:00', '2018-11-19 00:12:18', NULL),
	(14, 'Acidente BR - Terra Rica', 0, 33, '-11.879930, -55.499654', 'Av. Pedro Moreira de Carvalho', 'Moto e caminhão', 2, 1, 60, '2018-11-04 00:17:00', '2018-11-19 00:19:28', NULL),
	(15, 'Acidente Oliveiras', 0, 11, '-11.829648, -55.506989', 'Av. dos Pinheiros', '2 carros', 3, 0, 25, '2018-11-16 16:19:00', '2018-11-19 00:21:17', NULL),
	(16, 'Acidente Jacarandá - Jd. Primaveras', 0, 29, '-11.836788, -55.492591', 'Av. Jacarandás 5899', '1 camioneta e 1 carro', 4, 0, 25, '2018-11-18 10:21:00', '2018-11-19 00:23:30', NULL),
	(17, 'Acidente Coqueiros', 0, 6, '-11.830214, -55.513705', 'Rua dos Coqueiros', 'moto e carro', 3, 0, 28, '2018-11-17 18:32:00', '2018-11-19 00:35:40', NULL),
	(18, 'Acidente Bicicleta - Moto', 0, 6, '-11.865406, -55.513356', 'Rua dos Cedros 1400', 'Moto e bicicleta', 2, 0, 25, '2018-11-08 09:36:00', '2018-11-19 00:37:18', NULL),
	(19, 'Acidente Jatobás', 0, 8, '-11.879768, -55.510717', 'Av. dos Jatobas 1088', '2 motos', 2, 0, 26, '2018-11-05 07:30:00', '2018-11-19 00:39:02', NULL),
	(20, 'Acidente Motos - Ibirapuera', 0, 16, '-11.887122, -55.512359', 'Rua Interlagos 250', '2 motos', 3, 0, 25, '2018-11-02 07:39:00', '2018-11-19 00:40:41', NULL);
/*!40000 ALTER TABLE `qs_ocorrencias` ENABLE KEYS */;


-- Copiando estrutura para tabela qs.qs_usuarios
CREATE TABLE IF NOT EXISTS `qs_usuarios` (
  `codigo` int(15) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) DEFAULT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL,
  `ultimoAcesso` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Copiando dados para a tabela qs.qs_usuarios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `qs_usuarios` DISABLE KEYS */;
INSERT INTO `qs_usuarios` (`codigo`, `email`, `nome`, `senha`, `ultimoAcesso`, `ip`, `tipo`) VALUES
	(1, 'emergencia@sinop.com', 'Rodolfo Medina', '5d9679fac7d451243842b90267de2f82', NULL, NULL, NULL);
/*!40000 ALTER TABLE `qs_usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
