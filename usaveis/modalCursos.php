<div id="modal_curso" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_curso_titulo" class="modal-title">Novo curso</h5>
                <button id="modal_curso_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_curso_form" action="gerenciarCursos.php" method="post">
                        <label for="modal_curso_input_nome">Nome:</label>
                        <input name="modal_curso_input_nome" type="text" id="modal_curso_input_nome" required>
                        <label>Ativo: <input type="checkbox" id="curso_ativo" name="curso_ativo"></label>
                        <label for="valor">Valor:</label>
                        <input name="valor" type="text" id="valor" required>
                        <label for="numero_aulas">Número aulas:</label>
                        <input name="numero_aulas" type="text" id="numero_aulas" required>
                        <label for="carga_horaria">Carga horária:</label>
                        <input name="carga_horaria" type="text" id="carga_horaria" required>
     
                        <?
                        $inputId = "input_gerenciar_matriz";
                        $listaId = "lista_gerenciar_matriz";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "matrizes curriculares";

                        foreach($matrizes as $matriz){
                            $parametro = new Parametro($matriz->getMatrizCurricularId(), $matriz->getNome());
                            $parametro->dados = json_decode($matriz->toJson());
                            array_push($parametrosPesquisa, $parametro);
                        }
                        ?>
                        <label>Matriz curricular</label>
                        <div class="pesquisa_matrizes">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="matriz_id" name="matriz_id" value="0">

                        <?
                        $inputId = "input_gerenciar_tipo_curso";
                        $listaId = "lista_gerenciar_tipo_curso";
                        $placeHolderPesquisa = "tipos de cursos";

                        $parametrosPesquisa = [];

                        foreach($tiposCursos as $tipoCurso){
                            $parametro = new Parametro($tipoCurso->getTipoCursoId(), $tipoCurso->getNome());
                            $parametro->dados = json_decode($tipoCurso->toJson());
                            array_push($parametrosPesquisa, $parametro);
                        }
                        ?>

                        <label>Tipo de curso</label>
                        <div class="pesquisa_tipo_curso">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="tipo_curso_id" name="tipo_curso_id" value="0">

                        <?
                        $inputId = "input_gerenciar_coordenador";
                        $listaId = "lista_gerenciar_coordenador";
                        $placeHolderPesquisa = "coordenadores";

                        $parametrosPesquisa = [];

                        foreach($coordenadores as $coordenador){
                            if($coordenador->isProfessor()){
                                $parametro = new Parametro($coordenador->getFuncionarioId(), $coordenador->getNome());
                                $parametro->dados = json_decode($coordenador->toJson());
                                array_push($parametrosPesquisa, $parametro);
                            }
                        }
                        ?>

                        <label>Coordenador</label>
                        <div class="pesquisa_coordenador">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="coordenador_id" name="coordenador_id" value="0">

                        <label>Bolsas:</label>
                        <?

                        $parametrosCheckbox = [];

                        foreach($bolsas as $bolsa){
                            if($bolsa->isAtivo()){
                                $parametroCheckbox = new Parametro($bolsa->getBolsaId(), $bolsa->getNome());
                                array_push($parametrosCheckbox, $parametroCheckbox);
                            }
                        }

                        ?>
                        <div class="gerenciar_seletor_bolsas">
                            <?require('./usaveis/seletorCheckbox.php');?>
                        </div>

                        <input value="0" id="curso_id" name="curso_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_curso_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_curso_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>