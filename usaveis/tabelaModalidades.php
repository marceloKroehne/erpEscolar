<div class="info_modalidade">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Modalidades</h1>
    </div>
    <div class="coluna3">
        <button id="novo_modalidade" >Nova modalidade</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_modalidade">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Modalidades
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($modalidades as $modalidade):?>
                <tr>
                    <th scope="row"><?=$modalidade->getmodalidadeId();?></th>
                    <td data-value='<?=$modalidade->toJson();?>'>
                        <div class="nome_celula">
                            <?=$modalidade->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>