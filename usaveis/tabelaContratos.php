<div class="info_contrato">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Contratos</h1>
    </div>
    <div class="coluna3">
        <button id="novo_contrato" >Novo contrato</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_contrato">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Contratos
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($contratos as $contrato):?>
                <tr>
                    <th scope="row"><?=$contrato->getContratoId();?></th>
                    <td data-value='<?=$contrato->toJson();?>'>
                        <div class="nome_celula">
                            <?="Turma: ".$contrato->getTurma()->getNome() ." - Aluno: ".$contrato->getAluno()->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>