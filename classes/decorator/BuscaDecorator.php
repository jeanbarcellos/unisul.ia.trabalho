<?php

/**
 * Classe BuscaDecorator
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 * @date 23/11/2017
 *
 * @package 
 */
class BuscaDecorator
{

    private $busca;
    
    private $numero = 0;

    public function __construct(Busca $busca)
    {
        $this->busca = $busca;
    }

    public function setBusca($numero)
    {
        $this->numero = $numero;
    }

    public function render()
    {
        $this->busca->executar();

        $carteiras = $this->busca->getCarteiras();
        $qtdIteracoes = $this->busca->getCarteirasSize();

        $retornoCarteiraInicial = $this->busca->getCarteiraInicial()->getRetornoCarteira();
        $retornoFormat = StringHelper::formatarDouble($retornoCarteiraInicial);

        $vetorInicialFormat = array_map("StringHelper::formatarPorcenagem", $this->busca->getVetorInicial());
        $vetorInicial2 = implode('%, ', $vetorInicialFormat);

        $retornoMelhorCarteira = $this->busca->getMelhorCarteira()->getRetornoCarteira();

        $tabela .= "<div class=\"busca-li\">";
        $tabela .= "<div class=\"row titulo\">Busca " . ($this->numero + 1) . "</div>";
        $tabela .= "
          <div class=\"row\">
            <span class=\"label\">Carteira Inicial:</span> 
            <span class=\"valor\">0 | $vetorInicial2% | Retorno anual: $retornoFormat</span>
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

        return $tabela;
    }

}
