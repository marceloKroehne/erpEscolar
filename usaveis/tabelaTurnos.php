<div class="info_turno">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Turnos</h1>
    </div>
    <div class="coluna3">
        <button id="novo_turno" >Novo turno</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_turno">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Turnos
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($turnos as $turno):?>
                <tr>
                    <th scope="row"><?=$turno->getTurnoId();?></th>
                    <td data-value='<?=$turno->toJson();?>'>
                        <div class="nome_celula">
                            <?=$turno->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>