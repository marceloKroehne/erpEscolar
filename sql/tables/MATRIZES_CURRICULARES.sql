create table MATRIZES_CURRICULARES(
    MATRIZ_CURRICULAR_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_MATRIZ_CURRICULAR primary key(MATRIZ_CURRICULAR_ID),
    constraint FK_MATRIZ_CURRICULAR_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_MATRIZES_CURRICULARES_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_MATRIZES_CURRICULARES_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);