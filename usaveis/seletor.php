<div id="pesquisa" class="seletor">
    <fieldset>
        <input autocomplete="off" value="<?=$valorInputPesquisa?>" role="combobox" list="" id="<?=$inputId;?>" name="input_pesquisa" placeholder="Pesquisar <?=$placeHolderPesquisa?>...">
        <datalist id="<?=$listaId;?>" role="listbox">
            <?foreach($parametrosPesquisa as $parametro): ?>
                <option value='<?=$parametro->toJson();?>'> <?=$parametro->getNome();?> </option>
            <?endforeach;?>
        </datalist>
    </fieldset>
    <?echo("<script> $(document).ready(function() { iniciarSeletor('".$inputId."','".$listaId."') }); </script>");?>
</div>