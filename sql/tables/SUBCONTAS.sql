create table SUBCONTAS(
    SUBCONTA_ID int not null AUTO_INCREMENT,
    GRUPO_CONTA_ID int not null, 
    BANCO_ID int,
    AGENCIA int,
    NUMERO_CONTA int,
    TIPO tinyint not null check(TIP IN (0,1)),
    NOME varchar(255) not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_SUBCONTAS primary key(SUBCONTA_ID),
    constraint FK_SUBCONTAS_GRUPOS_CONTAS foreign key(GRUPO_CONTA_ID) references GRUPOS_CONTAS(GRUPO_CONTA_ID),
    constraint FK_SUBCONTAS_CONTAS_BANCOS foreign key(BANCO_ID, AGENCIA, NUMERO_CONTA) references CONTAS_BANCOS(BANCO_ID, AGENCIA, NUMERO_CONTA),
    constraint FK_SUBCONTAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_SUBCONTAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);