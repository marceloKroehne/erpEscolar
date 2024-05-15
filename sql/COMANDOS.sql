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

create table USUARIOS(

    USUARIO_ID          int not null auto_increment,
    EMPRESA_ID          int not null,
    ATIVO               boolean not null default true,
    USUARIO_NOME        varchar(50) not null,
    EMAIL               varchar(50) not null UNIQUE,
    CPF                 varchar(18) not null UNIQUE,
    RG                  varchar(20) not null UNIQUE,
    TELEFONE            varchar(20) not null,
    CEP                     varchar(9)  not null,
    LOGRADOURO              varchar(50) not null,
    NUMERO                  varchar(20),
    COMPLEMENTO             varchar(20),
    BAIRRO                  varchar(20) not null,
    CIDADE                  varchar(20) not null,
    UF                      varchar(2)  not null,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null default 1,
    DATA_HORA_CRIACAO datetime not null default now(),

	constraint PK_USUARIOS PRIMARY KEY(USUARIO_ID),
	constraint FK_USUARIOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID)
);

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

create table BANCOS(
    BANCO_ID int not null auto_increment,
    EMPRESA_ID int not null,
    NUMERO_BANCO int not null unique,
    NOME varchar(255) not null,
    EXIGE_OFX boolean default false,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),
    
    constraint PK_BANCOS primary key(BANCO_ID),
    constraint FK_BANCOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_BANCOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_BANCOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);

