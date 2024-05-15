<div class="info_tipo_curso">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Tipos de cursos</h1>
    </div>
    <div class="coluna3">
        <button id="novo_tipo_curso" >Novo tipo de curso</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_tipo_curso">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Tipo de cursos
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($tipo_cursos as $tipo_curso):?>
                <tr>
                    <th scope="row"><?=$tipo_curso->getTipoCursoId();?></th>
                    <td data-value='<?=$tipo_curso->toJson();?>'>
                        <div class="nome_celula">
                            <?=$tipo_curso->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>