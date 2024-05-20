<?    

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=movimentacao_financeira.csv');

require("./requires.php");
require("./objetos/grupoContas.php");
require("./objetos/subconta.php");
require("./objetos/movimento.php");
require("./objetos/tipoDocumento.php");

if(!($usuario->getPermissaoId() == 3 || $usuario->getPermissaoId() == 0)){
    header('Location: movimentoCaixa.php');
}


if(isset($_POST['movimentos_exportar'])){

    $planilha = fopen("php://output", "w");
    $cabecalho = [
        'MOVIMENTO_ID',
        'NUMERO_MOVIMENTO',
        'DATA',
        'BANCO_ID',
        'AGENCIA',
        'NUMERO_CONTA',
        'NOME_BANCO',
        'HISTORICO',
        'GRUPO_CONTAS',
        'SUBCONTA',
        'TIPO_DOCUMENTO_ID',
        'NOME_DOCUMENTO_ID',
        'ENTRADA',
        'SAIDA',
        'OBSERVACAO',
        'TOTAL_ENTRADA',
        'TOTAL_SAIDA',
        'SALDO'
    ];

    fputcsv($planilha, $cabecalho,";");

    $totalEntrada = 0;
    $totalSaida = 0;

    foreach(json_decode($_POST['movimentos_exportar']) as $movimento){
        $mov = json_decode($movimento);

        $colunas = [
            $mov->movimentoId,
            $mov->numeroMovimento,
            $mov->dataLancamento,
            $mov->subcontaEntrada->conta->banco->bancoId,
            $mov->subcontaEntrada->conta->agencia,
            $mov->subcontaEntrada->conta->numeroConta,
            $mov->subcontaEntrada->conta->banco->nome,
            $mov->historico,
            $mov->subcontaEntrada->grupoConta->nome,
            $mov->subcontaEntrada->nome,
            $mov->tipoDocumento->tipoDocumentoId,
            $mov->tipoDocumento->nome,
            $mov->valor,
            0,
            $mov->observacao
        ];

        $colunas2 = [
            $mov->movimentoId,
            $mov->numeroMovimento,
            $mov->dataLancamento,
            $mov->subcontaSaida->conta->banco->bancoId,
            $mov->subcontaSaida->conta->agencia,
            $mov->subcontaSaida->conta->numeroConta,
            $mov->subcontaSaida->conta->banco->nome,
            $mov->historico,
            $mov->subcontaSaida->grupoConta->nome,
            $mov->subcontaSaida->nome,
            $mov->tipoDocumento->tipoDocumentoId,
            $mov->tipoDocumento->nome,
            0,
            $mov->valor,
            $mov->observacao
        ];


        $totalEntrada = $totalEntrada + $mov->valor;

        $totalSaida = $totalSaida + $mov->valor;
        

        fputcsv($planilha, $colunas,";");
        fputcsv($planilha, $colunas2,";");

    }

    $rodape = [
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $totalEntrada,
        $totalSaida,
        $totalEntrada - $totalSaida
    ];
    
    fputcsv($planilha, $rodape,";");

    fclose($planilha);

    header("movimentoCaixa.php");
}






?>