<?php

/**
 * Classe Busca
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 * @date 18/11/2017
 *
 * @package 
 */
class Busca
{

    /**
     * Carteira Inicial para a busba
     * @var Carteira 
     */
    private $carteiraInicial;
    
    private $investimento;
    
    private $vizinho;

    public function __construct($carteiraInicial)
    {
        $this->carteiraInicial = $carteiraInicial;
        
        $this->investimento = $this->carteiraInicial->getInvestimento();
        
    }

    public function busca1()
    {
        $retornoCarteiraInicial = $this->carteiraInicial->getRetornoCarteira();
        
        $libVizinho = new Vizinho($this->investimento);
        
        $vizinhos = $libVizinho->getVetorVizinhos();
        
        foreach($vizinhos as $vizinho){
            $viz = new Carteira($vizinho);            
            var_dump( $viz->getRetornoCarteira());
        }
        
        
//        $this->carteiraInicial->getInvestimento();        
//        $this->carteiraInicial->get
        
//        var_dump($this->vizinho);
        
    }

}
