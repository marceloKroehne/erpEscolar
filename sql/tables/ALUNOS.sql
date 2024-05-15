create table ALUNOS(
    ALUNO_ID int not null AUTO_INCREMENT,
    USUARIO_ID int not null,
    MATRICULA varchar(255) not null,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_ALUNOS primary key(ALUNO_ID),
    constraint FK_ALUNOS_USUARIOS foreign key (USUARIO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_ALUNOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_ALUNOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);