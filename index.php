<?php

require_once 'classes/core/autoloader.php';

TesteDesempenho::inicio();

$vetorInicial = array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);


// Aleatoriza o array;
if (isset($_GET['aleatorio'])) {
    shuffle($vetorInicial);
}


// BUSCA
$busca = new Busca($vetorInicial);

$busca->executar();

$carteiras = $busca->getCarteiras();

foreach ($carteiras as $cart) {
    $inves = $cart->getInvestimento();
    $retorno = $cart->getRetornoCarteira();
    $html .= "Investimento " . implode(' | ', $inves) . " | Retorno: " . $retorno . "<br>";
}

echo "
    $html
    <a href=\"?aleatorio=1\">Aleatório</a> | <a href=\"?\">Inicial</a>
";


TesteDesempenho::fim();

