DELIMITER $$
create trigger CHEC_MOV_LAN_CONT_U_BR
before update on CONTRATOS
for each row
begin

    declare xQTD int;

    select COUNT(*) INTO xQTD
    from PARCELAS PAR 
    inner join CONTRATOS CON
    on PAR.CONTRATO_ID = new.CONTRATO_ID
    where PAR.MOVIMENTO_ID is not null
    and PAR.STATUS_PAGAMENTO in (1,2);

    if xQTD > 0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|Não é possivel modificar um contrato que tenha lançamentos no caixa!';
    end if;
end$$

DELIMITER ;

DELIMITER $$
create trigger CHEC_MOV_LAN_CONT_D_BR
before delete on CONTRATOS
for each row
begin
    declare xQTD int;

    select COUNT(*) INTO xQTD
    from PARCELAS PAR 
    inner join CONTRATOS CON
    on PAR.CONTRATO_ID = old.CONTRATO_ID
    where PAR.MOVIMENTO_ID is not null
    and PAR.STATUS_PAGAMENTO in (1,2);

    if xQTD > 0 then
        SIGNAL SQLSTATE '45000' set MESSAGE_TEXT = '|Não é possivel deletar um contrato que tenha lançamentos no caixa!';
    end if;
end$$

DELIMITER ;