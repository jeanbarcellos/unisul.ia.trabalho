<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';

//TesteDesempenho::inicio();

$vetorInicial = array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);

$carteira = new Carteira($vetorInicial);
//$retornoInicial = $carteira->getRetornoCarteira();


$memoria = array();

$vizinho = new Vizinho($vetorInicial);
$vizinhos = $vizinho->getVetorVizinhos();

foreach ($vizinhos as $vizinho) {
    $cart = new Carteira($vizinho);
    $rest['vizinho'] = $vizinho;
    $rest['retornoAcao'] = $cart->getListaRetornoAnual();
    $rest['retornoCarteira'] = $cart->getRetornoCarteira();
    $memoria[] = $rest;
}


$indiceMaior = 0;
$valorMaior = 0;

foreach ($memoria as $key => $valor) {
    $retorno = $valor['retornoCarteira'];
    
    if ($retorno > $valorMaior) {
        $indiceMaior = $key;
        $valorMaior = $retorno;
    }
}

//var_dump($memoria);
var_dump($memoria[$indiceMaior]);















//$busca = new Busca($carteira);
//
//$busca->busca1();







//TesteDesempenho::fim();



//$libVizinho = new Vizinho(array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0));
//
//$vizinhos = $libVizinho->getVetorVizinhos();
//for ($j = 0; $j < count($vizinhos); $j++) {
//    $html .= " " . $j . " = " . implode(' | ', $vizinhos[$j]) . "<br>";
//}
//
//echo "$html <br> ";