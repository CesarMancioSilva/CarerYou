CREATE USER 'TCC_CARER_YOU'@'localhost' IDENTIFIED BY 'TCC-3DS2-2022';
GRANT ALL PRIVILEGES ON *.* TO 'TCC_CARER_YOU'@'localhost' WITH GRANT OPTION;

SELECT * FROM MYSQL.USER;

CREATE DATABASE BD_CARER_YOU CHARACTER SET = 'UTF8MB4' COLLATE = 'UTF8MB4_GENERAL_CI';
USE BD_CARER_YOU;

CREATE TABLE IF NOT EXISTS TB_UF 
(
	SG_UF CHAR(2) NOT NULL,
    NM_UF VARCHAR(50) NOT NULL,
    CONSTRAINT PK_UF
		PRIMARY KEY(SG_UF)
)
ENGINE = InnoDB;
INSERT INTO TB_UF VALUES
('SP', 'Sâo Paulo');

CREATE TABLE IF NOT EXISTS TB_CIDADE
(
	ID_CIDADE INT NOT NULL AUTO_INCREMENT,
    NM_CIDADE VARCHAR(50) NOT NULL,
    SG_UF CHAR(2) NOT NULL,
    CONSTRAINT FK_CIDADE_UF
		FOREIGN KEY(SG_UF)
			REFERENCES TB_UF(SG_UF)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PK_CIDADE
		PRIMARY KEY(ID_CIDADE)
)
ENGINE = InnoDB;
INSERT INTO TB_CIDADE VALUES
(DEFAULT,'Sâo Vicente','SP'),
(DEFAULT,'Santos','SP');

