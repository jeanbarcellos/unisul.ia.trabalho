<?php

/**
 * Classe Carteira
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 * @date 18/11/2017
 *
 * @package
 */
class Carteira
{

    /**
     * Dados da carteira
     * @var CarteiraDados
     */
    private $dao;

    /**
     * Vetor com o investimento
     * @var array
     */
    private $investimento;

    /**
     * Vetor com o total anual de cada ação
     * @var array
     */
    private $listaTotalAnual;

    /**
     * Retorno anual de cada ação calculada a partir do investimento
     * @var array
     */
    private $listaRetornoAnual;

    /**
     * Retorna o retorno mensal das 10 ações
     * @var array
     */
    private $listaRetornoMensal;

    /**
     * Retorno anual da carteira
     * @var float
     */
    private $retornoCarteira;

    /**
     * Carrega os dados
     */
    public function __construct(array $investimento)
    {
        $this->dao = CarteiraDados::getInstance();

        $this->setInvestimento($investimento);
    }

    /**
     * Define a porcentagem do investimento
     * 30%, 25%, 20%, 15%, 10%
     */
    public function setInvestimento(array $investimento)
    {
        if (count($investimento) != 10) {
            throw new Exception("Aguardando vetor com 10 posições");
        }

        // Corrige os indices
        $j = 1;
        $corrigido = array();
        foreach ($investimento as $valor) {
            $corrigido[$j] = $valor;
            $j++;
        }

        $this->investimento = $corrigido;

        $this->realizarCalculos();
    }

    /**
     * Realiza todos os cálculos necessários
     */
    private function realizarCalculos()
    {
        $this->calcularTotalAnualAcao();

        $this->calcularRetornoAnual();

        $this->calcularRetornoMensal();
    }

    /**
     * Calcula o total anual de cada ação (sem o investimento)
     */
    private function calcularTotalAnualAcao()
    {
        $qtd = $this->dao->getAcaoCount();

        $valores = $this->dao->getValores();

        $totalAnualAcao = array();

        for ($a = 1; $a <= $qtd; $a++) {
            $totalAnualAcao[$a] = 0;

            for ($m = 1; $m <= 12; $m++) {
                $valor = $valores[$a][$m];
                $totalAnualAcao[$a] = $totalAnualAcao[$a] + $valor;
            }
        }

        $this->listaTotalAnual = $totalAnualAcao;
    }

    /**
     * Realiza o cálculo do investimento
     */
    private function calcularRetornoAnual()
    {
        $totalAnualAcao = $this->listaTotalAnual;

        $investimento = $this->investimento;

        $qtd = $this->dao->getAcaoCount();

        $total = 0;
        $ret = array();

        for ($a = 1; $a <= $qtd; $a++) {
            $mesAp = $totalAnualAcao[$a] * $investimento[$a];
            $ret[$a] = $mesAp;
            $total = $total + $mesAp;
        }

        $this->listaRetornoAnual = $ret;
        $this->retornoCarteira = $total;
    }

    /**
     * Realiza o cálculo do retorno mensal de todas as ações aplicando o investimento
     */
    private function calcularRetornoMensal()
    {
        $valores = $this->dao->getValores();
        $investimento = $this->investimento;

        $retornos = array();
        $totalAnual = 0;
        for ($m = 1; $m <= 12; $m++) {
            $retornos[$m] = 0;
            for ($a = 1; $a <= 10; $a++) {
                $valor = $valores[$a][$m];
                $valorRetornoAcao = $valor * $investimento[$a];
                $valorRetornoMes = $retornos[$m] + $valorRetornoAcao;
                $retornos[$m] = $valorRetornoMes;
            }

            $totalAnual = $totalAnual + $retornos[$m];
        }

        $this->listaRetornoMensal = $retornos;
    }

    /**
     * Retorna o vetor com o investimento
     *
     * @return array
     */
    public function getInvestimento()
    {
        return $this->investimento;
    }

    /**
     * Retorna a matriz de dados com todas as ações
     * 
     * @return array
     */
    public function getValores()
    {
        return $this->dao->getValores();
    }

    /**
     * Retorna um vetor com os valores mensais de uma ação
     *
     * @param int $indice
     * @return Array
     */
    public function getValoresAcao($indice)
    {
        return $this->dao->getAcao($indice);
    }

    /**
     * Retorna um valor específco a parte do numero da ação e do mês informados
     * 
     * @param type $acao
     * @param type $mes
     */
    public function getValorAcaoMes($acao, $mes)
    {
        return $this->dao->getValorAcaoMes($acao, $mes);
    }

    /**
     * Retorna um vetor com os totais anuais de cada ação
     *
     * @return array
     */
    public function getListaTotalAnual()
    {
        return $this->listaTotalAnual;
    }

    /**
     * Retorna um vetor com os retornos das açoes
     * @return type
     */
    public function getListaRetornoAnual()
    {
        return $this->listaRetornoAnual;
    }

    /**
     * Retorna um vetor com retorno mensal
     *
     * @return array
     */
    public function getListaRetornoMensal()
    {
        return $this->listaRetornoMensal;
    }

    /**
     * Retorna o Retorno da Carteira
     *
     * @return float
     */
    public function getRetornoCarteira()
    {
        return $this->retornoCarteira;
    }

    /**
     * Retorna o total anual de uma ação através do índice informado
     * 
     * @param int $indice Índice da ação
     * @return float Total mensal da ação
     */
    public function getTotalAnual($indice)
    {
        return $this->listaTotalAnual[$indice];
    }

    /**
     * Retorna o retorno anual de um ação através do índice informado
     * 
     * @param int $indice Índice da ação
     * @return float Retorno anual da ação
     */
    public function getRetornoAnual($indice)
    {
        return $this->listaRetornoAnual[$indice];
    }

    /**
     * Retorna o retorno mensal através do índice de um mês
     * 
     * @param int $indice Índice do mês
     * @return float Retorno mensal
     */
    public function getRetornolMensal($indice)
    {
        return $this->listaRetornoMensal[$indice];
    }

    /**
     * Retorna o investimento realizado em cada aão
     * 
     * @param int $indice Índice da ação
     * @return float Porcentagem do investimento
     */
    public function getInvestimentoAcao($indice)
    {
        return $this->investimento[$indice];
    }

    public function getLabelAcaos()
    {
        return $this->dao->getLabelAcoes();
    }

    public function getLabelMeses()
    {
        return $this->dao->getLabelMeses();
    }

}
