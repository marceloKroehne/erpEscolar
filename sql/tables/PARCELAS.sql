create table PARCELAS(
    PARCELA_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    VALOR DECIMAL(10,2) not null,
    STATUS_PAGAMENTO tinyint check(TIPO IN(0,1,2)) default 0, /*0 - NÃO PAGO, 1 - PENDENTE, 2 - PAGO*/
    CONTRATO_ID int not null,
    EMPRESA_ID int not null,
    MOVIMENTO_ID int,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_PARCELAS primary key(PARCELA_ID),
    constraint FK_PARCELAS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_PARCELAS_CONTRATOS foreign key (CONTRATO_ID) references CONTRATOS(CONTRATO_ID),
    constraint FK_PARCELAS_MOVIMENTOS foreign key (MOVIMENTO_ID) references MOVIMENTOS(MOVIMENTO_ID),
    constraint FK_PARCELAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_PARCELAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);