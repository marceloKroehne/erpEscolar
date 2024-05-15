<div class="info_turma">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Turmas</h1>
    </div>
    <div class="coluna3">
        <button id="novo_turma" >Nova turma</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_turma">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Turmas
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($turmas as $turma):?>
                <tr>
                    <th scope="row"><?=$turma->getTurmaId();?></th>
                    <td data-value='<?=$turma->toJson();?>'>
                        <div class="nome_celula">
                            <?=$turma->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>