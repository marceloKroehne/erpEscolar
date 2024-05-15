create table BANCOS(
    BANCO_ID int not null auto_increment,
    EMPRESA_ID int not null,
    NUMERO_BANCO int not null unique,
    NOME varchar(255) not null,
    EXIGE_OFX boolean default false,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),
    
    constraint PK_BANCOS primary key(BANCO_ID),
    constraint FK_BANCOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_BANCOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_BANCOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);