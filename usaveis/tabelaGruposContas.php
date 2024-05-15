<div class="info_grupo">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Grupos de contas</h1>
    </div>
    <div class="coluna3">
        <button id="novo_grupo" >Novo grupo de conta</button>
        <button id="nova_subconta" >Nova subconta</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_grp">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Grupo de contas
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($grupos as $grupo):?>
                <tr>
                    <th scope="row"><?=$grupo->getGrupoContaId();?></th>
                    <td data-value='<?=$grupo->toJson();?>'>
                        <div class="nome_celula">
                            <?=$grupo->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>