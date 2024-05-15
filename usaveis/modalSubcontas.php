<div id="modal_sub" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_sub_titulo" class="modal-title">Nova subconta</h5>
                <button id="modal_sub_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="modal_corpo">
                    <form id="modal_sub_form" action="gerenciarGruposContas.php" method="post">
                        <div class="modal_corpo2">
                
                            <label for="modal_sub_input_nome">Nome:</label>
                            <input type="text" id="modal_sub_input_nome" name="modal_sub_input_nome" required>
                        
                            <label for="modal_sub_input_tipo">Tipo:</label>

                            <select type="text" id="modal_sub_select_tipo_id" name="modal_sub_select_tipo_id">
                                <option value="0">Entrada</option>
                                <option value="1">Saída</option>
                            </select>

                            <label for="<?=$listaId?>">Grupo de contas:</label>

                            <div class="bloco_pesquisa">
                                <div class="input_pesquisa">
                                    <?require('./usaveis/seletor.php');?>
                                </div>
                            </div>

                            <label>Ativo: <input type="checkbox" id="subconta_ativo" name="subconta_ativo"></label>
                        </div>

                        <input value="0" id="subconta_id" name="subconta_id" hidden>
                        <input hidden id="modal_sub_grupo_id" name="modal_sub_grupo_id" value="0">

                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_sub_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_sub_bt_salvar" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>