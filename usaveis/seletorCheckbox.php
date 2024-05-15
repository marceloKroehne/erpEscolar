<div class="seletor">

    <fieldset>
    
        <input autocomplete="off" role="combobox" id="input_checkbox" list="" placeholder="Filtrar <?=$nomeFiltro?>...">

        <datalist id="datalist_checkbox" role="listbox">
            <?$paramtroTodos = new Parametro(0,"");?>
            <label for="todos_checkbox"> <input type="checkbox" id="todos_checkbox" value='<?=$paramtroTodos->toJson();?>'/> Todos</label>
            <?foreach($parametrosCheckbox as $parametro): ?>
                <label for="<?=$parametro->getNome();?>"> <input name="checkboxes[]" value='<?=$parametro->toJson();?>' type="checkbox" id="<?=$parametro->getNome();?>"/> <?=$parametro->getNome();?></label>
            <?endforeach;?>
        </datalist>

        <input type="hidden" id="input_envio_checkbox" name="input_envio" value="">

    </fieldset>


</div>
