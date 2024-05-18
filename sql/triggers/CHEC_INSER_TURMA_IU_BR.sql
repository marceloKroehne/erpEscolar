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
create trigger CHEC_INSER_TURMA_U_BR
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