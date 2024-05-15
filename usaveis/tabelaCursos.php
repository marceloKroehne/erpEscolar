<div class="info_curso">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Cursos</h1>
    </div>
    <div class="coluna3">
        <button id="novo_curso" >Novo curso</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_curso">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Cursos
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($cursos as $curso):?>
                <tr>
                    <th scope="row"><?=$curso->getCursoId();?></th>
                    <td data-value='<?=$curso->toJson();?>'>
                        <div class="nome_celula">
                            <?=$curso->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>