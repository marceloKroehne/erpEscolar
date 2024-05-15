<div id="modal_banco" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_banco_titulo" class="modal-title">Novo banco</h5>
                <button id="modal_banco_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_banco_form" action="gerenciarBancos.php" method="post">
                        <div class="modal_corpo2">
                            <label for="modal_banco_input_nome">Nome:</label>
                            <input name="modal_banco_input_nome" type="text" id="modal_banco_input_nome" required>
                            <label for="modal_banco_input_nr_banco">Número banco:</label>
                            <input name="modal_banco_input_nr_banco" type="text" id="modal_banco_input_nr_banco" required>
                            <label>Ativo: <input type="checkbox" id="banco_ativo" name="banco_ativo"></label>
                            <label>Exige ofx para importação: <input type="checkbox" id="input_exige_ofx" name="input_exige_ofx"></label>
                            <input value="0" id="banco_id" name="banco_id" hidden>
                        </div>    
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_banco_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_banco_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>