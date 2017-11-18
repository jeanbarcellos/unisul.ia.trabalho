<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';

$vetorInicial = array(1 => 0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);

$carteira = new Carteira($vetorInicial);
$retornoInicial = $carteira->getRetornoCarteira();

$vizinho = new Vizinho($vetorInicial);
$vizinhos = $vizinho->getVetorVizinhos();


$melhorVizinho = 0;
$melhorVizinhoInvest = array();

$busca = array();

foreach ($vizinhos as $vizinho) {

    $cart = new Carteira($vizinho);
    $rertornoCarteira = $cart->getRetornoCarteira();

    $rest['retorno'] = $rertornoCarteira;
    $rest['vizinho'] = $vizinho;
    $busca[] = $rest;
}

$indiceMaior = 0;
$valorMaior = 0;

foreach ($busca as $key => $valor) {
    $retorno = $valor['retorno'];
    
    if ($retorno > $valorMaior) {
        $indiceMaior = $key;
        $valorMaior = $retorno;
    }
}

var_dump($busca[$indiceMaior]);















//$busca = new Busca($carteira);
//
//$busca->busca1();











//$libVizinho = new Vizinho(array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0));
//
//$vizinhos = $libVizinho->getVetorVizinhos();
//for ($j = 0; $j < count($vizinhos); $j++) {
//    $html .= " " . $j . " = " . implode(' | ', $vizinhos[$j]) . "<br>";
//}
//
//echo "$html <br> ";