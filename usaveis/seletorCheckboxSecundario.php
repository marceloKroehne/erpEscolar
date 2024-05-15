<div class="seletor">

    <fieldset>
    
        <input autocomplete="off" role="combobox" id="input_checkbox_secundario" list="" placeholder="Filtrar <?=$nomeFiltroSecundario?>...">
 
        <datalist id="datalist_checkbox_secundario" role="listbox">
            <? $paramtroTodosSecundario = new Parametro(0,"");?>
            <label for="todos_checkbox_secundario"> <input type="checkbox" value='<?=$paramtroTodosSecundario->toJson();?>' id="todos_checkbox_secundario"/> Todos</label>
            <?foreach($parametrosCheckboxSecundario as $parametro): ?>
                <label for="<?=$parametro->getNome();?>"> <input name="checkboxes_secundario[]" value='<?=$parametro->toJson();?>' type="checkbox" id="<?=$parametro->getNome();?>"/> <?=$parametro->getNome();?></label>
            <?endforeach;?>
        </datalist>

        <input type="hidden" id="input_envio_checkbox_secundario" name="input_envio_secundario" value="">

    </fieldset>


</div>
