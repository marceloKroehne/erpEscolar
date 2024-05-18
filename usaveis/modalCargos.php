<div id="modal_cargo" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_cargo_titulo" class="modal-title">Novo cargo</h5>
                <button id="modal_cargo_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_cargo_form" action="gerenciarCargos.php" method="post">
                        <label for="cargo_nome">Nome:</label>
                        <input name="cargo_nome" type="text" id="cargo_nome" required>

                        <label>Ativo: <input type="checkbox" id="cargo_ativo" name="cargo_ativo"></label>
                        <label for="cargo_permissao_id">Permissão:</label>
                        <select id="cargo_permissao_id" name="cargo_permissao_id">
                            <?foreach($permissoes as $permissao):?>
                                <option value='<?=$permissao->getPermissaoId();?>'><?=$permissao->getNome();?></option>
                            <?endforeach;?>
                        </select>

                        <input value="0" id="cargo_id" name="cargo_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_cargo_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_cargo_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>