CREATE TABLE IF NOT EXISTS TB_BAIRRO
(
	ID_BAIRRO INT NOT NULL AUTO_INCREMENT,
    NM_BAIRRO VARCHAR(50) NOT NULL,
    ID_CIDADE INT NOT NULL,
    CONSTRAINT FK_BAIRRO_CIDADE
		FOREIGN KEY(ID_CIDADE)
			REFERENCES TB_CIDADE(ID_CIDADE)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PK_BAIRRO
		PRIMARY KEY(ID_BAIRRO)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_ENDERECO
(
	ID_ENDERECO INT NOT NULL AUTO_INCREMENT,
    DS_ENDERECO VARCHAR(100) NOT NULL,
    ID_BAIRRO INT NOT NULL,
    CONSTRAINT FK_ENDERECO_BAIRRO
		FOREIGN KEY(ID_BAIRRO)
			REFERENCES TB_BAIRRO(ID_BAIRRO)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PK_ENDERECO 
		PRIMARY KEY(ID_ENDERECO)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_TIPO_LOCAL
(
	ID_TIPO_LOCAL INT NOT NULL AUTO_INCREMENT,
    DS_TIPO_LOCAL VARCHAR(50) NOT NULL,
    CONSTRAINT UNIQUE_TIPO_LOCAL
		UNIQUE KEY(DS_TIPO_LOCAL),
	CONSTRAINT PK_TIPO_LOCAL
		PRIMARY KEY(ID_TIPO_LOCAL)
)
ENGINE = InnoDB;
INSERT INTO TB_TIPO_LOCAL VALUES
(DEFAULT,'Asilo'),
(DEFAULT,'Casa de repouso');

CREATE TABLE IF NOT EXISTS TB_LOCAL
(
	ID_LOCAL INT NOT NULL AUTO_INCREMENT,
    NM_LOCAL VARCHAR(100) NOT NULL,
    DS_LOCAL VARCHAR(1000) DEFAULT 'Local registrado no sistema Carer You',
    NM_FOTO_LOCAL VARCHAR(1000) NOT NULL,
    ID_ENDERECO INT,
    ID_TIPO_LOCAL INT,
    CONSTRAINT FK_LOCAL_TIPO_LOCAL
		FOREIGN KEY(ID_TIPO_LOCAL)
			REFERENCES TB_TIPO_LOCAL(ID_TIPO_LOCAL)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT FK_LOCAL_ENDERECO
		FOREIGN KEY(ID_ENDERECO)
			REFERENCES TB_ENDERECO(ID_ENDERECO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT PK_LOCAL
		PRIMARY KEY(ID_LOCAL)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_TIPO_CONTATO
(
	ID_TIPO_CONTATO INT NOT NULL AUTO_INCREMENT,
    DS_TIPO_CONTATO VARCHAR(50) NOT NULL,
    CONSTRAINT UNIQUE_TIPO_CONTATO
		UNIQUE KEY(DS_TIPO_CONTATO),
	CONSTRAINT PK_TIPO_CONTATO
		PRIMARY KEY(ID_TIPO_CONTATO)
)
ENGINE = InnoDB;
INSERT INTO TB_TIPO_CONTATO VALUES
(DEFAULT,'E-Mail'),
(DEFAULT,'Celular');

CREATE TABLE IF NOT EXISTS TB_CONTATO
(
	ID_CONTATO INT NOT NULL AUTO_INCREMENT,
    DS_CONTATO VARCHAR(50) NOT NULL,
    ID_TIPO_CONTATO INT,
    CONSTRAINT UNIQUE_CONTATO
		UNIQUE KEY(DS_CONTATO),
	CONSTRAINT FK_CONTATO_TIPO_CONTATO
		FOREIGN KEY(ID_TIPO_CONTATO)
			REFERENCES TB_TIPO_CONTATO(ID_TIPO_CONTATO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT PK_CONTATO
		PRIMARY KEY(ID_CONTATO)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS CONTATO_LOCAL
(
	ID_LOCAL INT NOT NULL,
    ID_CONTATO INT NOT NULL,
    CONSTRAINT FK_CONTATO_LOCAL_LOCAL
		FOREIGN KEY(ID_LOCAL)
			REFERENCES TB_LOCAL(ID_LOCAL)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_CONTATO_LOCAL_CONTATO
		FOREIGN KEY(ID_CONTATO)
			REFERENCES TB_CONTATO(ID_CONTATO)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PK_CONTATO_LOCAL
		PRIMARY KEY(ID_LOCAL, ID_CONTATO)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_GENERO_USUARIO
(
	ID_GENERO_USUARIO INT NOT NULL AUTO_INCREMENT,
    DS_GENERO_USUARIO VARCHAR(50) NOT NULL,
    CONSTRAINT UNIQUE_GENERO_USUARIO
		UNIQUE KEY(DS_GENERO_USUARIO),
	CONSTRAINT PK_GENERO_USUARIO
		PRIMARY KEY(ID_GENERO_USUARIO)
)
ENGINE = InnoDB;
INSERT INTO TB_GENERO_USUARIO VALUES
(DEFAULT,'Masculino'),
(DEFAULT,'Feminino'),
(DEFAULT,'Prefiro nâo dizer');

CREATE TABLE IF NOT EXISTS TB_STATUS_USUARIO
(
	ID_STATUS_USUARIO INT NOT NULL AUTO_INCREMENT,
    DS_STATUS_USUARIO VARCHAR(50) NOT NULL,
    CONSTRAINT UNIQUE_STATUS_USUARIO
		UNIQUE KEY(DS_STATUS_USUARIO),
	CONSTRAINT PK_STATUS_USUARIO
		PRIMARY KEY(ID_STATUS_USUARIO)
)
ENGINE = InnoDB;
INSERT INTO TB_STATUS_USUARIO VALUES
(DEFAULT,'Disponìvel'),
(DEFAULT,'Indisponìvel'),
(DEFAULT,'Em anàlise');

CREATE TABLE IF NOT EXISTS TB_TIPO_USUARIO
(
	ID_TIPO_USUARIO INT NOT NULL AUTO_INCREMENT,
    DS_TIPO_USUARIO VARCHAR(50) NOT NULL,
    CONSTRAINT UNIQUE_TIPO_USUARIO
		UNIQUE KEY(DS_TIPO_USUARIO),
	CONSTRAINT PK_TIPO_USUARIO
		PRIMARY KEY(ID_TIPO_USUARIO)
)
ENGINE = InnoDB;
INSERT INTO TB_TIPO_USUARIO VALUES
(DEFAULT,'Cliente'),
(DEFAULT,'Profissional'),
(DEFAULT,'Admin');

CREATE TABLE TB_USUARIO
(
	ID_USUARIO INT NOT NULL AUTO_INCREMENT,
    NM_USUARIO VARCHAR(255) NOT NULL,
    DS_EMAIL VARCHAR(255) NOT NULL,
    DS_SENHA VARCHAR(255) NOT NULL,
    CD_RG VARCHAR(30) NOT NULL,
    NM_FOTO_PERFIL VARCHAR(255) NOT NULL,
    ID_GENERO_USUARIO INT,
    ID_STATUS_USUARIO INT DEFAULT 1,
    ID_TIPO_USUARIO INT,
    ID_CIDADE INT,
    CONSTRAINT FK_USUARIO_GENERO_USUARIO
		FOREIGN KEY(ID_GENERO_USUARIO)
			REFERENCES TB_GENERO_USUARIO(ID_GENERO_USUARIO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT FK_USUARIO_STATUS_USUARIO
		FOREIGN KEY(ID_STATUS_USUARIO)
			REFERENCES TB_STATUS_USUARIO(ID_STATUS_USUARIO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT FK_USUARIO_TIPO_USUARIO
		FOREIGN KEY(ID_TIPO_USUARIO)
			REFERENCES TB_TIPO_USUARIO(ID_TIPO_USUARIO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT FK_USUARIO_CIDADE
		FOREIGN KEY(ID_CIDADE)
			REFERENCES TB_CIDADE(ID_CIDADE)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT UNIQUE_EMAIL
		UNIQUE KEY(DS_EMAIL),
	CONSTRAINT PK_USUARIO
		PRIMARY KEY(ID_USUARIO)
)
ENGINE = InnoDB;
INSERT INTO TB_USUARIO VALUES
(DEFAULT, 'ADM_CARER_YOU','admin@gmail.com','7c222fb2927d828af22f592134e8932480637c0d','60.430.796-2','adm.png',3,1,3,2);

SELECT * FROM TB_USUARIO;

CREATE TABLE CONTATO_USUARIO
(
	ID_USUARIO INT NOT NULL,
    ID_CONTATO INT NOT NULL,
    CONSTRAINT FK_CONTATO_USUARIO_USUARIO
		FOREIGN KEY(ID_USUARIO)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_CONTATO_USUARIO_CONTATO
		FOREIGN KEY(ID_CONTATO)
			REFERENCES TB_CONTATO(ID_CONTATO)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PK_CONTATO_USUARIO
		PRIMARY KEY(ID_USUARIO, ID_CONTATO)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_USUARIO_PROFISSIONAL
(
	ID_USUARIO_PROFISSIONAL INT NOT NULL AUTO_INCREMENT,
    NM_CERTIFICADO_PROFISSIONAL VARCHAR(255) NOT NULL,
    DS_PERFIL_PROFISSIONAL VARCHAR(1000),
    ID_USUARIO INT,
    CONSTRAINT FK_USUARIO_PROFISSIONAL_USUARIO
		FOREIGN KEY(ID_USUARIO)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT PK_USUARIO_PROFISSIONAL
		PRIMARY KEY(ID_USUARIO_PROFISSIONAL)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_PERGUNTA
(
	ID_PERGUNTA INT NOT NULL AUTO_INCREMENT,
    DS_PERGUNTAR VARCHAR(1000) NOT NULL,
    QTD_PERFUNTA INT DEFAULT 1,
    CONSTRAINT PK_PERGUNTA
		PRIMARY KEY(ID_PERGUNTA)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_DENUNCIA
(
	ID_DENUNCIA INT NOT NULL AUTO_INCREMENT,
    DS_DENUNCIA VARCHAR(2000) NOT NULL,
    ID_USUARIO_ORIGEM INT,
    ID_USUARIO_DESTINO INT,
    CONSTRAINT FK_DENUNCIA_USUARIO_ORIGEM
		FOREIGN KEY(ID_USUARIO_ORIGEM)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT FK_DENUNCIA_USUARIO_DESTINO
		FOREIGN KEY(ID_USUARIO_DESTINO)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT PK_DENUNCIA
		PRIMARY KEY(ID_DENUNCIA)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_MENSAGEM
(
	ID_MENSAGEM INT NOT NULL AUTO_INCREMENT,
    DS_MENSAGEM VARCHAR(500) NOT NULL,
    DT_MENSAGEM DATETIME DEFAULT NOW(),
    ID_USUARIO_ORIGEM INT,
    ID_USUARIO_DESTINO INT,
    CONSTRAINT FK_MENSAGEM_USUARIO_ORIGEM
		FOREIGN KEY(ID_USUARIO_ORIGEM)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT FK_MENSAGEM_USUARIO_DESTINO
		FOREIGN KEY(ID_USUARIO_DESTINO)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT PK_DENUNCIA
		PRIMARY KEY(ID_MENSAGEM)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_STATUS_SERVICO
(
	ID_STATUS_SERVICO INT NOT NULL AUTO_INCREMENT,
    DS_STATUS_SERVICO VARCHAR(50) NOT NULL,
    CONSTRAINT UNIQUE_STATUS_SERVICO
		UNIQUE KEY(DS_STATUS_SERVICO),
	CONSTRAINT PK_STATUS_SERVICO
		PRIMARY KEY(ID_STATUS_SERVICO)
)
ENGINE = InnoDB;
INSERT INTO TB_STATUS_SERVICO VALUES
(DEFAULT,'Em analise'),
(DEFAULT,'Em andamento'),
(DEFAULT,'Cancelado'),
(DEFAULT,'Concluìdo');

CREATE TABLE IF NOT EXISTS TB_SERVICO
(
	ID_SERVICO INT NOT NULL AUTO_INCREMENT,
    DS_SERVICO VARCHAR(500),
    HR_INICIO_SERVICO TIME NOT NULL,
    HR_TERMINO_SERVICO TIME NOT NULL,
    DT_SERVICO DATE NOT NULL,
    DT_PEDIDO_SERVICO DATETIME DEFAULT NOW(),
    ID_USUARIO INT,
    ID_USUARIO_PROFISSIONAL INT,
    ID_ENDERECO INT,
    CONSTRAINT FK_SERVICO_USUARIO
		FOREIGN KEY(ID_USUARIO)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT FK_SERVICO_USUARIO_PROFISSIONAL
		FOREIGN KEY(ID_USUARIO_PROFISSIONAL)
			REFERENCES TB_USUARIO_PROFISSIONAL(ID_USUARIO_PROFISSIONAL)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT FK_SERVICO_ENDERECO
		FOREIGN KEY(ID_ENDERECO)
			REFERENCES TB_ENDERECO(ID_ENDERECO)
				ON DELETE SET NULL ON UPDATE CASCADE,
	CONSTRAINT PK_SERVICO
		PRIMARY KEY(ID_SERVICO)
)
ENGINE = InnoDB;

CREATE VIEW VW_PROFISSIONAIS (ID_PROFISSIONAL, CERTIFICADO, NOME, EMAIL, RG, GENERO, FOTO, CIDADE, ESTADO, STATUS) AS
SELECT PRF.ID_USUARIO_PROFISSIONAL, PRF.NM_CERTIFICADO_PROFISSIONAL, US.NM_USUARIO, US.DS_EMAIL, US.CD_RG, GEN.DS_GENERO_USUARIO, US.NM_FOTO_PERFIL, CID.NM_CIDADE, CID.SG_UF, STTS.DS_STATUS_USUARIO
	FROM TB_USUARIO_PROFISSIONAL AS PRF 
		INNER JOIN TB_USUARIO AS US ON (PRF.ID_USUARIO = US.ID_USUARIO) 
			INNER JOIN TB_GENERO_USUARIO AS GEN ON (US.ID_GENERO_USUARIO = GEN.ID_GENERO_USUARIO)
				INNER JOIN TB_CIDADE AS CID ON (US.ID_CIDADE = CID.ID_CIDADE)
					INNER JOIN TB_STATUS_USUARIO AS STTS ON (US.ID_STATUS_USUARIO = STTS.ID_STATUS_USUARIO);

SELECT * FROM VW_PROFISSIONAIS;

SELECT US.NM_USUARIO, US.DS_EMAIL, US.DS_SENHA, US.CD_RG, US.NM_FOTO_PERFIL

DELIMITER //
CREATE PROCEDURE CADASTRAR_USUARIO(NOME VARCHAR(255), EMAIL VARCHAR(255), SENHA VARCHAR(255), RG VARCHAR(30), NOME_FOTO VARCHAR(255), GENERO VARCHAR(50), TIPO_USUARIO VARCHAR(30), CIDADE_USUARIO VARCHAR(50), NOME_CERTIFICADO VARCHAR(255))
BEGIN
	IF NOT TIPO_USUARIO = "Profissional" THEN
		INSERT INTO TB_USUARIO VALUES 
        (DEFAULT, NOME, EMAIL, SENHA, RG, NOME_FOTO, (SELECT ID_GENERO_USUARIO FROM TB_GENERO_USUARIO WHERE DS_GENERO_USUARIO = GENERO), DEFAULT, (SELECT ID_TIPO_USUARIO FROM TB_TIPO_USUARIO WHERE DS_TIPO_USUARIO = TIPO_USUARIO), (SELECT ID_CIDADE FROM TB_CIDADE WHERE NM_CIDADE = CIDADE_USUARIO));
    ELSE
		INSERT INTO TB_USUARIO VALUES
        (DEFAULT, NOME, EMAIL, SENHA, RG, NOME_FOTO, (SELECT ID_GENERO_USUARIO FROM TB_GENERO_USUARIO WHERE DS_GENERO_USUARIO = GENERO), 3, (SELECT ID_TIPO_USUARIO FROM TB_TIPO_USUARIO WHERE DS_TIPO_USUARIO = TIPO_USUARIO), (SELECT ID_CIDADE FROM TB_CIDADE WHERE NM_CIDADE = CIDADE_USUARIO));
        INSERT INTO TB_USUARIO_PROFISSIONAL VALUES
        (DEFAULT, NOME_CERTIFICADO, NULL, (SELECT ID_USUARIO FROM TB_USUARIO WHERE DS_EMAIL = EMAIL));
    END IF ;
END //
DELIMITER ;

DELIMITER //

CREATE PROCEDURE LOGIN_USUARIO (EMAIL varchar(255), SENHA VARCHAR(255))
BEGIN
	SELECT US.ID_USUARIO, TP.DS_TIPO_USUARIO FROM TB_USUARIO AS US INNER JOIN TB_TIPO_USUARIO AS TP ON (US.ID_TIPO_USUARIO = TP.ID_TIPO_USUARIO) WHERE US.DS_EMAIL = EMAIL AND DS_SENHA = SENHA;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE APROVAR_PROFISSIONAL (ID INT)
BEGIN
	UPDATE TB_USUARIO SET ID_STATUS_USUARIO = (SELECT ID_STATUS_USUARIO FROM TB_STATUS_USUARIO WHERE DS_STATUS_USUARIO = 'Disponível') WHERE ID_USUARIO = (SELECT ID_USUARIO FROM TB_USUARIO_PROFISSIONAL WHERE ID_USUARIO_PROFISSIONAL = ID);
END //
DELIMITER ;