<?php

//require_once "../classes/core/autoloader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';

$dao = CarteiraDados::getInstance();

//// testar recuperação dos dados;
//$dados = $dao->getValores();
////var_dump($dados);

//// testa a recuperação dos meses
//$labelMeses = $dao->getLabelMeses();
//var_dump($labelMeses);
//
//// Acoes
//$labelAcoes = $dao->getLabelAcoes();
//var_dump($labelAcoes);
//
//$mes2 = $dao->getMes(2);
//var_dump($mes2);
//
//// Adados da ação 1
//$acaoA = $dao->getAcao(1);
//var_dump($acaoA);
//
//// Total Ação 1
//$acaoATotalAnual = $dao->getTotalAnualAcao(1);
//var_dump($acaoATotalAnual);