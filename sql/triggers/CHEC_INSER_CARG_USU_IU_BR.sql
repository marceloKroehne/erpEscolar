DELIMITER $$
create trigger CHEC_INSER_CARG_USU_I_BR
before insert on USUARIOS
for each row
begin
    if NEW.ATIVO not in (0, 1,2,3) then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O Status deve conter apenas 0, 1, 2, 3.';
    end if;
end$$

DELIMITER ;

DELIMITER $$
create trigger CHEC_UPDT_CARG_USU_U_BR
before update on USUARIOS
for each row
begin
    if NEW.ATIVO not in (0, 1,2,3) then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O Status deve conter apenas 0, 1, 2, 3.';
    end if;
end$$

DELIMITER ;