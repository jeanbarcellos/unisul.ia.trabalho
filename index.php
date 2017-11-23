<?php

require_once 'classes/core/autoloader.php';

TesteDesempenho::inicio();

// Investimento inicial
$vetorInicial = array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);

// Aleatoriza o array;
if (isset($_GET['aleatorio'])) {
    shuffle($vetorInicial);
    $link_aleat = "aleatorio=1&";
}

// Escolhe a versão a ser exibida
$versao = 2;
$link_vers = "versao=1";
$label_vers = "Completa";
if ($_GET['versao'] == 1) {
    $versao = 1;
    $link_vers = "versao=2";
    $label_vers = "Compacta";
}

// BUSCA
$busca = new Busca($vetorInicial);

// Executa a busca pela melhor carteira
$busca->executar();

// Melhores carteiras encontradas
$carteiras = $busca->getCarteiras();

// Carteira Inicial
$decorator = new CarteiraDecorator($busca->getCarteiraInicial());

if ($versao == 1) {
    $tabela .= $decorator->render();
} else {
    $tabela .= $decorator->renderLight();
}


// Carteiras da Busca
foreach ($carteiras as $carteira) {

    $decorator = new CarteiraDecorator($carteira);

    if ($versao == 1) {
        $tabela .= $decorator->render();
    } else {
        $tabela .= $decorator->renderLight();
    }
}


$escolha = implode(',', $vetorInicial);

/*
 * Monta o HTM final
 */
$html = "
    <div id=\"nav\">
      <a href=\"index.php?inicial=1\">Inicial</a> | 
      <a href=\"index.php?aleatorio=1\">Busca Aleatoria</a> | 
      <a href=\"index.php?$link_aleat" . "$link_vers\">Versão $label_vers</a> |
      <a href=\"relatorio.php?acao=add&escolha=$escolha\">Add no relatório</a> | 
      <a href=\"relatorio.php?acao=ver\">Ver relatório</a> | 
    </div>
    $tabela
";

$replaces['body'] = $html;

/*
 * Lança seleciona o template e exibe
 */
$tpl = new Template('includes/template.html');
$tpl->setParams($replaces);
$tpl->show();


