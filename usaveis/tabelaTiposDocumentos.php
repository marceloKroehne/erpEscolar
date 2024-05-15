<div class="info_documento">

<div class="topo">
    <div class="coluna1"></div>
    <div class="coluna2">
        <h1>Tipos de documentos</h1>
    </div>
    <div class="coluna3">
        <button id="novo_documento" >Novo tipo de documento</button>
    </div>
   
</div>

<div class="tabela">
    <table class="table table-striped" id="tabela_documento">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">
                    <div class="titulo_tabela">
                        Tipos de documentos
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?foreach($documentos as $documento):?>
                <tr>
                    <th scope="row"><?=$documento->getTipoDocumentoId();?></th>
                    <td data-value='<?=$documento->toJson();?>'>
                        <div class="nome_celula">
                            <?=$documento->getNome();?>
                        </div> 
                        <button>Editar</button>
                    </td>
                </tr>
            <?endforeach;?>
        </tbody> 
    </table>
</div>

</div>