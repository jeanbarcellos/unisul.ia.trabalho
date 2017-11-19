<?php

/**
 * Classe para realizar testes de tempo de execução e consumo de memória.
 * 
 * @author Jean Barcellos <jean@equipedigital.com> 
 * @copyright Copyright (c) 2009-2016, EquipeDigital.com
 * @link http://www.equipedigital.com
 * @license Comercial    
 *
 * @Data_Criacao 02/06/2017 
 * @Ultima_Modif 02/06/2017 por Jean Barcellos
 *
 * @package Libs
 *
 */
class TesteDesempenho
{

    private static $usec;
    private static $sec;
    private static $script_start;
    private static $script_end;

    /**
     * Início da contagem do teste
     * Chamar logo após o AutoLoader
     */
    public static function inicio()
    {
        list(self::$usec, self::$sec) = explode(' ', microtime());
        self::$script_start = (float) self::$sec + (float) self::$usec;
    }

    /**
     * Colocar na última linha do programa
     */
    public static function fim()
    {
        list(self::$usec, self::$sec) = explode(' ', microtime());
        self::$script_end = (float) self::$sec + (float) self::$usec;
        $elapsed_time = round(self::$script_end - self::$script_start, 5);
        echo '<p>Tesmpo Gasto: ', $elapsed_time, ' segundos.<br>Memória alocada: ', round(((memory_get_peak_usage(true) / 1024) / 1024), 2), 'Mb</p>';
    }

}
