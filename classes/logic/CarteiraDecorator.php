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

    public function showFull()
    {
        
    }

    public function show()
    {
        echo $this->render();
    }

    public function render()
    {
        $thml = "<table>";
        $thml .= $this->montarCab();
        $thml .= $this->montarDados();
        $thml .= $this->montarEscolha();
        $thml .= $this->montarTotalMes();
        $thml .= $this->montarRetornoAnual();
        $thml .= "</table>";
        return $thml;
    }

    public function renderLight()
    {
        $thml = "<table>";
        $thml .= $this->montarCab();
        $thml .= $this->montarTotalMes();
        $thml .= $this->montarEscolha();
        $thml .= $this->montarRetornoAnual();
        $thml .= "</table>";
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

            $html .= "<td><b>" . StringHelper::formatarDouble($retornoMes) . "</b></td>";

            $html .= "</tr>";
        }

        return $html;
    }

    private function montarEscolha()
    {
        $retornoCarteira = $this->carteira->getRetornoCarteira();

        $html .= "<tr>";
        $html .= "<td>Escolha</td>";
        for ($a = 1; $a <= 10; $a++) {
            $invest = $this->carteira->getInvestimentoAcao($a);
            $html .= "<td><b>" . StringHelper::formatarPorcenagem($invest) . "%</b></td>";
        }
        $html .= "<td style=\"background: #CCC; font-weight:bold; color: blue\">" . StringHelper::formatarDouble($retornoCarteira) . "</td>";
        $html .= "</tr>";

        return $html;
    }

    private function montarTotalMes()
    {

        $html .= "<tr>";
        $html .= "<td>TotalMês</td>";
        for ($a = 1; $a <= 10; $a++) {
            $totalAnualAcao = $this->carteira->getTotalAnual($a);
            $html .= "<td>" . StringHelper::formatarDouble($totalAnualAcao) . " </td>";
        }
        $html .= "<td></td>";
        $html .= "</tr>";

        return $html;
    }

    private function montarRetornoAnual()
    {
        $retornoCarteira = $this->carteira->getRetornoCarteira();

        $html .= "<tr>";
        $html .= "<td>Retorno Ação</td>";
        for ($a = 1; $a <= 10; $a++) {
            $retornoAno = $this->carteira->getRetornoAnual($a);

            $html .= "<td>" . StringHelper::formatarDouble($retornoAno) . " </td>";
        }
        $html .= "<td style=\"background: #CCC; font-weight:bold; color: blue\">" . StringHelper::formatarDouble($retornoCarteira) . "</td>";
        $html .= "</tr>";

        return $html;
    }

}
