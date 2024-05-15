<div class="primeira_linha_elementos">
    <?               
        $funis = FunilBanco::getFunis($empresa->getEmpresaId(), $usuario->getUsuarioId());
        $inputId = "input_gerenciar_funil";
        $listaId = "lista_gerenciar_funil";
        $valorInputPesquisa = $funil->funilNome;
        $parametrosPesquisa = [];
        $placeHolderPesquisa = "Funis";

        foreach($funis as $funil){
            $parametro = new Parametro($funil->funilId, $funil->funilNome);
            $parametro->dados = $funil;
            array_push($parametrosPesquisa, $parametro);
        }

    ?>
    
    <label>Funis</label>
    <div class="seletor">
        
        <div class="input_pesquisa">
            <?include './usaveis/seletor.php';?>
        </div>
    </div>

    <?
        $inputId = "input_gerenciar_etapa";
        $listaId = "lista_gerenciar_etapa";
        $parametrosPesquisa = [];
        $placeHolderPesquisa = "etapas";
        $valorInputPesquisa = $etapa->etapaNome;
        
        foreach($funil->etapasFunil as $etapa){
            $parametro = new Parametro($etapa->etapaId, $etapa->etapaNome);
            $parametro->dados = $etapa;
            array_push($parametrosPesquisa, $parametro);
        }
    
    ?>

    <label>Etapas</label>
    <div class="seletor">
        <div class="input_pesquisa">
            <?include './usaveis/seletor.php';?>
        </div>
    </div>

    <?               
        $servicos = ServicoBanco::getServicos($empresa->getEmpresaId(), $usuario->getUsuarioId());

        $parametrosCheckbox = [];
        $nomeFiltro = "serviços";
        
        foreach($servicos as $servico){
            $parametro = new Parametro($servico->servicoId, $servico->servicoNome);
            $parametro->dados = $servico;
            array_push($parametrosCheckbox, $parametro);
        }

    ?>
</div>

<div class="segunda_linha_elementos">

    <label>Servicos</label>
    <div class="seletor">
        <input hidden id="servicos_selecionar" value='<?=json_encode($oportunidade->getServicos());?>'>
        <div class="input_pesquisa">
            <?include './usaveis/seletorCheckbox.php';?>
        </div>
    </div>

    <?               
        $tags = TagBanco::getTags($empresa->getEmpresaId(), $usuario->getUsuarioId());

        $parametrosCheckboxSecundario = [];
        $nomeFiltroSecundario = "tags";
        
        foreach($tags as $tag){
            $parametro = new Parametro($tag->tagId, $tag->tagNome);
            $parametro->dados = $tag;
            array_push($parametrosCheckboxSecundario, $parametro);
        }

    ?>

    <label>Tags</label>
    <div class="seletor">
        <input hidden id="tags_selecionar" value='<?=json_encode($oportunidade->getTags());?>'>
        <div class="input_pesquisa">
            <?include './usaveis/seletorCheckboxSecundario.php';?>
        </div>
    </div>

</div>
<div class="terceira_linha_elementos">
    <?
        $canaisVenda = CanalVendasBanco::getCanaisVendas($empresa->getEmpresaId());

        $valorInputPesquisa = $canalVenda->canalVendaNome;
        $inputId = "input_gerenciar_canal_venda";
        $listaId = "lista_gerenciar_canal_venda";
        $parametrosPesquisa = [];
        $placeHolderPesquisa = "canal de venda";
        
        foreach($canaisVenda as $canalVendaAtu){
            $parametro = new Parametro($canalVendaAtu->canalVendaId, $canalVendaAtu->canalVendaNome);
            $parametro->dados = $canalVendaAtu;
            array_push($parametrosPesquisa, $parametro);
        }
    ?>

    <label>Canal venda</label>

    <div class="seletor">
        <div class="input_pesquisa">
            <?include './usaveis/seletor.php';?>
        </div>
    </div>

    <?
    
        $valorInputPesquisa = $oportunidade->getCanalVenda()->compVendas->compVendaNome;
        $inputId = "input_gerenciar_comp_venda";
        $listaId = "lista_gerenciar_comp_venda";
        $parametrosPesquisa = [];
        $placeHolderPesquisa = "complemento de vendas";

        foreach($canalVendaComp->compVendas as $compVenda){
            $parametro = new Parametro($compVenda->compVendaId, $compVenda->compVendaNome);
            $parametro->dados = $compVenda;
            array_push($parametrosPesquisa, $parametro);
        }
    ?>

    <label>Comp. venda</label>
    <div class="seletor">
        <div class="input_pesquisa">
            <?include './usaveis/seletor.php';?>
        </div>
    </div>

    <label>Valor negoc.</label>
    <div class="seletor">
        <div class="input_pesquisa">
            <fieldset>
                <input type="number" id="valor_negociacao" step="0.01" value="<?=$oportunidade->getValorNegociacao();?>" placeHolder="Digite um valor...">
            </fieldset>
        </div>
    </div>
</div>