<div id="modal_movimento" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_movimento_titulo" class="modal-title">Novo movimento</h5>
                <button id="modal_movimento_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_movimento_form" action="movimentoCaixa.php" method="post">
                        <div class="modal_corpo2">
                            <h5 class="aviso" id="aviso"></h5>
                            <label for="modal_movimento_data">Data:</label>
                            <input name="modal_movimento_data" maxlength="10" type="text" id="modal_movimento_data" required>

                            <?

                            $parametrosPesquisa = [];

                            foreach($subcontas as $subconta){
                                if($subconta->getTipo() == 0){
                                    $parametro = new Parametro($subconta->getSubcontaId(), $subconta->getNome());
                                    $parametro->dados = $subconta->toJson();
    
                                    array_push($parametrosPesquisa, $parametro);
                                }

                            }
                            
                            $inputId = "input_subcontas";
                            $listaId = "lista_subcontas";
                            $placeHolderPesquisa = "subcontas";
                            ?>

                            <label for="input_subcontas">Subconta entrada:</label>

                            <?
                            require("./usaveis/seletor.php");

                            $parametrosPesquisa = [];
                            
                            foreach($subcontas as $subSaida){
                                if($subSaida->getTipo() == 1){
                                    $parametro = new Parametro($subSaida->getSubcontaId(), $subSaida->getNome());
                                    $parametro->dados = $subSaida->toJson();

                                    array_push($parametrosPesquisa, $parametro);
                                }
                            }
                                                        
                            $inputId = "input_subcontas_saida";
                            $listaId = "lista_subcontas_saida";
                            $placeHolderPesquisa = "subcontas_saida";
                            ?>

                            <label for="input_subcontas_saida">Subconta saída:</label>
                            
                            <?
                            require("./usaveis/seletor.php");
                            ?>

                            <label id="lb_parcela_quitar" for="input_parcela">Parcela a quitar</label>
                            <input id="parcela_quitar" hint="Número da parcela para quitar" name="parcela_quitar">

                            <?

                            $parametrosPesquisa = [];

                            foreach($tiposDocumentos as $docs){
                                $parametro = new Parametro($docs->getTipoDocumentoId(), $docs->getNome());
                                $parametro->dados = $docs->toJson();
                            
                                array_push($parametrosPesquisa, $parametro);
                            }

                            $inputId = "input_docs";
                            $listaId = "lista_docs";
                            $placeHolderPesquisa = "tipos de documentos";
                            
                            ?>

                            
                            <label for="input_docs">Tipos documentos:</label>
                            <?require("./usaveis/seletor.php");?>      
                            
                            <label for="modal_movimento_historico">Histórico:</label>
                            <input name="modal_movimento_historico" type="text" id="modal_movimento_historico" required>


                            <label for="modal_movimento_nr_documento">Número documento:</label>
                            <input name="modal_movimento_nr_documento" type="text" id="modal_movimento_nr_documento" required>

                            <label for="modal_movimento_valor">Valor:</label>
                            <input name="modal_movimento_valor" type="text" id="modal_movimento_valor" required>

                            <label for="modal_movimento_obs">Observação:</label>
                            <input name="modal_movimento_obs" type="text" id="modal_movimento_obs" required>

                            <input value="0" id="movimento_id" name="movimento_id" hidden>
                            <input value="0" id="subconta_entrada_id" name="subconta_entrada_id" hidden>
                            <input value="0" id="subconta_saida_id" name="subconta_saida_id" hidden>
                            <input value="0" id="tipo_documento_id" name="tipo_documento_id" hidden>
                            <input value="0" id="numero_movimento" name="numero_movimento" hidden>
                           
                            <input hidden value='<?=json_encode($listaMovimentosOfx)?>' id="lista_movimentos" name="lista_movimentos">
                            
                            <input hidden value='<?=$posicao?>' id="posicao_lista" name="posicao_lista">


                            <input hidden name="data_movimento_ini" value="<?=$dataIni;?>">
                            <input hidden name="data_movimento_fim" value="<?=$dataFim;?>">

                        </div>    
                    </form>
                </div>   
                
                <form id="modal_movimento_form_delet" action="movimentoCaixa.php" method="post">
                    <input value="0" id="deletar_movimento_id" name="deletar_movimento_id" hidden>
                    <input value="0" id="banco_id" name="banco_id" hidden>

                    <input hidden name="data_movimento_ini" value="<?=$dataIni;?>">
                    <input hidden name="data_movimento_fim" value="<?=$dataFim;?>">

                </form>
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_movimento_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="deletar">
                        <button id="modal_movimento_bt_deletar" type="button" class="btn btn-danger" data-dismiss="modal">Deletar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_movimento_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>