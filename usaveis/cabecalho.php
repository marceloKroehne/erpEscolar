<a id="logo" href="index.php">INSTITUTO LIS</a>

<div class="menus_selecionar">
    
    <a class="item_menu" href="movimentoCaixa.php">Movimento de caixa</a>
    <a class="item_menu" href="gerenciarParcelas.php">Lançar pagamentos</a>

    <div class="nav-item dropdown">
        
        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">Cadastros</a>
        <ul class="dropdown-menu dropdown-menu-start">
            <li class="nav-item dropdown dropend">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Cadastro de turmas
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="gerenciarModalidades.php">Modalidades</a></li>
                    <li><a class="dropdown-item" href="gerenciarSalas.php">Salas</a></li>
                    <li><a class="dropdown-item" href="situacaoTurma.php">Situações de turmas</a></li>
                    <li><a class="dropdown-item" href="gerenciarTurmas.php">Turmas</a></li>
                    <li><a class="dropdown-item" href="gerenciarTurnos.php">Turnos</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">Cadastro de cursos</a>
                <ul class="dropdown-menu dropdown-menu-start">
                    <li><a class="dropdown-item" href="gerenciarCursos.php">Cursos</a></li>
                    <li><a class="dropdown-item" href="matrizesCurriculares.php">Matrizes curriculares</a></li>
                    <li><a class="dropdown-item" href="gerenciarPlanoCursos.php">Planos de cursos</a></li>
                    <li><a class="dropdown-item" href="tipoCursos.php">Tipos de cursos</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">Cadastro de alunos</a>
                <ul class="dropdown-menu dropdown-menu-start">
                    <li><a class="dropdown-item"  href="cadastroAlunos.php">Alunos</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">Cadastro de contratos</a>
                <ul class="dropdown-menu dropdown-menu-start">
                <li><a class="dropdown-item" href="gerenciarContratos.php">Contratos</a></li>
                    <li><a class="dropdown-item" href="situacaoContratos.php">Situações de contratos</a></li>
                    <li><a class="dropdown-item" href="tipoContratos.php">Tipo de contratos</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">Cadastro de funcionários</a>
                <ul class="dropdown-menu dropdown-menu-start">
                    <li><a class="dropdown-item" href="cadastroUsuarios.php">Cadastro funcionários</a></li>
                    <li><a class="dropdown-item" href="gerenciarCargos.php">Cargos</a></li>
                    <li><a class="dropdown-item" href="tipoPagamentos.php">Tipos de pagamento</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown dropend">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false">Cadastro financeiro</a>
                <ul class="dropdown-menu dropdown-menu-start">
                    <li><a class="dropdown-item" href="gerenciarBancos.php">Bancos</a></li>
                    <li><a class="dropdown-item" href="gerenciarGruposContas.php">Grupos de contas</a></li>
                    <li><a class="dropdown-item" href="tiposDocumentos.php">Tipos de documentos</a></li>
                </ul>
            </li>
        </ul>
    </div>

</div>

<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle nome-usuario" id="dropDownUsuario" data-bs-toggle="dropdown" role="button" aria-expanded="false"><?=$usuario->getNome()." ";?></a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="configuracoes.php">Meus dados</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="logout.php">Sair</a></li>
    </ul>
</div>

