<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';

$vetorInicial = array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);

$carteira = new Carteira($vetorInicial);
//
//$retorno = $carteira->getRetornoCarteira();
//var_dump($retorno);
//
//$retorno = $carteira->getRetornolMensal(1);
//var_dump($retorno);
