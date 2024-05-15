create table USUARIOS(

    USUARIO_ID          int not null auto_increment,
    EMPRESA_ID          int not null,
    ATIVO               boolean not null default true,
    USUARIO_NOME        varchar(50) not null,
    EMAIL               varchar(50) not null UNIQUE,
    CPF                 varchar(18) not null UNIQUE,
    RG                  varchar(20) not null UNIQUE,
    TELEFONE            varchar(20) not null,
    CEP                     varchar(9)  not null,
    LOGRADOURO              varchar(50) not null,
    NUMERO                  varchar(20),
    COMPLEMENTO             varchar(20),
    BAIRRO                  varchar(20) not null,
    CIDADE                  varchar(20) not null,
    UF                      varchar(2)  not null,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null default 1,
    DATA_HORA_CRIACAO datetime not null default now(),

	constraint PK_USUARIOS PRIMARY KEY(USUARIO_ID),
	constraint FK_USUARIOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID)
);
