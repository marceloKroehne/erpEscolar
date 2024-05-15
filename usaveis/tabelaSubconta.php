<div class="info_subconta">

    <div class="topo">
        <h1>Subcontas</h1>
    </div>

    <div class="tabela_sec">
        <table class="table table-striped" id="tabela_sub">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Subcontas
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Grupo de contas
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>

                <?
                $id = 1;
                $grupoContaId = 0;
                ?>
                <?foreach($subcontas as $subconta):?>
                   
                    <?
                    $grp = $subconta->getGrupoConta();
                    if($grupoContaId === 0 || $grupoContaId !== $grp->getGrupoContaId()){
                        $grupoContaId = $grp->getGrupoContaId();
                        $id = 1;
                    }
                    ?> 
                    <tr>
                        <th scope="row"><?=$grp->getGrupoContaId().".". $id;?></th>
                        <td><?=$subconta->getNome();?></td>
                        <td data-value='<?=$subconta->toJson();?>'>
                            <div class="celula">
                                <div class="nome_celula">
                                    <?=$grp->getNome();?>
                                </div> 
                                <button>Editar</button>
                            </div>
                        </td>
                    </tr>
                    <? $id =  $id +1;?>
                <?endforeach;?>
            </tbody> 
        </table>
    </div>

</div>