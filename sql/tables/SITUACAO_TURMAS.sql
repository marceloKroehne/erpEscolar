create table SITUACAO_TURMAS(
    SITUACAO_TURMA_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_SITUACAO_TURMAS primary key(SITUACAO_TURMA_ID),
    constraint FK_SITUACAO_TURMAS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_SITUACAO_TURMAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_SITUACAO_TURMAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);