<?    

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=movimentacao_financeira.csv');

require("./requires.php");
require("./objetos/grupoContas.php");
require("./objetos/subconta.php");
require("./objetos/movimento.php");
require("./objetos/tipoDocumento.php");

if(!($usuario->getCargo()->getPermissaoId() == 3 || $usuario->getCargo()->getPermissaoId() == 0)){
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
            $mov->conta->banco->bancoId,
            $mov->conta->agencia,
            $mov->conta->numeroConta,
            $mov->conta->banco->nome,
            $mov->historico,
            $mov->subconta->grupoConta->nome,
            $mov->subconta->nome,
            $mov->tipoDocumento->tipoDocumentoId,
            $mov->tipoDocumento->nome,
            $mov->subconta->tipo == 0 ? $mov->valor : 0,
            $mov->subconta->tipo == 1 ? $mov->valor : 0,
            $mov->observacao
        ];

        if($mov->subconta->tipo == 0){
            $totalEntrada = $totalEntrada + $mov->valor;
        }
        else if($mov->subconta->tipo == 1){
            $totalSaida = $totalSaida + $mov->valor;
        }

        fputcsv($planilha, $colunas,";");

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