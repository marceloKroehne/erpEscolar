create table CARGOS(
    CARGO_ID int not null auto_increment,
    EMPRESA_ID int not null,
    PERMISSAO_ID tinyint not null default 0 check(TIPO in(0,1,2,3)),
    PROFESSOR boolean default false,
    ATENDENTE boolean default false,
    NOME varchar(255) not null,
    ADMIN boolean default false,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),
    
    constraint PK_CARGOS primary key(CARGO_ID),
    constraint FK_CARGOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_CARGOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_CARGOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);