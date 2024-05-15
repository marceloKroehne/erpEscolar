<a id="logo" href="index.php">INSTITUTO LIS</a>

<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle nome-usuario" id="dropDownUsuario" data-bs-toggle="dropdown" role="button" aria-expanded="false"><?=$usuario->getNome()." ";?></a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="configuracoes.php">Configurações</a></li>
        <?if($usuario->getCargo()->getPermissaoId() != 3 || $usuario->getCargo()->getPermissaoId() != 0):?>
            <li><a class="dropdown-item" href="movimentoCaixa.php">Movimento Caixa</a></li>
        <?endif;?>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="logout.php">Sair</a></li>
    </ul>
</div>