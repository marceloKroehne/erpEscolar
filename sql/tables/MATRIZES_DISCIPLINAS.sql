create table MATRIZES_DISCIPLINAS(
    MATRIZ_DISCIPLINA_ID int not null AUTO_INCREMENT,
    MATRIZ_CURRICULAR_ID int not null,
    DISCIPLINA_ID int not null,

    constraint PK_MATRIZES_DISCIPLINAS primary key(MATRIZ_DISCIPLINA_ID),
    constraint FK_MATRIZES_DISCIPLINAS_MATRIZES foreign key (MATRIZ_CURRICULAR_ID) references MATRIZES_CURRICULARES(MATRIZ_CURRICULAR_ID),
    constraint FK_MATRIZES_DISCIPLINAS_DISCIPLINAS foreign key (DISCIPLINA_ID) references DISCIPLINAS(DISCIPLINA_ID)
);