<?php

require_once 'classes/core/autoloader.php';

$porcent = array(1 => 0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);
$carteira = new Carteira($porcent);

$acaoADados = $carteira->getAcaoValores(1);
var_dump($acaoADados);

$retornoAnual = $carteira->getTotalAnualAcao();
var_dump($retornoAnual);

$invest = $carteira->getInvestimento();
var_dump($invest);

$retornoPorAcao = $carteira->getInvestimentoPorAcao();
var_dump($retornoPorAcao);

$investimentoAnual = $carteira->getRetornoAnual();
var_dump($investimentoAnual);
