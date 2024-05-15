<div class="info_conta">

    <div class="topo">
        <h1>Contas</h1>
    </div>

    <div class="tabela_sec">
        <table class="table table-striped" id="tabela_conta">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Agência
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Número conta
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Bancos
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>

                <?$id = 1;?>
                <?foreach($contas as $conta):?>
                   
                    <?$banco = $conta->getBanco();?> 
                    <tr>
                        <th scope="row"><?=$banco->getNumeroBanco().".". $id;?></th>
                        <td><?=$conta->getAgencia();?></td>
                        <td><?=$conta->getNumeroConta();?></td>
                        <td data-value='<?=$conta->toJson();?>'>
                            <div class="celula">
                                <div class="nome_celula">
                                    <?=$banco->getNome();?>
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