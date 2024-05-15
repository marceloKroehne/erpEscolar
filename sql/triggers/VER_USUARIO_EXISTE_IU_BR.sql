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