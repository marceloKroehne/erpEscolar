<?

if($destino != "cadastro.php"){
    $cargos = CargosBanco::getCargosEmpresa($empresa->getEmpresaId());
    $pagamentos = TipoPagamentoBanco::getTipoPagamentos($empresa->getEmpresaId());
    $bancos = BancoBanco::getBancos($empresa->getEmpresaId());
}
?>

<br>
<form action="<?echo $destino?>" method="post">
    
    <?if($destino === "cadastro.php" || $usuario->getCargo()->getPermissaoId() === 3):?>
        <div id="info_empresa">
            
            <h2 id="titulo_empresa">Informações da Empresa</h2>
            <label for="nome_razao_social">Nome/Razão Social:</label>
            <input type="text" id="nome_razao_social" name="nome_razao_social" required>
            <br>
            <label for="empresa_email">E-mail:</label>
            <input type="email" id="empresa_email" name="empresa_email" required>
            <br>
            <label for="cpf_cnpj">CPF/CNPJ:</label>
            <input type="text" id="cpf_cnpj" name="cpf_cnpj" required>
            <br>
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" required>
            <br>
            <label for="logradouro">Logradouro:</label>
            <input type="text" id="logradouro" name="logradouro" required>
            <br>
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" required>
            <br>
            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento">
            <br>
            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" required>
            <br>
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required>
            <br>
            <label for="uf">UF:</label>
            <input type="text" id="uf" name="uf" pattern="[a-zA-Z]{2}" required>
            <br>
            <label for="telefone_empresa">Telefone:</label>
            <input type="tel" id="telefone_empresa" name="telefone_empresa" required>
            <br>

            <input type="text" id="empresa_id" value="0" name="empresa_id" hidden>
        </div>
    <?endif;?>
    <br>
    <h2 id="titulo_usuario">Informações do Representante</h2>
    <label for="usuario_nome">Nome:</label>
    <input type="text" id="usuario_nome" name="usuario_nome" required>

    <?if($destino == "cadastroUsuarios.php" || $destino == "cadastroAlunos.php" ): ?>
        <div id="usuario_status">
            <label for="situacao">Situação:</label>
            <div>
                <label for="ativo">Ativo</label>
                <input type="radio" id="ativo" name="situacao_usuario" value="1" checked>
                <label for="inativo">Inativo</label>
                <input type="radio" id="inativo" name="situacao_usuario" value="0">
            </div>
        </div>
    <?endif;?>
    <?if($destino == "cadastroUsuarios.php"): ?>

        <label id="lb_cargo_id" for="cargo_id">Cargo:</label>
        <select id="cargo_id" name="cargo_id">
            <?foreach($cargos as $cargo): ?>
                <option value="<?=$cargo->getCargoId();?>"><?=$cargo->getNome();?></option>
            <?endforeach;?>
        </select>

        <div class="cargo_prof_ate">
            <label for="cargo_professor">Professor: </label>
            <input type="checkbox" id="cargo_professor" name="cargo_professor">
            <label for="cargo_atendente">Atendente: </label>
            <input type="checkbox" id="cargo_atendente" name="cargo_atendente">
        </div>

        <label id="lb_pagamento_id" for="pagamento_id">Tipo pagamento:</label>
        <select id="pagamento_id" name="pagamento_id">
            <?foreach($pagamentos as $pagamento): ?>
                <option value="<?=$pagamento->getTipoPagamentoId();?>"><?=$pagamento->getNome();?></option>
            <?endforeach;?>
        </select>
        <?

        $inputId = "input_gerenciar_banco";
        $listaId = "lista_gerenciar_banco";

        $parametrosPesquisa = [];
        $placeHolderPesquisa = "Bancos";

        foreach($bancos as $banco){
            if(!$banco->isAtivo()){
                continue;
            }
            $parametro = new Parametro($banco->getBancoId(), $banco->getNome());
            $parametro->dados = json_decode($banco->toJson());
            array_push($parametrosPesquisa, $parametro);
        }

        ?>
        <label id="lb_banco">Banco:</label>
        <div class="bloco_pesquisa">
            <div class="input_pesquisa">
                <?require('./usaveis/seletor.php');?>
            </div>
        </div>

        <input hidden value='0' id="banco_id">

        <label id="lb_agencia" for="agencia">Agência:</label>
        <input id="agencia" name="agencia">

        <label id="lb_numero_conta" for="numero_conta">Numero conta:</label>
        <input id="numero_conta" name="numero_conta">

        <label id="lb_pix" for="pix">Pix:</label>
        <input id="pix" name="pix">

    
        <label id="lb_tipo_pix" for="tipo_pix">Tipo chave pix:</label>
        <select id="tipo_pix" name="tipo_pix">
            <option id="chave_email" value="0">Email</option>
            <option id="chave_cpf_cnpj" value="1">Cpf ou Cnpj</option>
            <option id="chave_celular" value="2">Celular</option>
            <option id="chave_aleatoria" value="3">Chave aleatória</option>
        </select>
    <?endif;?>
    <label for="email_usuario">E-mail:</label>
    <input type="email" id="email_usuario" name="email_usuario" required>

    <label for="cpf_usuario">CPF:</label>
    <input type="text" id="cpf_usuario" name="cpf_usuario" required>
    <br>
    <label for="rg_usuario">RG:</label>
    <input type="text" id="rg_usuario" name="rg_usuario" required>
    <br>
    <label for="telefone_usuario">Telefone:</label>
    <input type="tel" id="telefone_usuario" name="telefone_usuario" required>
    <br>
    <label for="cep_usuario">CEP:</label>
    <input type="text" id="cep_usuario" name="cep_usuario" required>
    <br>
    <label for="logradouro_usuario">Logradouro:</label>
    <input type="text" id="logradouro_usuario" name="logradouro_usuario" required>
    <br>
    <label for="numero_usuario">Número:</label>
    <input type="text" id="numero_usuario" name="numero_usuario" required>
    <br>
    <label for="complemento">Complemento:</label>
    <input type="text" id="complemento_usuario" name="complemento_usuario">
    <br>
    <label for="bairro_usuario">Bairro:</label>
    <input type="text" id="bairro_usuario" name="bairro_usuario" required>
    <br>
    <label for="cidade_usuario">Cidade:</label>
    <input type="text" id="cidade_usuario" name="cidade_usuario" required>
    <br>
    <label for="uf_usuario">UF:</label>
    <input type="text" id="uf_usuario" name="uf_usuario" pattern="[a-zA-Z]{2}" required>
    <br>
    <?if($destino != "cadastroAlunos.php"): ?>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>

        <label for="confirmar_senha">Repita a Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required>
        <button type="button" id="botao_trocar_senha" style="display: none;">Trocar senha</button>
        <input type="text" id="update_senha" name="update_senha" value="false" hidden>
        <input type="text" id="funcionario_id" value="0" name="funcionario_id" hidden>
        <br>
    <?else:?>
        <label for="matricula_aluno">Matricula aluno:</label>
        <input type="text" id="matricula_aluno" name="matricula_aluno" required>
        <input type="text" id="aluno_id" value="0" name="aluno_id" hidden>
    <?endif;?>

    <input type="text" id="usuario_id" value="0" name="usuario_id" hidden>

    <button type="submit" id="botao_formulario">Cadastre-se</button>
    <br>
</form>