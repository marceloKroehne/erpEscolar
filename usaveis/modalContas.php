<div id="modal_conta" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_conta_titulo" class="modal-title">Nova conta</h5>
                <button id="modal_conta_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="modal_corpo">
                    <form id="modal_conta_form" action="gerenciarBancos.php" method="post">
                        <div class="modal_corpo2">
                
                            <label for="modal_conta_input_agencia">Agencia:</label>
                            <input type="text" id="modal_conta_input_agencia" name="modal_conta_input_agencia" required>

                                            
                            <label for="modal_conta_input_nr_conta">Número Conta:</label>
                            <input type="text" id="modal_conta_input_nr_conta" name="modal_conta_input_nr_conta" required>

                            <label for="<?=$listaId?>">Bancos:</label>

                            <?

                            $inputId = "input_gerenciar_banco";
                            $listaId = "lista_gerenciar_banco";

                            $parametrosPesquisa = [];
                            $placeHolderPesquisa = "Bancos";

                            foreach($bancos as $banco){
                                if(!$banco->isAtivo()){
                                    continue;
                                }
                                $parametro = new Parametro($banco->getBancoId(), $banco->getNome());
                                $parametro->dados = json_decode($banco->toJson());
                                array_push($parametrosPesquisa, $parametro);
                            }

                            ?>

                            <div class="bloco_pesquisa">
                                <div class="input_pesquisa">
                                    <?require('./usaveis/seletor.php');?>
                                </div>
                            </div>

                            <label>Ativo: <input type="checkbox" id="conta_ativo" name="conta_ativo"></label>

                        </div>

                        <input hidden id="modal_conta_banco_id" name="modal_conta_banco_id" value="0">

                        <input hidden id="modal_conta_banco_id_ant" name="modal_conta_banco_id_ant" value="0">
                        <input hidden id="modal_conta_input_agencia_ant" name="modal_conta_input_agencia_ant" value="0">
                        <input hidden id="modal_conta_input_nr_conta_ant" name="modal_conta_input_nr_conta_ant" value="0">

                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_conta_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_conta_bt_salvar" type="contamit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>