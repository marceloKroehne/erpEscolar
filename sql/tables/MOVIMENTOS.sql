create table MOVIMENTOS(
    MOVIMENTO_ID int not null AUTO_INCREMENT,
    EMPRESA_ID int not null,
    NUMERO_MOVIMENTO varchar(100),
    SUBCONTA_ENTRADA_ID int not null,
    SUBCONTA_SAIDA_ID int not null,
    VALOR decimal (10,2) not null,
    DATA_LANCAMENTO date not null, 
    HISTORICO varchar(255) not null,
    OBSERVACAO varchar(100),
    NUMERO_DOCUMENTO varchar(100),
    TIPO_DOCUMENTO_ID int,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_MOVIMENTOS primary key(MOVIMENTO_ID),
    constraint FK_MOVIMENTOS_SUBCONTAS_ENTRADA foreign key (SUBCONTA_ENTRADA_ID) references SUBCONTAS(SUBCONTA_ID),
    constraint FK_MOVIMENTOS_SUBCONTAS_SAIDA foreign key (SUBCONTA_SAIDA_ID) references SUBCONTAS(SUBCONTA_ID)
    constraint FK_MOVIMENTOS_TIPO_DOCUMENTOS foreign key (TIPO_DOCUMENTO_ID) references TIPO_DOCUMENTOS(TIPO_DOCUMENTO_ID),
    constraint FK_MOVIMENTOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_MOVIMENTOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_MOVIMENTOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);