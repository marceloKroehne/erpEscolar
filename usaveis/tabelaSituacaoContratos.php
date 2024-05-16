<div class="info_situacao_contrato">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Situações de contratos</h1>
    </div>
    <div class="coluna3">
        <button id="novo_situacao_contrato" >Nova situação de contrato</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_situacao_contrato">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Situações de contratos
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($situacoesContratos as $situacaoContrato):?>
                <tr>
                    <th scope="row"><?=$situacaoContrato->getSituacaoContratoId();?></th>
                    <td data-value='<?=$situacaoContrato->toJson();?>'>
                        <div class="nome_celula">
                            <?=$situacaoContrato->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>