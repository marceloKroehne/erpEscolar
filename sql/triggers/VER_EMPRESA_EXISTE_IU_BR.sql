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