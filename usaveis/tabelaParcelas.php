<div class="info_parcela">

<div class="topo">
    <div class="coluna1">
        <h1>Parcelas</h1>
    </div>
    <div class="coluna2">
        <form id="form_pesq_contrato" action="gerenciarParcelas.php" method="post">
            <input value='<?=$contrato == null ? "" : json_encode($contrato)?>' hidden id="contrato" name="contrato" value="0">
        </form>
        <?
        $inputId = "input_gerenciar_contrato";
        $listaId = "lista_gerenciar_contrato";

        $parametrosPesquisa = [];
        $placeHolderPesquisa = "contratos";

        foreach($contratos as $contrato){
            $parametro = new Parametro($contrato->getcontratoId(),"Nº:".$contrato->getcontratoId(). " / Turma : ".$contrato->getTurma()->getNome()." - Aluno: ". $contrato->getAluno()->getNome());
            $parametro->dados = json_decode($contrato->toJson());
            array_push($parametrosPesquisa, $parametro);
        }
        ?>
        <label>Contrato</label>
        <div class="pesquisa_contratos">
            <div class="input_pesquisa">
                <?require('./usaveis/seletor.php');?>
            </div>
        </div>

    </div>
    <div class="coluna3">
        <button id="novo_parcela" >Nova parcela</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_parcela">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Parcelas
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($parcelas as $parcela):?>
                <tr>
                    <th scope="row"><?=$parcela->getParcelaId();?></th>
                    <td data-value='<?=$parcela->toJson();?>'>
                        <div class="nome_celula">
                            <?=$parcela->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>