<div class="info_movimento">

    <div class="topo">

        <div class="importar_ofx">
            <form action="movimentoCaixa.php" method="post" enctype="multipart/form-data">
                <label for="arquivo_ofx">Importar Ofx:</label> 
                <input id="arquivo_ofx" type="file" name="arquivo_ofx" accept=".ofx">
                <input hidden name="data_movimento_ini" value="<?=$dataIni;?>">
                <input hidden name="data_movimento_fim" value="<?=$dataFim;?>">
                <button type="submit">Enviar</button>
            </form>
            
        </div>

        <div class="exportar_movimentos">
            <form action="gerarExcel.php" method="post">
                <input value='<?=json_encode($movimentosExp)?>' hidden name="movimentos_exportar">
                <button type="submit">Exportar movimentos</button>
            </form>
        </div>

        <div class="novo_movimento">
            <button id="novo_movimento">Novo movimento</button>
        </div>
    </div>
    
    <div class="tabela_sec">
        <table class="table table-striped" id="tabela_movimento">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Data
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Conta
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Banco
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Histórico
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Grupo de contas
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Subconta
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Tipo de documento
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Número do documento
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Entrada
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Saída
                        </div>
                    </th>
                    <th scope="col">
                        <div class="titulo_tabela">
                            Observação
                        </div>
                    </th>
                    <th scope="col">
                    </th>
                </tr>
            </thead>
            <tbody>
                <?
                $totalEntrada = 0;
                $totalSaida = 0;
                ?>
                <?foreach($movimentos as $movimento):?>
                    <?if($filtroSubcontaId == null || $filtroSubcontaId == $movimento->getSubcontaEntrada()->getSubcontaId()):?>
                        <tr>
                            <th scope="row">
                                <div class="titulo_tabela">
                                    <?=$movimento->getMovimentoId();?>
                                </div>
                            </th>
                            <td><?=$movimento->getDataLancamento();?></td>
                            <td><?=$movimento->getSubcontaEntrada()->getConta()->getAgencia()." - ".$movimento->getSubcontaEntrada()->getConta()->getNumeroConta();?></td>
                            <td><?=$movimento->getSubcontaEntrada()->getConta()->getBanco()->getNome();?></td>
                            <td><?=$movimento->getHistorico();?></td>
                            <td><?=$movimento->getSubcontaEntrada()->getGrupoConta()->getNome();?></td>
                            <td><?=$movimento->getSubcontaEntrada()->getNome();?></td>
                            <td><?=$movimento->getTipoDocumento()->getNome();?></td>
                            <td><?=$movimento->getNumeroDocumento();?></td>
                        
                            <?$totalEntrada = $totalEntrada + $movimento->getValor();?>
                        
                            <td><?="R$ ".str_replace(".",",",$movimento->getValor());?></td>
                            <td></td>

                            <td><?=$movimento->getObservacao();?></td>
                            <td data-value='<?=$movimento->toJson();?>'>
                                <div class="celula">
                                    <div class="nome_celula">
                                    </div> 
                                    <button>Editar</button>
                                </div>
                            </td>
                        </tr>
                    <?endif;?>
                    <?if($filtroSubcontaId == null || $filtroSubcontaId == $movimento->getSubcontaSaida()->getSubcontaId()):?>
                        <tr>
                            <th scope="row">
                                <div class="titulo_tabela">
                                    <?=$movimento->getMovimentoId();?>
                                </div>
                            </th>
                            <td><?=$movimento->getDataLancamento();?></td>
                            <td><?=$movimento->getSubcontaSaida()->getConta()->getAgencia()." - ".$movimento->getSubcontaSaida()->getConta()->getNumeroConta();?></td>
                            <td><?=$movimento->getSubcontaSaida()->getConta()->getBanco()->getNome();?></td>
                            <td><?=$movimento->getHistorico();?></td>
                            <td><?=$movimento->getSubcontaSaida()->getGrupoConta()->getNome();?></td>
                            <td><?=$movimento->getSubcontaSaida()->getNome();?></td>
                            <td><?=$movimento->getTipoDocumento()->getNome();?></td>
                            <td><?=$movimento->getNumeroDocumento();?></td>

                            <?$totalSaida = $totalSaida + $movimento->getValor();?>
                            <td></td>
                            <td><?="R$ ".str_replace(".",",",$movimento->getValor());?></td>
            
                            <td><?=$movimento->getObservacao();?></td>
                            <td data-value='<?=$movimento->toJson();?>'>
                                <div class="celula">
                                    <div class="nome_celula">
                                    </div> 
                                    <button>Editar</button>
                                </div>
                            </td>
                        </tr>
                    <?endif;?>
                <?endforeach;?>

                <tr>
                    <th scope="row">
                        <div class="titulo_tabela">
                            Totais
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            Total entrada: R$ <?=str_replace(".",",",$totalEntrada);?>
                        </div>
                    </th>
                    <th scope="row">
                        <div class="titulo_tabela">
                            Total saída: R$ <?=str_replace(".",",",$totalSaida);?>
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>
                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>
                </tr>
                <tr>

                <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            Saldo: R$ <?=str_replace(".",",",$totalEntrada-$totalSaida);?>
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                    <th scope="row">
                        <div class="titulo_tabela">
                            -
                        </div>
                    </th>

                </tr>
            </tbody> 
        </table>
    </div>

</div>