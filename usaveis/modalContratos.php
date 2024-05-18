<div id="modal_contrato" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_contrato_titulo" class="modal-title">Novo plano de turma</h5>
                <button id="modal_contrato_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_contrato_form" action="gerenciarContratos.php" method="post">

                        <?
                        $inputId = "input_gerenciar_turma";
                        $listaId = "lista_gerenciar_turma";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "turmas";

                        foreach($turmas as $turma){
                            $parametro = new Parametro($turma->getTurmaId(), $turma->getNome());
                            $parametro->dados = json_decode($turma->toJson());
                            array_push($parametrosPesquisa, $parametro);
                        }
                        ?>
                        <label>Turma</label>
                        <div class="pesquisa_turmas">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="turma_id" name="turma_id" value="0">

                        <?
                        $inputId = "input_gerenciar_aluno";
                        $listaId = "lista_gerenciar_aluno";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "alunos";

                        foreach($alunos as $aluno){
                            $parametro = new Parametro($aluno->getAlunoId(), $aluno->getNome());
                            $parametro->dados = json_decode($aluno->toJson());
                            array_push($parametrosPesquisa, $parametro);
                        }
                        
                        ?>
                        <label>Aluno</label>
                        <div class="pesquisa_aluno">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="aluno_id" name="aluno_id" value="0">

                        <?
                        $inputId = "input_gerenciar_vendedor";
                        $listaId = "lista_gerenciar_vendedor";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "vendedor";

                        foreach($vendedores as $vendedor){
                            if($vendedor->isAtendente()){
                                $parametro = new Parametro($vendedor->getFuncionarioId(), $vendedor->getNome());
                                $parametro->dados = json_decode($vendedor->toJson());
                                
                                array_push($parametrosPesquisa, $parametro);
                            }
                        }
                        ?>
                        <label>Vendedor</label>
                        <div class="pesquisa_vendedor">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="vendedor_id" name="vendedor_id" value="0">

                        <?
                        $inputId = "input_gerenciar_situacao_contrato";
                        $listaId = "lista_gerenciar_situacao_contrato";

                        $placeHolderPesquisa = "situações de contrato";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "situacao";

                        foreach($situacoes as $situacao){
                         
                            $parametro = new Parametro($situacao->getSituacaoContratoId(), $situacao->getNome());
                            $parametro->dados = json_decode($situacao->toJson());
                            
                            array_push($parametrosPesquisa, $parametro);
                        
                        }
                        ?>
                        <label>Situação contrato</label>
                        <div class="pesquisa_situacao_contrato">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="situacao_contrato_id" name="situacao_contrato_id" value="0">

                        <?
                        $inputId = "input_gerenciar_tipo_contrato";
                        $listaId = "lista_gerenciar_tipo_contrato";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "tipos de contrato";

                        foreach($tipoContratos as $tipo){
                            
                            $parametro = new Parametro($tipo->getTipoContratoId(), $tipo->getNome());
                            $parametro->dados = json_decode($tipo->toJson());
                            
                            array_push($parametrosPesquisa, $parametro);
                            
                        }

                        ?>
                        <label>Tipo de contrato</label>
                        <div class="pesquisa_tipo_contrato">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="tipo_contrato_id" name="tipo_contrato_id" value="0">

                        <?
                        $inputId = "input_gerenciar_plano";
                        $listaId = "lista_gerenciar_plano";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "planos de curso";

                        foreach($planoCursos as $plano){
                          
                            $parametro = new Parametro($plano->getPlanoCursoId(), $plano->getNome());
                            $parametro->dados = json_decode($plano->toJson());
                            
                            array_push($parametrosPesquisa, $parametro);
                            
                        }
                        ?>
                        <label>Plano</label>
                        <div class="pesquisa_plano">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="plano_curso_id" name="plano_curso_id" value="0">

                        <?
                        $inputId = "input_gerenciar_bolsa";
                        $listaId = "lista_gerenciar_bolsa";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "bolsas";

                        foreach($bolsas as $bolsa){
                          
                            $parametro = new Parametro($bolsa->getBolsaId(), $bolsa->getNome());
                            $parametro->dados = json_decode($bolsa->toJson());
                            
                            array_push($parametrosPesquisa, $parametro);
                            
                        }
                        ?>
                        <label>Bolsa</label>
                        <div class="pesquisa_bolsa">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="bolsa_id" name="bolsa_id" value="0">
                        
                        <label for="data_inicio">Data início:</label>
                        <input name="data_inicio" maxlength="10" type="text" id="data_inicio" required>

                        <label for="data_fim">Data final:</label>
                        <input name="data_fim" maxlength="10" type="text" id="data_fim" required>

                        <label for="observacao">Observação:</label>
                        <input name="observacao" type="text" id="observacao" required>

                        <label for="valor_total">Valor total:</label>
                        <input name="valor_total" type="text" id="valor_total" disabled>

                        <input value="0" id="contrato_id" name="contrato_id" hidden>
                    </form>
                    <form id="form_turma" action="gerenciarContratos.php" method="post">
                        <input hidden id="curso_ins_id" name="curso_ins_id">
                        <input hidden value='<?=$_POST['turma_ins']?>' id="turma_ins" name="turma_ins">
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <form id="modal_contrato_form_delet" action="gerenciarContratos.php" method="post">
                    <input value="0" id="contrato_deletar_id" name="contrato_deletar_id" hidden>
                </form>
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_contrato_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                    <div class="deletar">
                        <button id="modal_contrato_bt_deletar" type="button" class="btn btn-danger" data-dismiss="modal">Deletar</button>
                    </div>
                    <div class="salvar">
                        <button id="modal_contrato_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>