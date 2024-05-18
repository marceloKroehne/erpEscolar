DELIMITER $$
create procedure INSER_NOVA_EMP(
   in xNOME_RAZAO_SOCIAL       varchar(50),
   in xEMAIL                   varchar(50),
   in xCPF_CNPJ                varchar(18),
   in xCEP                     varchar(9),
   in xLOGRADOURO              varchar(50),
   in xNUMERO                  varchar(20),
   in xCOMPLEMENTO             varchar(20),
   in xBAIRRO                  varchar(20),
   in xCIDADE                  varchar(20),
   in xUF                      varchar(2),
   in xTELEFONE                varchar(20),
   in xUSUARIO_NOME            varchar(50),
   in xUSUARIO_EMAIL           varchar(50),
   in xUSUARIO_CPF             varchar(18),
   in xUSUARIO_RG              varchar(20),
   in xUSUARIO_CEP             varchar(9),
   in xUSUARIO_LOGRADOURO      varchar(50),
   in xUSUARIO_NUMERO          varchar(20),
   in xUSUARIO_COMPLEMENTO     varchar(20),
   in xUSUARIO_BAIRRO          varchar(20),
   in xUSUARIO_CIDADE          varchar(20),
   in xUSUARIO_UF              varchar(2),
   in xUSUARIO_TELEFONE        varchar(20),
   in xSENHA                   varchar(255)
  
)

begin

  declare xEMPRESA_ID int;
  declare xUSUARIO_ID int;
  declare xCARGO_ID int;
    
insert into EMPRESAS(
  NOME_RAZAO_SOCIAL,
  EMAIL,
  CPF_CNPJ,
  CEP,
  LOGRADOURO,
  NUMERO,
  COMPLEMENTO,
  BAIRRO,
  CIDADE,
  UF,
  TELEFONE
) values (
  xNOME_RAZAO_SOCIAL,
  xEMAIL,
  xCPF_CNPJ,
  xCEP,
  xLOGRADOURO,
  xNUMERO,
  xCOMPLEMENTO,
  xBAIRRO,
  xCIDADE,
  xUF,
  xTELEFONE
);


set xEMPRESA_ID = last_insert_id();

insert into USUARIOS(
  EMPRESA_ID,
  USUARIO_NOME,
  EMAIL,
  RG,
  CPF,
  TELEFONE,
  CEP,
  LOGRADOURO,
  NUMERO,
  COMPLEMENTO,
  BAIRRO,
  CIDADE,
  UF,
  USUARIO_ALTERACAO_ID
)
values(
  xEMPRESA_ID,
  xUSUARIO_NOME,
  xUSUARIO_EMAIL,
  xUSUARIO_RG,
  xUSUARIO_CPF,
  xUSUARIO_TELEFONE,
  xUSUARIO_CEP,
  xUSUARIO_LOGRADOURO,
  xUSUARIO_NUMERO,
  xUSUARIO_COMPLEMENTO,
  xUSUARIO_BAIRRO,
  xUSUARIO_CIDADE,
  xUSUARIO_UF,
  1
);


set xUSUARIO_ID = last_insert_id();

insert into CARGOS (
  EMPRESA_ID,
  PERMISSAO_ID,
  NOME,
  ADMIN,
  PROFESSOR,
  ATENDENTE,
  USUARIO_ALTERACAO_ID,
  USUARIO_CRIACAO_ID
) values (
  xEMPRESA_ID,
  3,
  'Admin',
  true,
  true,
  true,
  xUSUARIO_ID,
  xUSUARIO_ID
);
  
set xCARGO_ID = last_insert_id();

insert into FUNCIONARIOS(
  USUARIO_ID,
  CARGO_ID,
  SENHA,
  USUARIO_ALTERACAO_ID,
  USUARIO_CRIACAO_ID
)
values(
  xUSUARIO_ID,
  xCARGO_ID,
  xSENHA,
  xUSUARIO_ID,
  xUSUARIO_ID
);


end;
$$
DELIMITER ;