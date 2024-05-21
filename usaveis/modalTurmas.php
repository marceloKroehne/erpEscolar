<div id="modal_turma" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_turma_titulo" class="modal-title">Nova turma</h5>
                <button id="modal_turma_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_turma_form" action="gerenciarTurmas.php" method="post">
                        <label for="modal_turma_input_nome">Nome:</label>
                        <input name="modal_turma_input_nome" type="text" id="modal_turma_input_nome" required>
                        <label>Ativo: <input type="checkbox" id="turma_ativo" name="turma_ativo"></label>

                        <label for="max_alunos">Máximo de alunos:</label>
                        <input name="max_alunos" type="text" id="max_alunos" required>
                        <label for="min_alunos">Mínimo de alunos:</label>
                        <input name="min_alunos" type="text" id="min_alunos" required>
                        <label for="meta_alunos">Meta de alunos:</label>
                        <input name="meta_alunos" type="text" id="meta_alunos" required>
     
                        <?
                        $inputId = "input_gerenciar_modalidade";
                        $listaId = "lista_gerenciar_modalidade";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "modalidades";

                        foreach($modalidades as $modalidade){
                            $parametro = new Parametro($modalidade->getModalidadeId(), $modalidade->getNome());
                            $parametro->dados = json_decode($modalidade->toJson());
                            array_push($parametrosPesquisa, $parametro);
                        }
                        ?>
                        <label>Modalidade</label>
                        <div class="pesquisa_modalidades">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="modalidade_id" name="modalidade_id" value="0">

                        <?
                        $inputId = "input_gerenciar_situacao_turma";
                        $listaId = "lista_gerenciar_situacao_turma";
                        $placeHolderPesquisa = "situações de turmas";

                        $parametrosPesquisa = [];

                        foreach($situacoes as $situacao){
                            $parametro = new Parametro($situacao->getSituacaoTurmaId(), $situacao->getNome());
                            $parametro->dados = json_decode($situacao->toJson());
                            array_push($parametrosPesquisa, $parametro);
                        }
                        ?>

                        <label>Situação de turma</label>
                        <div class="pesquisa_situacao_turma">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="situacao_turma_id" name="situacao_turma_id" value="0">

                        <?
                        $inputId = "input_gerenciar_professor";
                        $listaId = "lista_gerenciar_professor";
                        $placeHolderPesquisa = "professores";

                        $parametrosPesquisa = [];

                        foreach($professores as $professor){
                            if($professor->isProfessor()){
                                $parametro = new Parametro($professor->getFuncionarioId(), $professor->getNome());
                                $parametro->dados = json_decode($professor->toJson());
                                array_push($parametrosPesquisa, $parametro);
                            }
                        }
                        ?>

                        <label>Professor</label>
                        <div class="pesquisa_professor">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="professor_id" name="professor_id" value="0">


                        <?
                        $inputId = "input_gerenciar_turno";
                        $listaId = "lista_gerenciar_turno";
                        $placeHolderPesquisa = "turnos";

                        $parametrosPesquisa = [];

                        foreach($turnos as $turno){

                            $parametro = new Parametro($turno->getTurnoId(), $turno->getNome());
                            $parametro->dados = json_decode($turno->toJson());
                            array_push($parametrosPesquisa, $parametro);
                        
                        }
                        ?>

                        <label>Turno</label>
                        <div class="pesquisa_turno">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="turno_id" name="turno_id" value="0">

                        <?
                        $inputId = "input_gerenciar_sala";
                        $listaId = "lista_gerenciar_sala";
                        $placeHolderPesquisa = "salas";

                        $parametrosPesquisa = [];

                        foreach($salas as $sala){

                            $parametro = new Parametro($sala->getSalaId(), $sala->getNome());
                            $parametro->dados = json_decode($sala->toJson());
                            array_push($parametrosPesquisa, $parametro);
                            
                        }
                        ?>

                        <label>Sala</label>
                        <div class="pesquisa_sala">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="sala_id" name="sala_id" value="0">

                        <?
                        $inputId = "input_gerenciar_curso";
                        $listaId = "lista_gerenciar_curso";
                        $placeHolderPesquisa = "cursos";

                        $parametrosPesquisa = [];

                        foreach($cursos as $curso){

                            $parametro = new Parametro($curso->getCursoId(), $curso->getNome());
                            $parametro->dados = json_decode($curso->toJson());
                            array_push($parametrosPesquisa, $parametro);
                            
                        }
                        ?>

                        <label>Curso</label>
                        <div class="pesquisa_curso">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="curso_id" name="curso_id" value="0">

                        <label for="data_inicio">Data início:</label>
                        <input name="data_inicio" maxlength="10" type="text" id="data_inicio" required>

                        <label for="data_fim">Data final:</label>
                        <input name="data_fim" maxlength="10" type="text" id="data_fim" required>
                       
                        <input value="0" id="turma_id" name="turma_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_turma_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_turma_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>