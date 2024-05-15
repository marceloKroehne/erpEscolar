<div id="modal_grp" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_grp_titulo" class="modal-title">Novo grupo de contas</h5>
                <button id="modal_grp_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_grp_form" action="gerenciarGruposContas.php" method="post">
                        <label for="modal_grp_input_nome">Nome:</label>
                        <input name="modal_grp_input_nome" type="text" id="modal_grp_input_nome" required>
                        <label>Ativo: <input type="checkbox" id="grupo_ativo" name="grupo_ativo"></label>
                        <input value="0" id="grupo_conta_id" name="grupo_conta_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_grp_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_grp_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>