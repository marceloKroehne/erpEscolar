<div id="modal_pag" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_pag_titulo" class="modal-title">Novo tipo de pagamento</h5>
                <button id="modal_pag_bt_fechar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal_corpo">
                    <form id="modal_pag_form" action="tipoPagamentos.php" method="post">
                        <label for="modal_pag_input_nome">Nome:</label>
                        <input name="modal_pag_input_nome" type="text" id="modal_pag_input_nome" required>
                        <label>Ativo: <input type="checkbox" id="pag_ativo" name="pag_ativo"></label>

                        <label>Tipo pagamento:</label>
                        <select id="tipo_pagamento_selecionado">
                            <option id="opcao_mensalista" value="0">
                                Mensalista
                            </option>
                            <option id="opcao_horista" value="1">
                                Horista
                            </option>
                        </select>

                        <label for="valor_salario">Valor salário:
                            <input name="valor_salario" type="text" id="valor_salario" required>
                        </label>

                        
                        <label for="percentual_inss">Percentual INSS:
                            <input name="percentual_inss" type="text" id="percentual_inss" required>
                        </label>
                        

                        <label for="valor_hora">Valor hora:                     
                            <input name="valor_hora" type="text" id="valor_hora" required>
                        </label>


                        <input value="0" id="tipo_pagamento_id" name="tipo_pagamento_id" hidden>
                    </form>
                </div>    
            </div>
            <div class="modal-footer">
                <div class="modal_rodape">
                    <div class="cancelar">
                        <button id="modal_pag_bt_cancelar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                    <div class="salvar">
                        <button id="modal_pag_bt_salvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>