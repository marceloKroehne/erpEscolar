<div class="info_curso">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Bolsas</h1>
    </div>
    <div class="coluna3">
        <button id="nova_bolsa" >Nova bolsa</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_bolsa">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Bolsas
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($bolsas as $bolsa):?>
                <tr>
                    <th scope="row"><?=$bolsa->getBolsaId();?></th>
                    <td data-value='<?=$bolsa->toJson();?>'>
                        <div class="nome_celula">
                            <?=$bolsa->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>