DROP DATABASE IF EXISTS FirmaUber;

CREATE DATABASE IF NOT EXISTS FirmaUber;

use FirmaUber;

CREATE TABLE IF NOT EXISTS motorista (
  ID INT(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  cnh INT(11) UNSIGNED ZEROFILL NOT NULL,
  endereco VARCHAR(100) NOT NULL,
  documento VARCHAR(17) NOT NULL,
  dataInicio DATE NOT NULL,
  dataFim DATE,
  obs VARCHAR(150),
  status INT(1) NOT NULL DEFAULT '1',
  CONSTRAINT pk_motorista PRIMARY key (ID)
);

CREATE TABLE IF NOT EXISTS carro (
  ID INT(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  placa CHAR(7) NOT NULL,
  renavam INT(11) UNSIGNED ZEROFILL NOT NULL,
  modelo VARCHAR(25) NOT NULL,
  documento VARCHAR(17) NOT NULL,
  dataInicio DATE NOT NULL,
  dataFim DATE,
  obs VARCHAR(150),
  status INT(1) NOT NULL DEFAULT '1',
  CONSTRAINT pk_carro PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS turno(
  ID INT(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  idMot INT(2) UNSIGNED ZEROFILL NOT NULL,
  idCarro INT(2) UNSIGNED ZEROFILL NOT NULL,
  inicioTurno DATETIME NOT NULL,
  fimTurno DATETIME NOT NULL,
  kmInicial INT(6) NOT NULL,
  kmFinal INT(6) NOT NULL,
  faturamento DOUBLE NOT NULL,
  taxaUber DOUBLE NOT NULL,
  combustivel DOUBLE NOT NULL,
  despesas DOUBLE NOT NULL,
  pago DOUBLE NOT NULL,
  CONSTRAINT pk_turno PRIMARY KEY (ID),
  CONSTRAINT fk_motorista FOREIGN KEY (idMot) REFERENCES motorista(ID),
  CONSTRAINT fk_carro FOREIGN KEY (idCarro) REFERENCES carro(ID)
);

CREATE TABLE IF NOT EXISTS banco(
  ID INT(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  valor DOUBLE NOT NULL,
  descricao VARCHAR(150),
  CONSTRAINT pk_banco PRIMARY KEY (ID)
);

--
-- FIM CRIAÇÃO TABELAS INICIO INSERTS
--

INSERT INTO `carro` (`placa`, `modelo`, `renavam`, `dataInicio`, `dataFim`, `obs`, `status`) VALUES
  ('IOR8788', '206 Prata - 2008', '963025805', '2017-01-01', NULL, NULL, 1),
  ('ITB9345', 'Logan Vermelho - 2012', '465932550', '2017-02-13', '2017-02-26', 'Contrato 9662', 0),
  ('ITW6608', 'Classic Branco - 2012', '501983554', '2017-03-02', NULL, 'Contrato 9662', 1),
  ('ITT6409', 'Classic Preto - 2012', '496676326', '2017-03-07', '2017-03-14', 'Contrato 9706', 0),
  ('ITX7826', 'Classic Branco - 2012', '503900869', '2017-03-20', NULL, 'Contrato 9706', 1),
  ('ISM1799', 'Voyage Preto - 2012', '381805085', '2017-03-25', NULL, 'Contrato Grasiela', 1);

INSERT INTO `motorista` (`nome`, `cnh`, `endereco`, `dataInicio`, `dataFim`, `obs`, `status`) VALUES
  (' FIRMA', 0, 'R. Jorge Amado, 807 - Santa Cruz', '2017-01-01', NULL, NULL, 1),
  ('Mikhael Bitelo', '05974189354', 'R. Jorge Amado, 884 - Santa Cruz', '2017-01-01', NULL, NULL, 1),
  ('Sander Eduardo Gomes', 0, 'R. Virginia - Santa Cruz', '2017-01-01', NULL, NULL, 1),
  ('Alex Rocha', 0, 'R. São Luis, 1115 - São Luiz', '', NULL, NULL, 1),
  ('Grazi', 0, '', '2017-03-06', '2017-03-11', NULL, 0),
  ('Eduardo', 0, '', '2017-03-07', '2017-03-08', NULL, 0),
  ('Paulo', 0, 'R. Everest, 330 - Jansen', '2017-03-06', NULL, NULL, 1),
  ('Jonnes Caetano Malosco', '3830915924', 'R. José de Alencar, 92 - Bom Sucesso', '', NULL, NULL, 1),
  ('Luan Silva dos Santos', '5389961012', 'R. Provincia, 6 - Planaltina', '2017-03-20', NULL, NULL, 1),
  ('Cristiano Fischer Tavares', '', 'R. Pampa, 1226 - Sitio Gaucho', 'NULL', NULL, NULL, 1),
  ('Bruno Baldin', 'Tv. Santos, 90 - Vila Vista Alegre', '', 'NULL', NULL, NULL, 1),
  ('Jefferson', 'Tv. Conceição, 453 - Castelo Branco', '', 'NULL', NULL, NULL, 1);

INSERT INTO `banco` (`valor`, `descricao`) VALUES
  ( 100,'Capital'),
  ( -177,'Abastecimento ITX7826'),
  ( -142,'Emprestimo Alex'),
  ( -14,'Pedagio buscar ITX7826'),
  ( -20,'lanche Reunião'),
  ( -818,'Emprestimo Sander');
