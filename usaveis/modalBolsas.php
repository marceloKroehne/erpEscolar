<div id="modal_bolsa" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_bolsa_titulo" class="modal-title">Nova bolsa</h5>
                <button id="modal_bolsa_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_bolsa_form" action="gerenciarCursos.php" method="post">
                        <label for="modal_bolsa_input_nome">Nome:</label>
                        <input name="modal_bolsa_input_nome" type="text" id="modal_bolsa_input_nome" required>
                        <label>Ativo: <input type="checkbox" id="bolsa_ativo" name="bolsa_ativo"></label>
                        <label>Necessita autorização superior: <input type="checkbox" id="aut_sup" name="aut_sup"></label>
                        <label for="percentual_desconto">Percentual de desconto:</label>
                        <input name="percentual_desconto" type="text" id="percentual_desconto" required>
                        <input value="0" id="bolsa_id" name="bolsa_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_bolsa_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_bolsa_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>