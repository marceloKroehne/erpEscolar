create or replace view VW_PERMISSOES as
select 0 as PERMISSAO_ID, 'Financeiro' as NOME from dual union all
select 1, 'Vendedor' from dual union all
select 2, 'Supervisor' from dual union all
select 3, 'Gestor' from dual