create table PLANOS_CURSOS(
    PLANO_CURSO_ID int not null AUTO_INCREMENT,
    CURSO_ID int not null,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    NUMERO_PARCELAS INT(3) not null,
    NECESSITA_AUT_SUP boolean default true,
    VALOR_PARCELA decimal(10,2),
    VALOR_TOTAL decimal(10,2),
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_PLANOS_CURSOS primary key(PLANO_CURSO_ID),
    constraint FK_PLANOS_CURSOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_PLANOS_CURSOS_CURSOS foreign key (CURSO_ID) references CURSOS(CURSO_ID),
    constraint FK_PLANOS_CURSOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_PLANOS_CURSOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);