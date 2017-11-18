<?php

/**
 * Implementa um Singleton para os dados
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 * @date 18/11/2017
 *
 * @package 
 */
class CarteiraDados
{

    /**
     * Array de Rótulo Meses
     * @var array 
     */
    private $labelMeses;

    /**
     * Array de Rótulo Ações
     * @var array 
     */
    private $labelAcoes;

    /**
     * Matriz de valores da carteira
     * @var array 
     */
    private $valores;

    private function __construct()
    {
        $this->recuperaAcoes();
        $this->recuperaMeses();
        $this->recuperaValores();
    }

    /**
     * Retorna uma instãncia dos Dados
     * 
     * @staticvar type $instance
     * @return \static
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    private function recuperaAcoes()
    {
        $acoes = array(
            1 => "A",
            "B",
            "C",
            "D",
            "E",
            "F",
            "G",
            "H",
            "I",
            "J");
        $this->labelAcoes = $acoes;
    }

    private function recuperaMeses()
    {
        $meses = array();
        for ($i = 1; $i <= 12; $i++) {
            $meses[$i] = $i;
        }
        $this->labelMeses = $meses;
    }

    private function recuperaValores()
    {
        $valores[1] = array(1 => 0.09091, 0.07197, 0.09661, 0.04516, 0.05864, -0.00192, 0.11404, 0.06388, -0.05679, -0.03141, 0.05676, -0.08493);
        $valores[2] = array(1 => 0.06793, 0.13972, -0.03546, -0.03109, 0.0076, -0.03879, 0.08453, -0.01656, -0.04, 0.0432, -0.1179, 0.19367);
        $valores[3] = array(1 => 0.00001, 0.00706, 0.07748, -0.01706, -0.06275, -0.00108, 0.03741, 0.00971, -0.03813, 0.09798, -0.04462, -0.02473);
        $valores[4] = array(1 => 0.00007, 0.01756, 0.06318, -0.03906, 0.05511, -0.02143, -0.00141, -0.00782, -0.05137, 0.05783, 0.00111, -0.01565);
        $valores[5] = array(1 => 0.00097, 0.01719, -0.04575, -0.01996, 0.03475, 0.00171, -0.00941, 0.00002, 0.00001, -0.01745, -0.00099, 0.0216);
        $valores[6] = array(1 => 0.00091, 0.01362, 0.09048, 0.01006, -0.0435, -0.00023, 0.02541, -0.00879, -0.02313, 0.03133, 0.00112, -0.00113);
        $valores[7] = array(1 => 0.00151, 0.05332, 0.05548, 0.00996, -0.04511, 0.00196, 0.03561, 0.06969, -0.01993, 0.0079, -0.07002, 0.02002);
        $valores[8] = array(1 => -0.00011, -0.00011, 0.07655, -0.02306, -0.0335, -0.08787, 0.03871, 0.00697, 0.04545, 0.09798, -0.04462, -0.02473);
        $valores[9] = array(1 => 0.00579, 0.01336, -0.04575, 0.00996, 0.01169, 0.00199, -0.03001, -0.00699, 0.00709, 0.09798, -0.04462, -0.02473);
        $valores[10] = array(1 => -0.00045, 0.07992, 0.099, 0.00696, 0.00697, -0.00978, 0.03891, 0.00579, -0.03813, 0.09798, -0.04462, -0.02473);
        $this->valores = $valores;
    }

    /**
     * Retorna a lista de rótulos dos meses
     * 
     * @return array
     */
    public function getLabelMeses()
    {
        return $this->labelMeses;
    }

    /**
     * Retorna a lista de rótulo das ações
     * 
     * @return array
     */
    public function getLabelAcoes()
    {
        return $this->labelAcoes;
    }

    /**
     * Retorna os valores da carteira em forma de matriz
     * 
     * @return array
     */
    public function getValores()
    {
        return $this->valores;
    }

    /**
     * Retorna o mês conforme a matriz (De 1 a 12)
     * OBS: Método tolo, nem era necessário tê-lo aqui
     * 
     * @param int $indice
     * @return int número do mês
     */
    public function getMes($indice)
    {
        return $this->labelMeses[$indice];
    }

    /**
     * Retorna os valores de uma ação
     * 
     * @param int $indice posição da ação na matriz<br>
     * Ex: Se for A é 1, B 2.... J 10;
     * 
     * @return array Array de valores
     */
    public function getAcao($indice)
    {
        return $this->valores[$indice];
    }

    /**
     * Retorna o total anual de uma ação
     * 
     * @param int $indice posição da ação na matriz<br>
     * Ex: Se for A é 1, B 2.... J 10;
     * 
     * @return double Total anual da ação informada
     */
    public function getTotalAnualAcao($indice)
    {
        $soma = 0.0;
        foreach ($this->getAcao($indice) as $valor) {
            $soma = $soma + $valor;
        }
        return $soma;
    }

}
