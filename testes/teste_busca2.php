<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';

//TesteDesempenho::inicio();

$vetorInicial = array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);

$busca = new Busca($vetorInicial);
$busca->executar();
$carteiras = $busca->getCarteiras();

foreach ($carteiras as $cart) {
    $inves = $cart->getInvestimento();
    $retorno = $cart->getRetornoCarteira();

    $html .= "Investimento " . implode(' | ', $inves) . " | Retorno: " . $retorno . "<br>";
}

echo $html;


//$memoria = $busca->getMemoria();
//var_dump($memoria);


//$melhorVizinho = $busca->melhorVizinho();
//
//$carteiras = $busca->getCarteiras();
//var_dump($carteiras);
//

//$memoria = $busca->getMemoria();
//
//foreach ($carteiras as $cart) {
////    var_dump($inves);
//    $inves = $cart->getInvestimento();
//    $html = " " . implode(' | ', $inves) . "<br>";
//    echo $html;
//}

//var_dump($melhorVizinho);
