<?php

/**
 * Classe CarteiraDecorator
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 * @date 21/11/2017
 *
 * @package 
 */
class CarteiraDecorator
{

    /**
     *
     * @var Carteira 
     */
    private $carteira;

    /**
     * Versao de exibição
     * 1 para completa
     * 2 para somente retornos
     * @var type 
     */
    private $versao = 1;

    public function __construct($carteira)
    {
        $this->carteira = $carteira;
    }

    public function showLight()
    {
        echo $this->render();
    }

    public function show()
    {
        echo $this->render();
    }

    public function render()
    {
        $thml = "<table class=\"carteira\">";
        $thml .= $this->montarCab();
        $thml .= $this->montarDados();
        $thml .= $this->montarEscolha();
        $thml .= $this->montarTotalAnual();
        $thml .= $this->montarRetornoAnual();
        $thml .= "</table>";
        return $thml;
    }

    public function renderLight()
    {
        $thml = "<table class=\"carteira light\">";
        $thml .= $this->montarCab();
        $thml .= $this->montarTotalAnual();
        $thml .= $this->montarEscolha();
        $thml .= $this->montarRetornoAnual();
        $thml .= "</table>";
        return $thml;
    }

    public function renderRelatorio()
    {
        $thml = "Relatório";
        return $thml;
    }

    private function montarCab()
    {
        $labelAcoes = $this->carteira->getLabelAcaos();

        $html = "<tr>";
        $html .= "<th>Mês</th>";
        for ($a = 1; $a <= 10; $a++) {
            $html .= "<th>Ação " . $labelAcoes[$a] . "</th>";
        }
        $html .= "<th>Retorno mes</th>";
        $html .= "</tr>";

        return $html;
    }

    private function montarDados()
    {
        $html = "";

        for ($m = 1; $m <= 12; $m++) {
            $html .= "<tr>";

            $html .= "<td>" . $m . "</td>";

            for ($a = 1; $a <= 10; $a++) {
                $valor = $this->carteira->getValorAcaoMes($a, $m);
                $valorFormat = StringHelper::formatarDouble($valor);

                // Saída
                $html .= "<td>" . $valorFormat . "</td>";
            }

            $retornoMes = $this->carteira->getRetornolMensal($m);

            $html .= "<td class=\"row-retorno-mensal\"><b>" . StringHelper::formatarDouble($retornoMes) . "</b></td>";

            $html .= "</tr>";
        }

        return $html;
    }

    private function montarEscolha()
    {
//        $retornoCarteira = $this->carteira->getRetornoCarteira();

        $html .= "<tr class=\"row-investimento\">";
        $html .= "<td>Escolha</td>";
        for ($a = 1; $a <= 10; $a++) {
            $invest = $this->carteira->getInvestimentoAcao($a);
            $html .= "<td>" . StringHelper::formatarPorcenagem($invest) . "%</td>";
        }
        $html .= "<td class=\"col-resul\">100%</td>";
        $html .= "</tr>";

        return $html;
    }

    private function montarTotalAnual()
    {

        $html .= "<tr class=\"row-total-anual\">";
        $html .= "<td>Soma Mêses</td>";
        for ($a = 1; $a <= 10; $a++) {
            $totalAnualAcao = $this->carteira->getTotalAnual($a);
            $html .= "<td>" . StringHelper::formatarDouble($totalAnualAcao) . " </td>";
        }
        $html .= "<td class=\"col-resul\"></td>";
        $html .= "</tr>";

        return $html;
    }

    private function montarRetornoAnual()
    {
        $retornoCarteira = $this->carteira->getRetornoCarteira();

        $html .= "<tr class=\"row-retorno\">";
        $html .= "<td>Retorno Ação</td>";
        for ($a = 1; $a <= 10; $a++) {
            $retornoAno = $this->carteira->getRetornoAnual($a);

            $html .= "<td>" . StringHelper::formatarDouble($retornoAno) . " </td>";
        }
        $html .= "<td class=\"cell-retorno-carteira\">" . StringHelper::formatarDouble($retornoCarteira) . "</td>";
        $html .= "</tr>";

        return $html;
    }

}

/*
style=\"background: #CCC; font-weight:bold; color: blue\"

*/