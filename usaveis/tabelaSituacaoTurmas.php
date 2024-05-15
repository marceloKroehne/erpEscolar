<div class="info_situacao_turma">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Situações das turmas</h1>
    </div>
    <div class="coluna3">
        <button id="novo_situacao_turma" >Nova situação de turma</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_situacao_turma">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                    Situações das turmas
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($situacao_turmas as $situacao_turma):?>
                <tr>
                    <th scope="row"><?=$situacao_turma->getSituacaoTurmaId();?></th>
                    <td data-value='<?=$situacao_turma->toJson();?>'>
                        <div class="nome_celula">
                            <?=$situacao_turma->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>