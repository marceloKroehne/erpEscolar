create table CONTAS_BANCOS(
    BANCO_ID int not null,
    AGENCIA int not null,
    NUMERO_CONTA int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),
    
    constraint PK_CONTAS_BANCOS primary key(BANCO_ID, AGENCIA, NUMERO_CONTA),
    constraint FK_CONTAS_BANCOS_BANCOS foreign key (BANCO_ID) references BANCOS(BANCO_ID),
    constraint FK_CONTAS_BANCOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_CONTAS_BANCOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);