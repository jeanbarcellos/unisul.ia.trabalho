<?php

/**
 * Classe Vizinho
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 * @date 18/11/2017
 *
 * @package
 */
class Vizinho
{

    /**
     * Guarda o vetor inicial
     * @var array
     */
    private $vetorInicial = array();

    /**
     * Guarda a matriz de vizinhos
     * @var type
     */
    private $vetorVizinhos = array();

    /**
     * Carrega o vetor inicial e extrai os vizinhos
     *
     * @param array $vetorInicial
     */
    function __construct(array $vetorInicial)
    {
        $this->setVetorInicial($vetorInicial);
        $this->extrairVizinhos();
    }

    /**
     * Extrai todos os vizinhos possíveis alternando entre os valores
     * 30% 25% 20% 15% 10%
     */
    private function extrairVizinhos()
    {
        $inicial = $this->vetorInicial;
        $tam = count($inicial);
        $i = 0;
        $posFix = 1;
        $posVizIni = 2;

        $lacos = 0;

        for ($posFix = 1; $posFix <= $tam; $posFix++) {

            for ($posViz = $posVizIni; $posViz <= $tam; $posViz++) {
                $iteracao[$i] = $inicial;

//                var_dump($posViz);

                for ($p = 1; $p <= $tam; $p++) {
                    $lacos++;

                    if ($p == $posViz) {

                        // Grava valores temps para realizar ...
                        $posFixTemp = $iteracao[$i][$posFix];
                        $posVizTemp = $iteracao[$i][$posViz];

                        // Caso os vizinhos possuam o mesmo valor, sobreescreve
//                        if ($posFixTemp == 0 && $posVizTemp == 0) {
                        if ($posFixTemp == $posVizTemp) {
                            unset($iteracao[$i]);
                            $i--;
                        } else {
                            // ... a troca entre vizinhos
                            $iteracao[$i][$posFix] = $posVizTemp;
                            $iteracao[$i][$posViz] = $posFixTemp;
                            $p = 11;
                        }
                    }
                }

                $i++;
            }

            $posVizIni++;
        }

        $this->vetorVizinhos = $iteracao;
    }

    /**
     * Define o vetor inicial
     *
     * @param array $vetorInicial
     */
    public function setVetorInicial($vetorInicial)
    {
        // Corrige os indices
        $j = 1;
        $corrigido = array();
        foreach ($vetorInicial as $valor) {
            $corrigido[$j] = $valor;
            $j++;
        }

        $this->vetorInicial = $corrigido;
    }

    /**
     * Retorna o vetor inicial
     *
     * @return array
     */
    public function getVetorInicial()
    {
        return $this->vetorInicial;
    }

    /**
     * Retorna a matriz com todos os vizinhos

     * @return array
     */
    public function getVetorVizinhos()
    {
        return $this->vetorVizinhos;
    }

    /**
     * Retorna o número total de ações
     *
     * @return int
     */
    public function getIteracoesQtd()
    {
        return count($this->vetorVizinhos);
    }

}
