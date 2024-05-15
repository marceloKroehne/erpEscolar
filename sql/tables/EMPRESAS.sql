CREATE TABLE EMPRESAS(
    EMPRESA_ID              int not null auto_increment,
    NOME_RAZAO_SOCIAL       varchar(50) not null,
    EMAIL                   varchar(50) not null unique,
    CPF_CNPJ                varchar(18) not null unique,
    CEP                     varchar(9)  not null,
    LOGRADOURO              varchar(50) not null,
    NUMERO                  varchar(20),
    COMPLEMENTO             varchar(20),
    BAIRRO                  varchar(20) not null,
    CIDADE                  varchar(20) not null,
    UF                      varchar(2)  not null,
    TELEFONE                varchar(20) not null,
    DATA_HORA_ALTERACAO     datetime not null default now(),
    DATA_HORA_CRIACAO       datetime not null default now(),
    
    constraint PK_EMPRESA_ID primary key (EMPRESA_ID)
);