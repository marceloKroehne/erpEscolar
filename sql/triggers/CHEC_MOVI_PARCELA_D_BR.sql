DELIMITER $$
create trigger CHEC_MOVI_PARCELA_D_BR
before delete on PARCELAS
for each row
begin

    declare xQTD int;

    select COUNT(*) INTO xQTD
    from MOVIMENTOS MOV

    inner join PARCELAS PAR
    on MOV.MOVIMENTO_ID = PAR.MOVIMENTO_ID;

    if xQTD > 0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|Não é possível excluir uma parcela com movimento lançado!';
    end if;
end$$

DELIMITER ;