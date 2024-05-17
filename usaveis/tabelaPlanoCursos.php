<div class="info_plano_curso">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Planos de cursos</h1>
    </div>
    <div class="coluna3">
        <button id="novo_plano_curso" >Novo plano de curso</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_plano_curso">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Planos de cursos
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($planoCursos as $planoCurso):?>
                <tr>
                    <th scope="row"><?=$planoCurso->getPlanoCursoId();?></th>
                    <td data-value='<?=$planoCurso->toJson();?>'>
                        <div class="nome_celula">
                            <?=$planoCurso->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>