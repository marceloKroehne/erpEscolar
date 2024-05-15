<div id="modal_situacao_turma" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_situacao_turma_titulo" class="modal-title">Nova situação de turma</h5>
                <button id="modal_situacao_turma_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_situacao_turma_form" action="situacaoTurma.php" method="post">
                        <label for="modal_situacao_turma_input_nome">Nome:</label>
                        <input name="modal_situacao_turma_input_nome" type="text" id="modal_situacao_turma_input_nome" required>
                        <label>Ativo: <input type="checkbox" id="situacao_turma_ativo" name="situacao_turma_ativo"></label>
                        <input value="0" id="situacao_turma_id" name="situacao_turma_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_situacao_turma_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_situacao_turma_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>