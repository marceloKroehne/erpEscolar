create table DOCUMENTOS(
    DOCUMENTO_ID int not null AUTO_INCREMENT,
    CONTRATO_ID int not null,
    DESCRICAO varchar(255) not null,
    DOCUMENTO longblob not null,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_DOCUMENTOS primary key(DOCUMENTO_ID),
    constraint FK_DOCUMENTOS_CONTRATOS foreign key(CONTRATO_ID) references CONTRATOS(CONTRATO_ID),
    constraint FK_DOCUMENTOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_DOCUMENTOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);