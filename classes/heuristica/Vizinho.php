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

    function __construct(array $vetorInicial)
    {
        $this->vetorInicial = $vetorInicial;
        $this->extrairVizinhos();
    }

    private function extrairVizinhos()
    {
        $inicial = $this->vetorInicial;
        $i = 1;
        $posFix = 1;
        $posVizIni = 2;

        $lacos = 0;

        for ($posFix = 1; $posFix <= 10; $posFix++) {

            for ($posViz = $posVizIni; $posViz <= 10; $posViz++) {
                $iteracao[$i] = $inicial;

                for ($p = 1; $p <= 10; $p++) {
                    $lacos++;

                    if ($p == $posViz) {
                        // Grava valores temps para realizar ...
                        $posFixTemp = $iteracao[$i][$posFix];
                        $posVizTemp = $iteracao[$i][$posViz];

                        // Caso os vizinhos possuam o mesmo valor, sobreescreve
                        if ($posFixTemp == 0 && $posFixTemp == 0) {
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

        array_pop($iteracao);

        $this->vetorVizinhos = $iteracao;
    }

    public function getVetorInicial()
    {
        return $this->vetorInicial;
    }

    public function getVetorVizinhos()
    {
        return $this->vetorVizinhos;
    }

}
