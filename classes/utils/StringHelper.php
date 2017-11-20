<?php

/**
 * Classe StringHelper
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 * @date 20/11/2017
 *
 * @package 
 */
class StringHelper
{

    static public function formatarDouble($valor)
    {
        if ($valor != 0) {
            return number_format($valor, 5, ',', '');
        } else {
            return 0;
        }
    }

    static public function formatarPorcenagem($double)
    {
        return $double * 100;
    }

}
