create table TIPO_PAGAMENTOS(
    TIPO_PAGAMENTO_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    VALOR_SALARIO DECIMAL(10,2),
    VALOR_HORA DECIMAL(10,2),
    PERCENTUAL_INSS DECIMAL(4,2),
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_TIPO_TIPO_PAGAMENTOS primary key(TIPO_PAGAMENTO_ID),
    constraint FK_TIPO_TIPO_PAGAMENTOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_TIPO_TIPO_PAGAMENTOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_TIPO_TIPO_PAGAMENTOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);