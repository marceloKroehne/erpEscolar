<?php

function conferirErros($senha, $repitaSenha){

    $retorno = new RetornoSql();

    $retorno->houveErro = true;

    if(strlen($senha) < 6){
        $retorno->mensagem =  'A senha deve conter pelo menos 6 carcteres!';
    }
    else if($senha != $repitaSenha){
        $retorno->mensagem = 'As senhas digitadas não correspondem!';
    }
    else{
        $retorno->houveErro = false;
    }


    return $retorno;
}

function conferirNome($nomeUsuario){

    $retorno = new RetornoSql();

    if(strlen($nomeUsuario) < 3){
        $retorno->houveErro = true;
        $retorno->mensagem = 'O nome de Usuário deve conter no mínimo 3 letras!';
    }

    return $retorno;
}

function processarOFX($conteudo_ofx, $empresaId) {

    preg_match('/<BANKID>(.*?)\r\n/s', $conteudo_ofx, $bankid);
    preg_match('/<BRANCHID>(.*?)\r\n/s', $conteudo_ofx, $branchid);
    preg_match('/<ACCTID>(.*?)\r\n/s', $conteudo_ofx, $acctid);

    preg_match_all('/<STMTTRN>(.*?)<\/STMTTRN>/s', $conteudo_ofx, $movimentos);

    $lista_movimentos = [];
    
    foreach ($movimentos[1] as $movimento) {
        preg_match('/<FITID>(.*?)\r\n/s', $movimento, $fitid);
        preg_match('/<DTPOSTED>(.*?)\r\n/s', $movimento, $dtposted);
        preg_match('/<TRNAMT>(.*?)\r\n/s', $movimento, $trnamt);
        preg_match('/<MEMO>(.*?)\r\n/s', $movimento, $memo);

        $ano = substr($dtposted[1], 0, 4);
        $mes = substr($dtposted[1], 4, 2);
        $dia = substr($dtposted[1], 6, 2);

        $timestamp = strtotime("$ano-$mes-$dia");

        $data_formatada = date("d/m/Y", $timestamp);

        $conta = ContasBancoBanco::getConta($bankid[1], $branchid[1], $acctid[1]);

        if($conta === null){
            $conta = new Conta(new Banco(null, $bankid[1], null, null, true, true), $branchid[1], $acctid[1], true);
        }

        $movimentoDuplicado = MovimentoBanco::isMovimentoDuplicado($fitid[1], $empresaId);

        if($movimentoDuplicado != null){
            $objeto_movimento = $movimentoDuplicado; 
            $objeto_movimento->setDuplicado(true);
        }
        else{
            $objeto_movimento = new Movimento(
                0,
                $empresaId,
                $conta,
                new Subconta(null, new GrupoContas(null, null, null, null, null), null, null, null),
                $trnamt[1],
                $data_formatada,
                $memo[1],
                null,
                null,
                new TipoDocumento(null, null, null, null),
                $fitid[1]
            );
        }
        array_push($lista_movimentos, $objeto_movimento->toJson());
    }

    return $lista_movimentos;
}



?>
