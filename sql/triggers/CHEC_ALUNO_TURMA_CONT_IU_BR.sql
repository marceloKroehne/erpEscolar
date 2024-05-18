DELIMITER $$
create trigger CHEC_ALUNO_TURMA_CONT_I_BR
before insert on CONTRATOS
for each row
begin

    declare xQTD int;

    select COUNT(*) INTO xQTD
    from CONTRATOS

    where ALUNO_ID = new.ALUNO_ID
    and TURMA_ID = new.TURMA_ID;

    if xQTD > 0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|Não é possivel inserir um contrato de um aluno na mesma turma duas vezes!';
    end if;
end$$

DELIMITER ;

DELIMITER $$
create trigger CHEC_ALUNO_TURMA_CONT_U_BR
before update on CONTRATOS
for each row
begin
    declare xQTD int;

    select COUNT(*) INTO xQTD
    from CONTRATOS

    where ALUNO_ID = new.ALUNO_ID
    and TURMA_ID = new.TURMA_ID;

    if xQTD > 0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|Não é possivel inserir um contrato de um aluno na mesma turma duas vezes!';
    end if;
end$$

DELIMITER ;