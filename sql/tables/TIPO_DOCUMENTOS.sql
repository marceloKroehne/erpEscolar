create table TIPO_DOCUMENTOS(
    TIPO_DOCUMENTO_ID int not null AUTO_INCREMENT,
    EMPRESA_ID int not null,
    NOME varchar(255) not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_TIPO_DOCUMENTOS primary key(TIPO_DOCUMENTO_ID),
    constraint FK_TIPO_DOCUMENTOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_TIPO_DOCUMENTOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_TIPO_DOCUMENTOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);