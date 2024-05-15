<div class="info_pagamento">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Tipos de pagamentos</h1>
    </div>
    <div class="coluna3">
        <button id="novo_pagamento" >Novo tipo de pagamento</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_pagamento">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Tipos de pagamentos
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($pagamentos as $pagamento):?>
                <tr>
                    <th scope="row"><?=$pagamento->getTipopagamentoId();?></th>
                    <td data-value='<?=$pagamento->toJson();?>'>
                        <div class="nome_celula">
                            <?=$pagamento->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>