<div class="menu">
    <ul>
        <h6>Cadastro de funcionários</h6>
        <li><a href="configuracoes.php">Meus dados</a></li>
        <?if($usuario->getCargo()->getPermissaoId() === 3):?>
            <li><a href="cadastroUsuarios.php">Cadastro funcionários</a></li>
            <li><a href="gerenciarCargos.php">Cargos</a></li>
            <li><a href="tipoPagamentos.php">Tipos de pagamento</a></li>
            <h6>Cadastro de curso</h6>
            <li><a href="gerenciarCursos.php">Cursos</a></li>
            <li><a href="matrizesCurriculares.php">Matrizes curriculares</a></li>
            <li><a href="tipoCursos.php">Tipos de cursos</a></li>
            <h6>Cadastro de turmas</h6>
            <li><a href="gerenciarModalidades.php">Modalidades</a></li>
            <li><a href="gerenciarSalas.php">Salas</a></li>
            <li><a href="situacaoTurma.php">Situações de turmas</a></li>
            <li><a href="gerenciarTurmas.php">Turmas</a></li>
            <li><a href="gerenciarTurnos.php">Turnos</a></li>
            <h6>Cadastro de alunos</h6>
            <li><a href="cadastroAlunos.php">Cadastro alunos</a></li>
        <?endif;?>
        <?if($usuario->getCargo()->getPermissaoId() === 3 || $usuario->getCargo()->getPermissaoId() === 0):?>
            <h6>Cadastro de caixa</h6>
            <li><a href="gerenciarBancos.php">Bancos</a></li>
            <li><a href="gerenciarGruposContas.php">Grupos de contas</a></li>
            <li><a href="tiposDocumentos.php">Tipos de documentos</a></li>
        <?endif;?>
        
    </ul>
</div>  