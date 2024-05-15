<div id="modal_matriz" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_matriz_titulo" class="modal-title">Nova matriz curricular</h5>
                <button id="modal_matriz_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_matriz_form" action="matrizesCurriculares.php" method="post">
                        <label for="modal_matriz_input_nome">Nome:</label>
                        <input name="modal_matriz_input_nome" type="text" id="modal_matriz_input_nome" required>
                        <label>Ativo: <input type="checkbox" id="matriz_ativo" name="matriz_ativo"></label>
                        <label>Disciplinas:</label>

                        <?

                        $parametrosCheckbox = [];

                        foreach($disciplinas as $disciplina){
                            $parametroCheckbox = new Parametro($disciplina->getDisciplinaId(), $disciplina->getNome());
                            array_push($parametrosCheckbox, $parametroCheckbox);
                        }

                        ?>
                        <div class="gerenciar_seletor_matriz">
                            <?require('./usaveis/seletorCheckbox.php');?>
                        </div>
                        <input value="0" id="matriz_id" name="matriz_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_matriz_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_matriz_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>