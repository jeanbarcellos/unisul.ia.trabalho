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
     * DAO da carteira
     * 
     * @var CarteiraDados 
     */
    private $dao;
    private $investimento;
    private $totalAnualAcao;
    
    private $retornoAnualPorAcao;    
    
    private $retornoAnual;

//    private $valores;
//    private $labelAcao;
//    private $labelMes;

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

        $this->investimento = $investimento;

        $this->realizarCalculos();
    }

    
    private function realizarCalculos()
    {
        $this->calcularTotalAnualPorAcao();
        
        $this->calcularInvestimento();
    }

    private function calcularTotalAnualPorAcao()
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

        $this->totalAnualAcao = $totalAnualAcao;
    }

    private function calcularInvestimento()
    {
        $totalAnualAcao = $this->totalAnualAcao;

        $investimento = $this->investimento;

        $qtd = $this->dao->getAcaoCount();

        $total = 0;
        $ret = array();

        for ($a = 1; $a <= $qtd; $a++) {
            $mesAp = $totalAnualAcao[$a] * $investimento[$a];
            $ret[$a] = $mesAp;
            $total = $total + $mesAp;
        }

        $this->retornoAnual = $total;
        $this->retornoAnualPorAcao = $ret;
    }

    
    public function getAcaoValores($indice){
        return $this->dao->getAcao($indice);        
    }
    
    public function getInvestimento()
    {
        return $this->investimento;
    }
    
    public function getTotalAnualAcao()
    {
        return $this->totalAnualAcao;
    }
    
    public function getInvestimentoPorAcao()
    {
        return $this->retornoAnualPorAcao;
    }

    public function getRetornoAnual()
    {
        return $this->retornoAnual;
    }



}
