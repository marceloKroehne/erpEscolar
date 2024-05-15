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

