DELIMITER $$
create trigger CHEC_QUITAR_PARCELA_U_BR
before update on PARCELAS
for each row
begin

    declare xQTD int;
    declare xVALOR int;
    declare xVALOR_PARCELA int;

    select count(*) into xQTD 
    from PARCELAS
    where MOVIMENTO_ID = new.MOVIMENTO_ID 
    and PARCELA_ID != new.PARCELA_ID; 

     if xQTD >  0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|Já existe um movimento de quitação para essa parcela';
    end if;

    select VALOR INTO xVALOR
    from MOVIMENTOS

    WHERE MOVIMENTO_ID = new.MOVIMENTO_ID;

    select VALOR INTO xVALOR_PARCELA
    from PARCELAS

    WHERE PARCELA_ID = new.PARCELA_ID;

    if xVALOR !=  xVALOR_PARCELA then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O valor do movimento não condiz com o valor da parcela';
    end if;
end$$

DELIMITER ;

DELIMITER $$
create trigger CHEC_QUITAR_PARCELA_I_BR
before insert on PARCELAS
for each row
begin

    declare xQTD int;
    declare xVALOR int;
    declare xVALOR_PARCELA int;

    select count(*) into xQTD 
    from PARCELAS
    where MOVIMENTO_ID = new.MOVIMENTO_ID 
    and PARCELA_ID != new.PARCELA_ID; 

     if xQTD >  0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|Já existe um movimento de quitação para essa parcela';
    end if;


    select VALOR INTO xVALOR
    from MOVIMENTOS

    WHERE MOVIMENTO_ID = new.MOVIMENTO_ID;

    select VALOR INTO xVALOR_PARCELA
    from PARCELAS

    WHERE PARCELA_ID = new.PARCELA_ID;

    if xVALOR !=  xVALOR_PARCELA then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|O valor do movimento não condiz com o valor da parcela';
    end if;
end$$

DELIMITER ;