<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';

//TesteDesempenho::inicio();

$inicial = array(1 => 0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);
//$inicial = array(1 => 0.20, 0.15, 0.3, 0.25, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);

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
                if ($posFixTemp == 0 && $posVizTemp == 0) {
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

//var_dump($iteracao);
//
//$html .= "" . 0 . " = " . implode(' | ', $inicial) . "<br>";
for ($j = 1; $j <= count($iteracao); $j++) {
    $html .= " " . $j . " = " . implode(' | ', $iteracao[$j]) . "<br>";
}
//echo "Total laços: $lacos <br>";
echo "$html <br> ";


//TesteDesempenho::fim();