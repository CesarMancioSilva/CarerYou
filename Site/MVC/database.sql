CREATE DATABASE BD_CARER_YOU CHARACTER SET = 'UTF8' COLLATE = 'UTF8_GENERAL_CI';
USE BD_CARER_YOU;
/*
AS SIGLAS DA UF SÃO UNICAS, PORÉM PODEM HAVER NOMES IGUAIS
*/
CREATE TABLE IF NOT EXISTS TB_UF
(
	SG_UF CHAR(2) NOT NULL,
    NM_UF VARCHAR(50) NOT NULL,
    CONSTRAINT PK_SG_UF
		PRIMARY KEY(SG_UF)
)
ENGINE = InnoDB;
/*
A SIGLA DA UF PODE APARECER VARIAS VEZES DENTRO DA TABELA CIDADE
OU SEJA
UMA UF PODE TER VARIAS CIDADES
*/
CREATE TABLE IF NOT EXISTS TB_CIDADE
(
	ID_CIDADE INT NOT NULL AUTO_INCREMENT,
    NM_CIDADE VARCHAR(50) NOT NULL,
    SG_UF CHAR(2) NOT NULL,
    CONSTRAINT PK_ID_CIDADE
		PRIMARY KEY(ID_CIDADE),
	CONSTRAINT FK_SG_UF
		FOREIGN KEY(SG_UF) 
			REFERENCES TB_UF(SG_UF)
				ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = InnoDB;
/*
O ATRIBUTO ID_CIDADE É UMA FOREIGN KEY DA TB_CIDADE
OU SEJA UMA CIDADE PODE TER VARIAS ENDEREÇOS

OBS: LEMBRANDO QUE PODEM HAVER CIDADE COM NOMES IGUAIS
O QUE IRÁ DIFERENCIAR ELAS SERA A SIGLA DA UF
*/
CREATE TABLE IF NOT EXISTS TB_ENDERECO
(
	ID_ENDERECO INT NOT NULL AUTO_INCREMENT,
    ID_CIDADE INT NOT NULL,
    NM_BAIRRO VARCHAR(50) NOT NULL,
    CD_CEP VARCHAR(30) NOT NULL,
    CD_LOCAL VARCHAR(10) NOT NULL,
    CONSTRAINT FK_ID_CIDADE
		FOREIGN KEY(ID_CIDADE)
			REFERENCES TB_CIDADE(ID_CIDADE)
				ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT PK_ID_ENDERECO
		PRIMARY KEY(ID_ENDERECO)
)
ENGINE = InnoDB;
/*
UM LOCAL SÓ PODE TER UM ENDEREÇO POIS
O ATRIBUTO ID_ENDERCO_LOCAL REFERENCIA A TABELA DE ENDEREÇOS
OU SEJA PELO FATO DELE SER UM ATRIBUTO FAZ COM QUE A RELAÇÃO SEJA DE UM PARA UM
*/
CREATE TABLE IF NOT EXISTS TB_LOCAL
(
	ID_LOCAL INT NOT NULL AUTO_INCREMENT,
    ID_ENDERECO_LOCAL INT NOT NULL,
    NM_IMG_LOCAL VARCHAR(100) NOT NULL,
    NM_LOCAL VARCHAR(50) NOT NULL,
    DESCRICAO_LOCAL VARCHAR(2000) NOT NULL,
    CD_CNPJ VARCHAR(30) NOT NULL,
    CONSTRAINT FK_ID_ENDERECO_LOCAL
		FOREIGN KEY(ID_ENDERECO_LOCAL)
			REFERENCES TB_ENDERECO(ID_ENDERECO)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT UNIQUE_CD_CNPJ
		UNIQUE(CD_CNPJ),
	CONSTRAINT PK_ID_LOCAL
		PRIMARY KEY(ID_LOCAL)
)
ENGINE = InnoDB;
/*
O LOCAL PODE TER VARIOS CONTATOS
DE DIFERENTES TIPOS COMO EMAIL
OU TELEFONE
*/
CREATE TABLE IF NOT EXISTS TB_TIPO_CONTATO
(
	ID_TIPO_CONTATO INT NOT NULL AUTO_INCREMENT,
    DS_TIPO_CONTATO VARCHAR(50) NOT NULL,
    CONSTRAINT UNIQUE_TIPO_CONTATO
		UNIQUE(DS_TIPO_CONTATO),
	CONSTRAINT PK_ID_TIPO_CONTATO
		PRIMARY KEY(ID_TIPO_CONTATO)
)
ENGINE = InnoDB;
INSERT INTO TB_TIPO_CONTATO VALUES
(DEFAULT, 'EMAIL'),
(DEFAULT, 'TELEFONE');
/*
UM TIPO DE CONTATO PODE TER VARIOS CONTATOS

EXEMPLO: O TIPO EMAIL PODE TER VARIOS "FILHOS" EMAIL
*/
CREATE TABLE IF NOT EXISTS TB_CONTATO_LOCAL
(
	ID_CONTATO_LOCAL INT NOT NULL AUTO_INCREMENT,
    ID_LOCAL INT NOT NULL,
    ID_TIPO_CONTATO INT NOT NULL,
    DS_CONTATO_LOCAL VARCHAR(30) NOT NULL,
    CONSTRAINT FK_ID_LOCAL
		FOREIGN KEY(ID_LOCAL)
			REFERENCES TB_LOCAL(ID_LOCAL)
				ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_ID_TIPO_CONTATO
		FOREIGN KEY(ID_TIPO_CONTATO)
			REFERENCES TB_TIPO_CONTATO(ID_TIPO_CONTATO)
				ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT PK_ID_CONTATO_LOCAL
		PRIMARY KEY(ID_CONTATO_LOCAL)
)
ENGINE = InnoDB;
/*
A TABELA PERGUNTAS NÃO POSSUI DEPENDENCIAS COM OUTRAS TABELAS POIS QUALQUER
PESSOA PODE EFETUAR UMA PERGUNTAR SEM MESMO PRECISAR DE CADASTRO
*/
CREATE TABLE IF NOT EXISTS TB_PERGUNTAS
(
	ID_PERGUNTA INT NOT NULL AUTO_INCREMENT,
    TITULO_PERGUNTA VARCHAR(1000) DEFAULT 'PERGUNTA SEM TITULO',
    DS_PERGUNTA VARCHAR(2000) NOT NULL,
    CONSTRAINT PK_ID_PERGUNTA
		PRIMARY KEY(ID_PERGUNTA)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS TB_TIPO_USUARIO
(
	ID_TIPO_USUARIO INT NOT NULL AUTO_INCREMENT,
    DS_TIPO_USUARIO VARCHAR(50) NOT NULL,
    CONSTRAINT UNIQUE_TIPO_USUARIO
		UNIQUE(DS_TIPO_USUARIO),
	CONSTRAINT PK_ID_TIPO_USUARIO
		PRIMARY KEY(ID_TIPO_USUARIO)
)
ENGINE = InnoDB;
INSERT INTO TB_TIPO_USUARIO VALUES
(DEFAULT,'ADMIN'),
(DEFAULT,'CLIENTE'),
(DEFAULT,'PROFISSIONAL');
/*
PARA EXISTIR O USUARIO PRIMIERO PRECISAMOS DO TIPO DELE

OU SEJA UM TIPO DE USUARIO PODE TER VARIOS USUARIOS
*/

/*
STATUS DO USUARIO:

CASO O USUARIO TENTE DELETAR A CONTA O SEU STATUS SERA MUDADO PRIMEIRAMENTE
POIS PODE SER NECESSÁRIO QUE HAJA INVESTIGAÇÃO NA CONTA DAQUELE QUE TENTOU EXCLUI-LA

OBS: ISSO É FEITO POIS APÓS O USUARIO DELETAR SUA CONTA TODOS OS SEUS DADOS DO SISETMA SÃO EXCLUIDOS
*/
CREATE TABLE IF NOT EXISTS TB_USUARIO
(
	ID_USUARIO INT NOT NULL AUTO_INCREMENT,
    NM_USUARIO VARCHAR(60) NOT NULL,
    DS_EMAIL VARCHAR(100) NOT NULL,
    DS_SENHA VARCHAR(255) NOT NULL,
    NM_FOTO_PERFIL VARCHAR(255) NOT NULL,
    CD_RG VARCHAR(30) NOT NULL,
    ID_TIPO_USUARIO INT NOT NULL,
    CONSTRAINT UNIQUE_EMAIL
		UNIQUE(DS_EMAIL),
	CONSTRAINT FK_ID_TIPO_USUARIO
		FOREIGN KEY(ID_TIPO_USUARIO)
			REFERENCES TB_TIPO_USUARIO(ID_TIPO_USUARIO)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PK_ID_USUARIO
		PRIMARY KEY(ID_USUARIO)
)
ENGINE = InnoDB;
/*
O TIPO DE CONTATO PODE TER VARIOS

ASSIM COMO UM USUARIO PODE TER DIVERSOS CONTATOS
*/
CREATE TABLE IF NOT EXISTS TB_CONTATO_USUARIO
(
	ID_CONTATO_USUARIO INT NOT NULL AUTO_INCREMENT,
    ID_USUARIO INT NOT NULL,
    ID_TIPO_CONTATO INT NOT NULL,
    DS_CONTATO_USUARIO VARCHAR(30) NOT NULL,
    FOREIGN KEY(ID_USUARIO) REFERENCES TB_USUARIO(ID_USUARIO) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(ID_TIPO_CONTATO) REFERENCES TB_TIPO_CONTATO(ID_TIPO_CONTATO) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(ID_CONTATO_USUARIO)
)
ENGINE = InnoDB;
/*
O ID DE USUARIO É UNIQUE DENTRO DA TABELA USUARIO_PROFISSIONAL

OU SEJA ANTES DE SE TORNAR UM USUARIO PROFISSIONAL ELE PRECISA SER UM USUARIO PADRÃO

A RELAÇÃO É DE UM PARA UM (UM USUARIO PODE SE TORNAR UM USUARIO PROFISSIONAL)
*/
CREATE TABLE IF NOT EXISTS TB_USUARIO_PROFISSIONAL
(
	ID_USUARIO_PROFISSIONAL INT NOT NULL AUTO_INCREMENT,
    ID_USUARIO INT NOT NULL,
    CD_CPF_CNPJ VARCHAR(30) NOT NULL,
    NM_FOTO_COM_RG VARCHAR(255) NOT NULL,
    DS_PERFIL_PROFISSIONAL VARCHAR(3000) DEFAULT 'Profissional do sistema Carer You',
    CONSTRAINT UNIQUE_ID_USUARIO
		UNIQUE(ID_USUARIO),
	CONSTRAINT FK_ID_USUARIO
		FOREIGN KEY(ID_USUARIO)
			REFERENCES TB_USUARIO(ID_USUARIO),
	CONSTRAINT PK_ID_USUARIO_PROFISSIONAL
		PRIMARY KEY(ID_USUARIO_PROFISSIONAL)
)
ENGINE = InnoDB;
/*
O USUARIO PROFISSIONAL PODERA ENVIAR VARIOS ARQUIVOS NO SISTEMA
COMO: CURRICULOS, CERTIFICADOS, ETC

CREATE TABLE IF NOT EXISTS TB_TIPO_ARQUIVO_PROFISSIONAL
(
	ID_TIPO_ARQUIVO INT NOT NULL AUTO_INCREMENT,
    DS_TIPO_ARQUIVO VARCHAR(60) NOT NULL,
    CONSTRAINT UNIQUE_TIPO_ARQUIVO
		UNIQUE(DS_TIPO_ARQUIVO),
	CONSTRAINT PK_ID_TIPO_ARQUIVO
		PRIMARY KEY(ID_TIPO_ARQUIVO)
)
ENGINE = InnoDB;
INSERT INTO TB_TIPO_ARQUIVO_PROFISSIONAL VALUES
(DEFAULT,'CURRICULO'),
(DEFAULT,'CERTIFICADO');

UM TIPO DE ARQUIVO PODE TER VARIOS ARQUIVOS

CREATE TABLE IF NOT EXISTS TB_ARQUIVO_PROFISSIONAL
(
	ID_ARQUIVO_PROFISSIONAL INT NOT NULL AUTO_INCREMENT,
    ID_TIPO_ARQUIVO INT NOT NULL,
    ID_USUARIO_PROFISSIONAL INT NOT NULL,
    NM_ARQUIVO_PROFISSIONAL VARCHAR(255) NOT NULL,
    CONSTRAINT FK_ID_TIPO_ARQUIVO
		FOREIGN KEY(ID_TIPO_ARQUIVO)
			REFERENCES TB_TIPO_ARQUIVO_PROFISSIONAL(ID_TIPO_ARQUIVO)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_ID_USUARIO_PROFISSIONAL
		FOREIGN KEY(ID_USUARIO_PROFISSIONAL)
			REFERENCES TB_USUARIO_PROFISSIONAL(ID_USUARIO_PROFISSIONAL)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PK_ID_ARQUIVO_PROFISSIONAL
		PRIMARY KEY(ID_ARQUIVO_PROFISSIONAL)
				
)
ENGINE = InnoDB;
*/
/*
A TABELA USUARIO PRECISA DE DOIS IDS DE USUARIO

UM USUARIO PODE REQUISIATAR VARIOS PEDIDOS
UM PROFISSIONAL PODE FAZER VARIOS PEDIDOS
*/
CREATE TABLE IF NOT EXISTS TB_SERVICO
(
	ID_SERVICO INT NOT NULL AUTO_INCREMENT,
    ID_USUARIO INT NOT NULL,
    ID_USUARIO_PROFISSIONAL INT NOT NULL,
    DS_SERVICO VARCHAR(1000) NOT NULL,
    DT_INICIO_SERVICO DATE NOT NULL,
	DT_FINAL_SERVICO DATE NOT NULL,
    DT_REQUISICAO_PEDIDO DATE NOT NULL DEFAULT NOW(),
    CONSTRAINT FK_USUARIO_CLIENTE
		FOREIGN KEY(ID_USUARIO)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FK_USUARIO_PROFISSIONAL
		FOREIGN KEY(ID_USUARIO_PROFISSIONAL)
			REFERENCES TB_USUARIO_PROFISSIONAL(ID_USUARIO_PROFISSIONAL)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PK_ID_SERVICO
		PRIMARY KEY(ID_SERVICO)
)
ENGINE = InnoDB;
/*
UM USUARIO PODE FAZER VARIAS DENUNCIAS

ASSIM COMO UM USUARIO PODE RECEBER VARIAS DENUNCIAS
*/
CREATE TABLE IF NOT EXISTS TB_DENUNCIA
(
	ID_DENUNCIA INT NOT NULL AUTO_INCREMENT,
    ID_REMETENTE INT NOT NULL,
    ID_DESTINATARIO INT NOT NULL,
    DS_DENUNCIA VARCHAR(2000) NOT NULL,
    CONSTRAINT FK_ID_REMETENTE
		FOREIGN KEY(ID_REMETENTE)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_ID_DESTINATARIO
		FOREIGN KEY(ID_DESTINATARIO)
			REFERENCES TB_USUARIO(ID_USUARIO)
				ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PK_ID_DENUNCIA
		PRIMARY KEY(ID_DENUNCIA)
);
/**/

CREATE TABLE IF NOT EXISTS TB_MENSAGEM
(
	ID_MENSAGEM INT NOT NULL AUTO_INCREMENT,
    ID_REMETENTE INT NOT NULL,
    ID_DESTINATARIO INT NOT NULL,
    DS_MENSAGEM VARCHAR(500) NOT NULL,
    PRIMARY KEY(ID_MENSAGEM),
    FOREIGN KEY(ID_REMETENTE) REFERENCES TB_USUARIO(ID_USUARIO) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(ID_DESTINATARIO) REFERENCES TB_USUARIO(ID_USUARIO) ON DELETE CASCADE ON UPDATE CASCADE
);

SHOW TABLES;


