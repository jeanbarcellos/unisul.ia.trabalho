<?php

require_once 'classes/core/autoloader.php';

TesteDesempenho::inicio();


$sessao = SessionRegistry::getInstance();

if ($_GET['acao'] == 'add' && $_GET['escolha'] != '') {

    $escolha = $_GET['escolha'];
    $vetorInicial = explode(",", $escolha);

    $cont = count($sessao->get('buscas'));

    $busca = new Busca($vetorInicial);

    // Corrigir depis
    $_SESSION['buscas'][$cont] = $busca;

    Javascript::Alerta('Busca adicionada ao relatório com sucesso');
    Javascript::Ir('/');
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

    $num = 0;
    foreach ($lista_buscas as $busca) {
        $num ++;

        // Executa a busca pela melhor carteira
        $busca->executar();

        $carteiras = $busca->getCarteiras();
        $qtdIteracoes = $busca->getCarteirasSize();
        
        $retornoCarteiraInicial = $busca->getCarteiraInicial()->getRetornoCarteira();
        $retornoFormat = StringHelper::formatarDouble($retornoCarteiraInicial);
        
        $vetorInicialFormat = array_map("StringHelper::formatarPorcenagem", $busca->getVetorInicial());
        $vetorInicial = implode('%, ', $vetorInicialFormat);

        $retornoMelhorCarteira = $busca->getMelhorCarteira()->getRetornoCarteira();

        $tabela .= "<div class=\"busca-li\">";
        $tabela .= "<div class=\"row titulo\">Busca $num</div>";
        $tabela .= "
          <div class=\"row\">
            <span class=\"label\">Carteira Inicial:</span> 
            <span class=\"valor\">$vetorInicial% | Retorno anual: $retornoFormat</span>
          </div>";
        $tabela .= "
          <div class=\"row\">
            <span class=\"label\">Iterações:</span> 
            <span class=\"valor\">
        ";

        // Carteiras da Busca
        $i = 0;
        foreach ($carteiras as $carteira) {
            $i++;

            $carteiraInvest = $carteira->getInvestimento();
            $carteiraInvestFormat = array_map("StringHelper::formatarPorcenagem", $carteiraInvest);
            $invest = implode('%, ', $carteiraInvestFormat);

            $retorno = StringHelper::formatarDouble($carteira->getRetornoCarteira());

            $tabela .= "" . $i . " | " . $invest . "% | Retorno Anual: " . $retorno . "<br>";
        }
        
        $tabela .= "\n</span></div>";        

        $tabela .= "
          <div class=\"row\">
            <span class=\"label\">Qtd iterações:</span> 
            <span class=\"valor\">$qtdIteracoes</span>
          </div>\n";
        $tabela .= "
          <div class=\"row\">
            <span class=\"label\">Melhor retorno:</span> 
            <span class=\"valor\">" . StringHelper::formatarDouble($retornoMelhorCarteira) . "</span>
          </div>\n";        
        
        $tabela .= "</div>";
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


//TesteDesempenho::fim();
