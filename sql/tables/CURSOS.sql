create table CURSOS(
    CURSO_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    VALOR DECIMAL(10,2) not null,
    COORDENADOR_ID int not null,
    MATRIZ_CURRICULAR_ID int not null,
    TIPO_CURSO_ID int not null,
    NUMERO_AULAS int not null,
    CARGA_HORARIA int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_CURSOS primary key(CURSO_ID),
    constraint FK_CURSOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_CURSOS_MATRIZES_CURRICULARES foreign key (MATRIZ_CURRICULAR_ID) references MATRIZES_CURRICULARES(MATRIZ_CURRICULAR_ID),
    constraint FK_CURSOS_TIPO_CURSOS foreign key (TIPO_CURSO_ID) references TIPO_CURSOS(TIPO_CURSO_ID),
    constraint FK_CURSOS_FUNCIONARIOS foreign key (COORDENADOR_ID) references FUNCIONARIOS(FUNCIONARIO_ID),
    constraint FK_CURSOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_CURSOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);