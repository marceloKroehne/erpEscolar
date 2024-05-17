<div id="modal_plano_curso" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_plano_curso_titulo" class="modal-title">Novo plano de curso</h5>
                <button id="modal_plano_curso_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_plano_curso_form" action="gerenciarPlanoCursos.php" method="post">
                        <label for="modal_plano_curso_input_nome">Nome:</label>
                        <input name="modal_plano_curso_input_nome" type="text" id="modal_plano_curso_input_nome" required>
                        <label>Ativo: <input type="checkbox" id="plano_curso_ativo" name="plano_curso_ativo"></label>

                        <?
                        $inputId = "input_gerenciar_curso";
                        $listaId = "lista_gerenciar_curso";

                        $parametrosPesquisa = [];
                        $placeHolderPesquisa = "cursos";

                        foreach($cursos as $curso){
                            $parametro = new Parametro($curso->getCursoId(), $curso->getNome());
                            $parametro->dados = json_decode($curso->toJson());
                            array_push($parametrosPesquisa, $parametro);
                        }
                        ?>
                        <label>Curso</label>
                        <div class="pesquisa_cursos">
                            <div class="input_pesquisa">
                                <?require('./usaveis/seletor.php');?>
                            </div>
                        </div>
                        <input hidden id="curso_id" name="curso_id" value="0">

                        <label for="numero_parcelas">Numero de parcelas:</label>
                        <input name="numero_parcelas" type="text" id="numero_parcelas" required>

                        <label for="valor_parcela">Valor parcela:</label>
                        <input name="valor_parcela" type="text" id="valor_parcela" required>

                        <label for="valor_total">Valor total:</label>
                        <input name="valor_total" type="text" id="valor_total" required>

                        <input value="0" id="plano_curso_id" name="plano_curso_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_plano_curso_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_plano_curso_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>