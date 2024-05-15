<div class="info_matriz">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Matrizes curriculares</h1>
    </div>
    <div class="coluna3">
        <button id="novo_matriz" >Nova matriz curricular</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_matriz">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Matrizes curriculares
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($matrizes as $matriz):?>
                <tr>
                    <th scope="row"><?=$matriz->getMatrizCurricularId();?></th>
                    <td data-value='<?=$matriz->toJson();?>'>
                        <div class="nome_celula">
                            <?=$matriz->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>