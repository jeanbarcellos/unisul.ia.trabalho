<?php

require_once 'classes/core/autoloader.php';

TesteDesempenho::inicio();


$sessao = SessionRegistry::getInstance();

if ($_GET['acao'] == 'add' && $_GET['escolha'] != '') {

    $escolha = $_GET['escolha'];
    $vetorInicial = explode(",", $escolha);

    $cont = count($sessao->get('buscas'));

    $busca = new Busca($vetorInicial);

    $decorator = new BuscaDecorator($busca);
    $decorator->setBusca($cont);   
    $tabela = $decorator->render();

    $_SESSION['buscas'][$cont] = $tabela;

        // Aleatoriza o array;
    if (isset($_GET['aleatorio'])) {
        shuffle($vetorInicial);
        $link_aleat = "&aleatorio=1";
    }
    
    Javascript::Ir('/index.php?msg=Busca adicionada ao relatório com sucesso' . $link_aleat);
    exit;
}

if ($_GET['acao'] == 'limpar') {
    $sessao->removeAll();
    Javascript::Ir('/');
    exit;
}

if ($_GET['acao'] == 'ver') {

    $cont = count($sessao->get('buscas'));

    $lista_buscas = $sessao->get('buscas');

    $tabela .= "<div class=\"relatorio\">";

    if ($cont > 0) {
        foreach ($lista_buscas as $busca) {
            $tabela .= $busca;
        }
    }
    
    $tabela .= "</div>";
}



$html = "
    <div id=\"nav\">
      <a href=\"index.php?inicial=1\">Inicial</a> | 
      <a href=\"index.php?aleatorio=1\">Busca Aleatoria</a> | 
      <a href=\"relatorio.php?acao=limpar\">Limpar Relatório</a> | 
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


TesteDesempenho::fim();

