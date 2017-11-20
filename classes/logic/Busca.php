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
     * Vetor inicia
     * @var array Array do investimento
     */
    private $vetorInicial;

    /**
     * Carteira inicial
     * @var Carteira 
     */
    private $carteiraInicial;

    /**
     * Melhores Carteiras encontradas
     * @var array Array de carteiras 
     */
    private $carteiras;

    /**
     * MEMORIA Todas as carteiras pesquisadas
     * @var Carteira
     */
    private $memoria;

    /**
     * Melhor Carteira
     * @var Carteira 
     */
    private $melhorCarteira;

    /**
     * Construtor
     * Instancia a carteira inicial e a melhor carteira parao início da busca
     * 
     * @param array  $vetorInicial
     */
    public function __construct(array $vetorInicial)
    {
        // Seta o vetor inicial
        $this->vetorInicial = $vetorInicial;

        $carteira = new Carteira($vetorInicial);

        // Instancia a carteira inicial
        $this->carteiraInicial = $carteira;

        // Copia a carteira inicial como melhor carteira atual 
        // para dar início a busca
        $this->melhorCarteira = $carteira;
    }

    /**
     * Executa a busca da melhor carteira
     * 
     * @return void Não há retorno, apenas executa a busca
     */
    public function executar()
    {
        // Memória temporaria da busca
        $memoriaTemp = array();

        // Instancia instancia, procura e lista os vizinhos da melhor carteira atual
        $vizinho = new Vizinho($this->melhorCarteira->getInvestimento());
        $listaVizinhos = $vizinho->getVetorVizinhos();

        foreach ($listaVizinhos as $vizinho) {
            $cart = new Carteira($vizinho);
            $memoriaTemp[] = $cart;
            $this->memoria[] = $cart;
        }

        $indiceMaior = 0;
        $valorMaior = 0;

        foreach ($memoriaTemp as $key => $carteira) {
            $retorno = $carteira->getRetornoCarteira();

            if ($retorno > $valorMaior) {
                $indiceMaior = $key;
                $valorMaior = $retorno;
            }
        }

        $melhorCarteiraTemp = $memoriaTemp[$indiceMaior];

        $retornoCarteiraTemp = $melhorCarteiraTemp->getRetornoCarteira();
        $retornoCarteiraMelhor = $this->melhorCarteira->getRetornoCarteira();

        // Verifica se a melhor carteira encontrada é mlehor que a atual ...
        if ($retornoCarteiraTemp > $retornoCarteiraMelhor) {
            $this->carteiras[] = $melhorCarteiraTemp;
            $this->melhorCarteira = $melhorCarteiraTemp;

            // Caso a carteira atual seja melhor que a anterior
            // Executa novamente até encontrar o melhor retorno
            $this->executar();
        }
    }

    /**
     * Retorna as melhores carteiras encontradas
     * 
     * @return array Array de Carteiras
     */
    public function getCarteiras()
    {
        return $this->carteiras;
    }

    /**
     * Retorna a memória de busca, ou seja, todas as carteiras que a busa utilizou
     * 
     * @return array Array de carteras
     */
    public function getMemoria()
    {
        return $this->memoria;
    }

    /**
     * Retorna a carteira inicial
     * 
     * @return Carteira Carteira inicial de aplicação
     */
    public function getCarteiraInicial()
    {
        return $this->carteiraInicial;
    }

    /**
     * Retorna a melhor carteira encontraa
     * 
     * @return Carteira Carteira com maior retorno
     */
    public function getMelhorCarteira()
    {
        return $this->melhorCarteira;
    }

    /**
     * Retorna o tamanho do vetor de melhores carteiras encontradas
     * 
     * @return int
     */
    public function getCarteirasSize()
    {
        return count($this->carteiras);
    }

    /**
     * Retorna o tamanho do vetor de carteiras armazenadas na memória
     * 
     * @return int
     */
    public function getMemoriaSize()
    {
        return count($this->memoria);
    }

}
