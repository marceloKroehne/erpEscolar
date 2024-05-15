create table BOLSAS_CURSOS(
    BOLSA_CURSO_ID int not null AUTO_INCREMENT,
    BOLSA_ID int not null,
    CURSO_ID int not null,

    constraint PK_BOLSAS_CURSOS primary key(BOLSA_CURSO_ID),
    constraint FK_BOLSAS_bolsas_cursos foreign key (BOLSA_ID) references BOLSAS(BOLSA_ID),
    constraint FK_BOLSAS_CURSOS_CURSOS foreign key (CURSO_ID) references CURSOS(CURSO_ID)
);