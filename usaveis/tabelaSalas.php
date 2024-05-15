<div class="info_sala">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Salas</h1>
    </div>
    <div class="coluna3">
        <button id="novo_sala" >Nova sala</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_sala">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Salas
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($salas as $sala):?>
                <tr>
                    <th scope="row"><?=$sala->getSalaId();?></th>
                    <td data-value='<?=$sala->toJson();?>'>
                        <div class="nome_celula">
                            <?=$sala->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>