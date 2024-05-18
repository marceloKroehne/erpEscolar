<div id="modal_parcela" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_parcela_titulo" class="modal-title">Nova parcela</h5>
                <button id="modal_parcela_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_parcela_form" action="gerenciarparcelas.php" method="post">
                        <label for="modal_parcela_input_nome">Nome:</label>
                        <input name="modal_parcela_input_nome" type="text" id="modal_parcela_input_nome" required>
                        <?
                        $inputId = "input_gerenciar_conta";
                        $listaId = "lista_gerenciar_conta";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "contas";

                        foreach($contas as $conta){
                            
                            $parametro = new Parametro($conta->getNumeroConta(),$conta->getBanco()->getNome(). " - Ag:" . $conta->getAgencia()." N°: ".$conta->getNumeroConta());
                            $parametro->dados = json_decode($conta->toJson());
                            array_push($parametrosPesquisa, $parametro);
                          
                        }
                        ?>
                        <label id="lb_conta">Conta</label>
                        <div class="pesquisa_contas">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="filtro_conta" name="filtro_conta" value="">

                        <?
                        $inputId = "input_gerenciar_subconta";
                        $listaId = "lista_gerenciar_subconta";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "subcontas";

                        foreach($subcontas as $subconta){
                            if($subconta->getGrupoConta()->isRecebimentoVendas()){
                                $parametro = new Parametro($subconta->getSubContaId(), $subconta->getNome());
                                $parametro->dados = json_decode($subconta->toJson());
                                array_push($parametrosPesquisa, $parametro);
                            }
                        }
                        ?>
                        <label id="lb_subconta">Subconta</label>
                        <div class="pesquisa_subcontas">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="filtro_subconta" name="filtro_subconta" value="0">

                        <label for="valor">Valor:</label>
                        <input name="valor" type="text" id="valor" required>
                        <label>Quitar parcela: <input type="checkbox" id="quitar" name="quitar"></label>
                        <label id="lb_data_pagamento" for="data_pagamento">Data pagamento:</label>
                        <input name="data_pagamento" maxlength="10" type="text" id="data_pagamento" required>

                        <input value='<?=$contrato == null ? "" : json_encode($contrato)?>' id="contrato_sel" name="contrato_sel" hidden>
                        <input value="0" id="parcela_id" name="parcela_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <form id="modal_parcela_form_delet" action="gerenciarParcelas.php" method="post">
                    <input value="0" id="parcela_deletar_id" name="parcela_deletar_id" hidden>
                    <input value='<?=$contrato == null ? "" : json_encode($contrato)?>' id="contrato_del" name="contrato_del" hidden>
                </form>
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_parcela_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="deletar">
                        <button id="modal_parcela_bt_deletar" type="button" class="btn btn-danger" data-dismiss="modal">Deletar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_parcela_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>