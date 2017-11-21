<?php

require_once 'classes/core/autoloader.php';

TesteDesempenho::inicio();

$vetorInicial = array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);


// Aleatoriza o array;
if (isset($_GET['aleatorio'])) {
    shuffle($vetorInicial);
    $link_aleat = "aleatorio=1&";
}

// Escolhe a versão a ser exibida
$versao = 2;
$link_vers = "versao=1";
if (isset($_GET['versao'])) {
    $versao = 1;
    $link_vers = "versao=2";
}

// BUSCA
$busca = new Busca($vetorInicial);

// Executa a busca pela melhor carteira
$busca->executar();

// Melhores carteiras encontradas
$carteiras = $busca->getCarteiras();

foreach ($carteiras as $carteira) {

    $decorator = new CarteiraDecorator($carteira);

    if ($versao == 1) {
        $tabela .= $decorator->render();
    } else {
        $tabela .= $decorator->renderLight();
    }
}


$css = "
    <style>
    body, td ,th, input, select, option, textarea {
        font-family: courier, Arial, Helvetica, sans-serif;
        font-size: 14px;
        line-height: 1.25em;
    }
    table {border-collapse:collapse; border-spacing:0; margin-bottom: 20px;}
    th, td, caption {font-weight:normal; vertical-align:top; text-align:left}
    td, th { border: 1px solid #111; padding: 2px 5px}
    th {text-align:center; background:#adc8ff; font-weight:bold;}
    td {text-align:right}
    </style>
    <br>
";

$html = "
    $css
    $tabela
    <a href=\"?aleatorio=1\">Aleatório</a> | <a href=\"?\">Inicial</a> | <a href=\"?$link_aleat&$link_vers\">Versão</a>
";

echo $html;


TesteDesempenho::fim();

