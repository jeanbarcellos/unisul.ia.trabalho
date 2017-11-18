<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';


$vetorInicial = array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);
$carteira = new Carteira($vetorInicial);

// Valores da ação A
$acaoADados = $carteira->getValoresAcao(1);
var_dump($acaoADados);

$totalAnualAcaoA = $carteira->getTotalAnual(1);
var_dump($totalAnualAcaoA);

$retornoMensalAcaoA = $carteira->getRetornolMensal(1);
var_dump($retornoMensalAcaoA);

$investimentoAcaoA = $carteira->getInvestimentoAcao(1);
var_dump($investimentoAcaoA);

$retornoAnualAcaoA = $carteira->getRetornoAnual(1);
var_dump($retornoAnualAcaoA);

//$litaRetornoMensal = $carteira->getListaRetornoMensal();
//var_dump($litaRetornoMensal);
//
//$listaTotalAnual = $carteira->getListaTotalAnual();
//var_dump($listaTotalAnual);
//
//$investimento = $carteira->getInvestimento();
//var_dump($investimento);
//
//$listRetornoAnual = $carteira->getListaRetornoAnual();
//var_dump($listRetornoAnual);
//
//$retornoCarteira = $carteira->getRetornoCarteira();
//var_dump($retornoCarteira);
