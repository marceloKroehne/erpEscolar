<div class="info_disciplina">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Disciplinas</h1>
    </div>
    <div class="coluna3">
        <button id="nova_disciplina" >Nova disciplina</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_disciplina">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Disciplinas
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($disciplinas as $disciplina):?>
                <tr>
                    <th scope="row"><?=$disciplina->getDisciplinaId();?></th>
                    <td data-value='<?=$disciplina->toJson();?>'>
                        <div class="nome_celula">
                            <?=$disciplina->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>