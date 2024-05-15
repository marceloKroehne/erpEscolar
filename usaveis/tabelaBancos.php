<div class="info_banco">

    <div class="topo">
        <div class="coluna1"></div>
        <div class="coluna2">
            <h1>Bancos</h1>
        </div>
        <div class="coluna3">
            <button id="novo_banco" >Novo banco</button>
            <button id="nova_conta" >Nova conta</button>
        </div>
        
    </div>

    <div class="tabela_sec">
        <table class="table table-striped" id="tabela_banco">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Bancos
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Número banco
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?foreach($bancos as $banco):?>
                    <tr>
                        <th scope="row"><?=$banco->getBancoId();?></th>
                        <td><?=$banco->getNome();?></td>
                        <td data-value='<?=$banco->toJson();?>'>
                            <div class="celula">
                                <div class="nome_celula">
                                    <?=$banco->getNumeroBanco();?>
                                </div> 
                                <button>Editar</button>
                            </div>
                        </td>
                    </tr>
                <?endforeach;?>
            </tbody> 
        </table>
    </div>

</div>