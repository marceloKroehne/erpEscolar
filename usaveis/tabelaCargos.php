<div class="info_cargo">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Cargos</h1>
    </div>
    <div class="coluna3">
        <button id="novo_cargo" >Novo cargo</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_cargo">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Cargos
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($cargos as $cargo):?>
                <tr>
                    <th scope="row"><?=$cargo->getCargoId();?></th>
                    <td data-value='<?=$cargo->toJson();?>'>
                        <div class="nome_celula">
                            <?=$cargo->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>