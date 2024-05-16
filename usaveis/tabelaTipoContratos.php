<div class="info_tipo_contrato">

    <div class="topo">
        <div class="coluna1"></div>
        <div class="coluna2">
            <h1>Tipos de contratos</h1>
        </div>
        <div class="coluna3">
            <button id="novo_tipo_contrato" >Novo tipo de contrato</button>
        </div>
    
    </div>

    <div class="tabela">
        <table class="table table-striped" id="tabela_tipo_contrato">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Tipos de contratos
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?foreach($tipoContratos as $tipoContrato):?>
                    <tr>
                        <th scope="row"><?=$tipoContrato->getTipoContratoId();?></th>
                        <td data-value='<?=$tipoContrato->toJson();?>'>
                            <div class="nome_celula">
                                <?=$tipoContrato->getNome();?>
                            </div> 
                            <button>Editar</button>
                        </td>
                    </tr>
                <?endforeach;?>
            </tbody> 
        </table>
    </div>

</div>