<div id="modal_turno" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_turno_titulo" class="modal-title">Novo turno</h5>
                <button id="modal_turno_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_turno_form" action="gerenciarTurnos.php" method="post">
                        <label for="modal_turno_input_nome">Nome:</label>
                        <input name="modal_turno_input_nome" type="text" id="modal_turno_input_nome" required>
                        <label>Ativo: <input type="checkbox" id="turno_ativo" name="turno_ativo"></label>
                        <input value="0" id="turno_id" name="turno_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_turno_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_turno_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>