create table CONTAS_BANCOS(
    BANCO_ID int not null,
    AGENCIA int not null,
    NUMERO_CONTA int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),
    
    constraint PK_CONTAS_BANCOS primary key(BANCO_ID, AGENCIA, NUMERO_CONTA),
    constraint FK_CONTAS_BANCOS_BANCOS foreign key (BANCO_ID) references BANCOS(BANCO_ID),
    constraint FK_CONTAS_BANCOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_CONTAS_BANCOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table TIPO_DOCUMENTOS(
    TIPO_DOCUMENTO_ID int not null AUTO_INCREMENT,
    EMPRESA_ID int not null,
    NOME varchar(255) not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_TIPO_DOCUMENTOS primary key(TIPO_DOCUMENTO_ID),
    constraint FK_TIPO_DOCUMENTOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_TIPO_DOCUMENTOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_TIPO_DOCUMENTOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table GRUPOS_CONTAS(
    GRUPO_CONTA_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    USUARIO_ALTERACAO_ID int not null,
    ATIVO boolean default true,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_GRUPOS_CONTAS primary key(GRUPO_CONTA_ID),
    constraint FK_GRUPOS_CONTAS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_GRUPOS_CONTAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_GRUPOS_CONTAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table SUBCONTAS(
    SUBCONTA_ID int not null AUTO_INCREMENT,
    GRUPO_CONTA_ID int not null, 
    TIPO tinyint not null check(TIP IN (0,1)),
    NOME varchar(255) not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_SUBCONTAS primary key(SUBCONTA_ID),
    constraint FK_SUBCONTAS_GRUPOS_CONTAS foreign key(GRUPO_CONTA_ID) references GRUPOS_CONTAS(GRUPO_CONTA_ID),
    constraint FK_SUBCONTAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_SUBCONTAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
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
create table FUNCIONARIOS(
    FUNCIONARIO_ID int not null AUTO_INCREMENT,
    USUARIO_ID int not null,
    CARGO_ID int not null,
    BANCO_ID int,
    AGENCIA int,
    NUMERO_CONTA int,
    PIX varchar(255),
    TIPO_PIX_ID tinyint not null default 0 check(TIPO in(0,1,2,3)),
    TIPO_PAGAMENTO_ID int,
    USUARIO_ALTERACAO_ID int not null,
    SENHA varchar(255) not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_FUNCIONARIOS primary key(FUNCIONARIO_ID),
    constraint FK_FUNCIONARIOS_CARGOS foreign key (CARGO_ID) references CARGOS(CARGO_ID),
    constraint FK_FUNCIONARIOS_USUARIOS foreign key (USUARIO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_FUNCIONARIOS_BANCOS foreign key (BANCO_ID) references BANCOS(BANCO_ID),
    constraint FK_FUNCIONARIOS_TIPO_PAGAMENTOS foreign key (TIPO_PAGAMENTO_ID) references TIPO_PAGAMENTOS(TIPO_PAGAMENTO_ID),
    constraint FK_FUNCIONARIOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_FUNCIONARIOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table DISCIPLINAS(
    DISCIPLINA_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_DISCIPLINAS primary key(DISCIPLINA_ID),
    constraint FK_DISCIPLINAS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_DISCIPLINAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_DISCIPLINAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table MATRIZES_CURRICULARES(
    MATRIZ_CURRICULAR_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_MATRIZ_CURRICULAR primary key(MATRIZ_CURRICULAR_ID),
    constraint FK_MATRIZ_CURRICULAR_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_MATRIZES_CURRICULARES_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_MATRIZES_CURRICULARES_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table MATRIZES_DISCIPLINAS(
    MATRIZ_DISCIPLINA_ID int not null AUTO_INCREMENT,
    MATRIZ_CURRICULAR_ID int not null,
    DISCIPLINA_ID int not null,

    constraint PK_MATRIZES_DISCIPLINAS primary key(MATRIZ_DISCIPLINA_ID),
    constraint FK_MATRIZES_DISCIPLINAS_MATRIZES foreign key (MATRIZ_CURRICULAR_ID) references MATRIZES_CURRICULARES(MATRIZ_CURRICULAR_ID),
    constraint FK_MATRIZES_DISCIPLINAS_DISCIPLINAS foreign key (DISCIPLINA_ID) references DISCIPLINAS(DISCIPLINA_ID)
);
create table MODALIDADES(
    MODALIDADE_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_MODALIDADES primary key(MODALIDADE_ID),
    constraint FK_MODALIDADES_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_MODALIDADES_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_MODALIDADES_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table TIPO_CURSOS(
    TIPO_CURSO_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_TIPO_CURSOS primary key(TIPO_CURSO_ID),
    constraint FK_TIPO_CURSOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_TIPO_CURSOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_TIPO_CURSOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table TURNOS(
    TURNO_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_TURNOS primary key(TURNO_ID),
    constraint FK_TURNOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_TURNOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_TURNOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table TIPO_CONTRATOS(
    TIPO_CONTRATO_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_TIPO_CONTRATOS primary key(TIPO_CONTRATO_ID),
    constraint FK_TIPO_CONTRATOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_TIPO_CONTRATOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_TIPO_CONTRATOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table SITUACAO_TURMAS(
    SITUACAO_TURMA_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_SITUACAO_TURMAS primary key(SITUACAO_TURMA_ID),
    constraint FK_SITUACAO_TURMAS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_SITUACAO_TURMAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_SITUACAO_TURMAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table SITUACAO_CONTRATOS(
    SITUACAO_CONTRATO_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_SITUACAO_CONTRATOS primary key(SITUACAO_CONTRATO_ID),
    constraint FK_SITUACAO_CONTRATOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_SITUACAO_CONTRATOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_SITUACAO_CONTRATOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table SALAS(
    SALA_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_SALAS primary key(SALA_ID),
    constraint FK_SALAS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_SALAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_SALAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table MOVIMENTOS(
    MOVIMENTO_ID int not null AUTO_INCREMENT,
    EMPRESA_ID int not null,
    NUMERO_MOVIMENTO varchar(100),
    BANCO_ID int not null,
    AGENCIA int not null,
    NUMERO_CONTA int not null,
    SUBCONTA_ID int not null,
    VALOR decimal (10,2) not null,
    DATA_LANCAMENTO date not null, 
    HISTORICO varchar(255) not null,
    OBSERVACAO varchar(100),
    NUMERO_DOCUMENTO varchar(100),
    TIPO_DOCUMENTO_ID int,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_MOVIMENTOS primary key(MOVIMENTO_ID),
	constraint FK_MOVIMENTOS_CONTAS_BANCOS foreign key (BANCO_ID, AGENCIA, NUMERO_CONTA) references CONTAS_BANCOS(BANCO_ID, AGENCIA, NUMERO_CONTA),
    constraint FK_MOVIMENTOS_SUBCONTAS foreign key (SUBCONTA_ID) references SUBCONTAS(SUBCONTA_ID),
    constraint FK_MOVIMENTOS_TIPO_DOCUMENTOS foreign key (TIPO_DOCUMENTO_ID) references TIPO_DOCUMENTOS(TIPO_DOCUMENTO_ID),
    constraint FK_MOVIMENTOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_MOVIMENTOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_MOVIMENTOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
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
create table BOLSAS(
    BOLSA_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    PERCENTUAL_DESCONTO INT(3) not null,
    NECESSITA_AUT_SUP boolean default true,
    ATIVO boolean default true,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_BOLSAS primary key(BOLSA_ID),
    constraint FK_BOLSAS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_BOLSAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_BOLSAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table BOLSAS_CURSOS(
    BOLSA_CURSO_ID int not null AUTO_INCREMENT,
    BOLSA_ID int not null,
    CURSO_ID int not null,

    constraint PK_BOLSAS_CURSOS primary key(BOLSA_CURSO_ID),
    constraint FK_BOLSAS_bolsas_cursos foreign key (BOLSA_ID) references BOLSAS(BOLSA_ID),
    constraint FK_BOLSAS_CURSOS_CURSOS foreign key (CURSO_ID) references CURSOS(CURSO_ID)
);
create table TURMAS(
    TURMA_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    EMPRESA_ID int not null,
    MODALIDADE_ID int not null,
    ATIVO boolean default true,
    DATA_INICIO date not null,
    DATA_FIM date not null,
    CURSO_ID int not null,
    SITUACAO_TURMA_ID int not null,
    PROFESSOR_ID int not null,
    TURNO_ID int not null,
    SALA_ID int not null,
    MAX_ALUNOS int not null,
    MIN_ALUNOS int not null,
    META_ALUNOS int not null,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_TURMAS primary key(TURMA_ID),
    constraint FK_TURMAS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_TURMAS_FUNCIONARIOS foreign key (PROFESSOR_ID) references FUNCIONARIOS(FUNCIONARIO_ID),
    constraint FK_TURMAS_CURSOS foreign key (CURSO_ID) references CURSOS(CURSO_ID),
    constraint FK_TURMAS_TURNOS foreign key (TURNO_ID) references TURNOS(TURNO_ID),
    constraint FK_TURMAS_SALAS foreign key (SALA_ID) references SALAS(SALA_ID),
    constraint FK_TURMAS_SITUACAO_TURMAS foreign key (SITUACAO_TURMA_ID) references SITUACAO_TURMAS(SITUACAO_TURMA_ID),
    constraint FK_TURMAS_MODALIDADES foreign key (MODALIDADE_ID) references MODALIDADES(MODALIDADE_ID),
    constraint FK_TURMAS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_TURMAS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table CONTRATOS(
    CONTRATO_ID int not null AUTO_INCREMENT,
    TURMA_ID int not null,
    ALUNO_ID int not null,
    VENDEDOR_ID int not null,
    EMPRESA_ID int not null,
    VALOR DECIMAL(10,2) not null,
    DESONTO DECIMAL(10,2),
    SITUACAO_CONTRATO_ID int not null,
    TIPO_CONTRATO_ID int not null,
    DATA_INICIO date not null,
    DATA_FIM date not null,
    OBSERVACAO varchar(255),
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_CONTRATOS primary key(CONTRATO_ID),
    constraint FK_CONTRATOS_EMPRESAS foreign key (EMPRESA_ID) references EMPRESAS(EMPRESA_ID),
    constraint FK_CONTRATOS_TURMAS foreign key (TURMA_ID) references TURMAS(TURMA_ID),
    constraint FK_CONTRATOS_ALUNOS foreign key (VENDEDOR_ID) references FUNCIONARIOS(FUNCIONARIO_ID),
    constraint FK_CONTRATOS_FUNCIONARIOS foreign key (ALUNO_ID) references ALUNOS(ALUNO_ID),
    constraint FK_CONTRATOS_SITUACAO_CONTRATOS foreign key (SITUACAO_CONTRATO_ID) references SITUACAO_CONTRATOS(SITUACAO_CONTRATO_ID),
    constraint FK_CONTRATOS_TIPO_CONTRATOS foreign key (TIPO_CONTRATO_ID) references TIPO_CONTRATOS(TIPO_CONTRATO_ID),
    constraint FK_CONTRATOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_CONTRATOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
create table PARCELAS(
    PARCELA_ID int not null AUTO_INCREMENT,
    NOME varchar(255) not null,
    VALOR DECIMAL(10,2) not null,
    STATUS_PAGAMENTO tinyint check(TIPO IN(0,1,2)) default 0, /*0 - NÃO PAGO, 1 - PENDENTE, 2 - PAGO*/
    CONTRATO_ID int not null,
    EMPRESA_ID int not null,
    MOVIMENTO_ID int not null,
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
create table DOCUMENTOS(
    DOCUMENTO_ID int not null AUTO_INCREMENT,
    CONTRATO_ID int not null,
    DESCRICAO varchar(255) not null,
    DOCUMENTO longblob not null,
    USUARIO_ALTERACAO_ID int not null,
    DATA_HORA_ALTERACAO datetime not null default now(),
    USUARIO_CRIACAO_ID int not null,
    DATA_HORA_CRIACAO datetime not null default now(),

    constraint PK_DOCUMENTOS primary key(DOCUMENTO_ID),
    constraint FK_DOCUMENTOS_CONTRATOS foreign key(CONTRATO_ID) references CONTRATOS(CONTRATO_ID),
    constraint FK_DOCUMENTOS_USUARIOS_ALT foreign key (USUARIO_ALTERACAO_ID) references USUARIOS(USUARIO_ID),
    constraint FK_DOCUMENTOS_USUARIOS_CRI foreign key (USUARIO_CRIACAO_ID) references USUARIOS(USUARIO_ID)
);
DELIMITER $$
create trigger CHEC_INSER_CARG_USU_I_BR
before insert on USUARIOS
for each row
begin
    if NEW.USUARIO_STATUS not in (0, 1,2,3) then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O Status deve conter apenas 0, 1, 2, 3.';
    end if;
end$$

DELIMITER ;

DELIMITER $$
create trigger CHEC_UPDT_CARG_USU_U_BR
before update on USUARIOS
for each row
begin
    if NEW.USUARIO_STATUS not in (0, 1,2,3) then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O Status deve conter apenas 0, 1, 2, 3.';
    end if;
end$$

DELIMITER ;
DELIMITER $$
create trigger CHEC_INSER_TURMA_I_BR
before insert on TURMAS
for each row
begin

    declare xQTD int;

    select COUNT(*) INTO xQTD
    from TURMAS 
    where TURNO_ID = new.TURNO_ID 
    and SALA_ID = new.SALA_ID;

    if xQTD > 0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|Já existe uma turma nesta sala e turno!';
    end if;
end$$

DELIMITER ;

DELIMITER $$
create trigger CHEC_UPDT_CARG_USU_U_BR
before update on TURMAS
for each row
begin
    declare xQTD int;

    select COUNT(*) INTO xQTD
    from TURMAS 
    where TURNO_ID = new.TURNO_ID 
    and SALA_ID = new.SALA_ID;

    if xQTD > 0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|Já existe uma turma nesta sala e turno!';
    end if;
end$$

DELIMITER ;
DELIMITER $$
CREATE TRIGGER IMPE_ALTER_DATA_CRIA_EMP_U_BR
BEFORE UPDATE ON EMPRESAS
FOR EACH ROW
BEGIN
    IF NEW.DATA_HORA_CRIACAO <> OLD.DATA_HORA_CRIACAO THEN
        SET @msg = CONCAT('|Não é possível alterar a data de criação. Data de criação atual: ', NEW.DATA_HORA_CRIACAO);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msg;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER IMPE_ALTER_DATA_CRIA_USU_U_BR
BEFORE UPDATE ON USUARIOS
FOR EACH ROW
BEGIN
    IF NEW.DATA_HORA_CRIACAO <> OLD.DATA_HORA_CRIACAO THEN
        SET @msg = CONCAT('|Não é possível alterar a data de criação. Data de criação atual: ', NEW.DATA_HORA_CRIACAO);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msg;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER IMPE_ALTER_DATA_CRIA_BAN_U_BR
BEFORE UPDATE ON BANCOS
FOR EACH ROW
BEGIN
    IF NEW.DATA_HORA_CRIACAO <> OLD.DATA_HORA_CRIACAO THEN
        SET @msg = CONCAT('|Não é possível alterar a data de criação. Data de criação atual: ', NEW.DATA_HORA_CRIACAO);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msg;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER IMPE_ALTER_DATA_CRIA_CAR_U_BR
BEFORE UPDATE ON CARGOS
FOR EACH ROW
BEGIN
    IF NEW.DATA_HORA_CRIACAO <> OLD.DATA_HORA_CRIACAO THEN
        SET @msg = CONCAT('|Não é possível alterar a data de criação. Data de criação atual: ', NEW.DATA_HORA_CRIACAO);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msg;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER IMPE_ALTER_DATA_CRIA_CBN_U_BR
BEFORE UPDATE ON CONTAS_BANCOS
FOR EACH ROW
BEGIN
    IF NEW.DATA_HORA_CRIACAO <> OLD.DATA_HORA_CRIACAO THEN
        SET @msg = CONCAT('|Não é possível alterar a data de criação. Data de criação atual: ', NEW.DATA_HORA_CRIACAO);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msg;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER IMPE_ALTER_DATA_CRIA_GRP_U_BR
BEFORE UPDATE ON GRUPOS_CONTAS
FOR EACH ROW
BEGIN
    IF NEW.DATA_HORA_CRIACAO <> OLD.DATA_HORA_CRIACAO THEN
        SET @msg = CONCAT('|Não é possível alterar a data de criação. Data de criação atual: ', NEW.DATA_HORA_CRIACAO);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msg;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER IMPE_ALTER_DATA_CRIA_MOV_U_BR
BEFORE UPDATE ON MOVIMENTOS
FOR EACH ROW
BEGIN
    IF NEW.DATA_HORA_CRIACAO <> OLD.DATA_HORA_CRIACAO THEN
        SET @msg = CONCAT('|Não é possível alterar a data de criação. Data de criação atual: ', NEW.DATA_HORA_CRIACAO);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msg;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER IMPE_ALTER_DATA_CRIA_SUB_U_BR
BEFORE UPDATE ON SUBCONTAS
FOR EACH ROW
BEGIN
    IF NEW.DATA_HORA_CRIACAO <> OLD.DATA_HORA_CRIACAO THEN
        SET @msg = CONCAT('|Não é possível alterar a data de criação. Data de criação atual: ', NEW.DATA_HORA_CRIACAO);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msg;
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER IMPE_ALTER_DATA_CRIA_TIP_U_BR
BEFORE UPDATE ON TIPO_DOCUMENTOS
FOR EACH ROW
BEGIN
    IF NEW.DATA_HORA_CRIACAO <> OLD.DATA_HORA_CRIACAO THEN
        SET @msg = CONCAT('|Não é possível alterar a data de criação. Data de criação atual: ', NEW.DATA_HORA_CRIACAO);
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msg;
    END IF;
END $$
DELIMITER ;
DELIMITER $$
create trigger IMPE_DELET_CARG_ADMIN_D_BR
before delete on CARGOS
for each row
begin
    if old.ADMIN = 1 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O cargo admin não pode ser deletado';
    end if;

end$$

DELIMITER ;

DELIMITER $$
create trigger IMPE_UPDT_CARG_ADMIN_D_BR
before update on CARGOS
for each row
begin
    if old.ADMIN = 1 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O cargo admin não pode ser alterado';
    end if;

end$$

DELIMITER ;

DELIMITER $$
create trigger IMPE_DELET_USU_ADMIN_D_BR
before delete on FUNCIONARIOS
for each row
begin

    declare xADMIN int;
    select 
      CAR.ADMIN into xADMIN
    from CARGOS CAR
    
    inner join FUNCIONARIOS FUN
    on CAR.CARGO_ID = FUN.CARGO_ID

    where FUN.USUARIO_ID = old.USUARIO_ID;

    if xADMIN = 1 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O usuário admin não pode ser deletado';
    end if;

end$$

DELIMITER ;

DELIMITER $$
create trigger IMPE_UPDT_CARG_USU_ADMIN_D_BR
before update on FUNCIONARIOS
for each row
begin

    declare xADMIN int;

    select 
      CAR.ADMIN into xADMIN
    from CARGOS CAR
    
    inner join FUNCIONARIOS FUN
    on CAR.CARGO_ID = FUN.CARGO_ID

    where FUN.USUARIO_ID = old.USUARIO_ID;

    if xADMIN = 1 and old.CARGO_ID != new.CARGO_ID then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O usuário admin não pode ser mudado';
    end if;

end$$

DELIMITER ;

DELIMITER $$
create trigger IMPE_UPDT_ATIV_USU_ADMIN_D_BR
before update on USUARIOS
for each row
begin

    declare xADMIN int;

    select 
      CAR.ADMIN into xADMIN
    from CARGOS CAR
    
    inner join FUNCIONARIOS FUN
    on CAR.CARGO_ID = FUN.CARGO_ID

    where FUN.USUARIO_ID = old.USUARIO_ID;

    if xADMIN = 1 and new.ATIVO = 0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O usuário admin não pode ser desativado';
    end if;

end$$

DELIMITER ;

DELIMITER $$
create trigger VER_EMPRESA_EXISTE_I_BR
before insert on EMPRESAS

for each row
begin
	declare qtd int;
    set qtd = (select count(*) from EMPRESAS where CPF_CNPJ = NEW.CPF_CNPJ);
    if qtd > 0 then
        signal sqlstate'45000' set message_text = '|Empresa já cadastrada no sistema!';
    end if;
end $$

DELIMITER ;

DELIMITER $$
create trigger VER_EMPRESA_EXISTE_U_BR
before update on EMPRESAS

for each row
begin
	declare qtd int;
    set qtd = (select count(*) from EMPRESAS where CPF_CNPJ = NEW.CPF_CNPJ);
    if qtd > 0 and (not (OLD.CPF_CNPJ = NEW.CPF_CNPJ)) then
      signal sqlstate'45000' set message_text = '|Empresa já cadastrada no sistema!';
    end if;
end $$

DELIMITER ;
DELIMITER $$
create trigger VER_USUARIO_EXISTE_I_BR
before insert on USUARIOS

for each row
begin
	declare qtd int;
    set qtd = (select count(*) from USUARIOS where CPF = NEW.CPF or EMAIL = NEW.EMAIL);
    if qtd > 0 then
        signal sqlstate'45000' set message_text = '|Usuário já cadastrado no sistema!';
    end if;
end $$

DELIMITER ;

DELIMITER $$
create trigger VER_USUARIO_EXISTE_U_BR
before update on USUARIOS

for each row
begin
	declare qtd int;
    set qtd = (select count(*) from USUARIOS where CPF = NEW.CPF or EMAIL = NEW.EMAIL);
    if qtd > 0 and ( not (OLD.CPF = NEW.CPF or OLD.EMAIL = NEW.EMAIL)) then
        signal sqlstate'45000' set message_text = '|Usuário já cadastrado no sistema!';
    end if;
end $$

DELIMITER ;
create or replace view VW_PERMISSOES as
select 0 as PERMISSAO_ID, 'Financeiro' as NOME from dual union all
select 1, 'Vendedor' from dual union all
select 2, 'Supervisor' from dual union all
select 3, 'Gestor' from dual

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
  IS_ADMIN,
  USUARIO_ALTERACAO_ID,
  USUARIO_CRIACAO_ID
) values (
  xEMPRESA_ID,
  3,
  'Admin',
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




