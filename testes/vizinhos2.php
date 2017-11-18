<?php

$porcent = array(1 => 0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);
$iteracao = array();

$tamanho = count($porcent); // Tamanho do array
$inicio = 1; // Primeiro indice do array
$fim = $tamanho; // Final do array
$vizinhos = $tamanho - 1; // Quantidades de vizinhos

$troca = 1;

$i = 0; // Iterações total
$v = 0; // Iteração

$posFixa = 2; // Fixa a coluna para troca do vizinho
$proxViz = 3; // Próximo vizinho a ser alternado

$iteracao[0] = $porcent; // Copia a iteração anterior para alterar

//$html .= $i . " = " . implode(' | ', $iteracao[0]) . "<br>";

while ($troca == 1) {
    $troca = 0;
    $i++;
    $v++;

    $iteracao[$i] = $porcent;

    for ($p = $inicio; $p <= $fim; $p++) {
        if ($p == $proxViz) {
            $aux = $iteracao[$i][$posFixa];
            $iteracao[$i][$posFixa] = $iteracao[$v][$proxViz];
            $iteracao[$i][$proxViz] = $aux;
            $troca = 1;
        }
    }
    $proxViz++;

    unset($iteracao[$vizinhos]);
}


//
for ($j = 0; $j < count($iteracao); $j++) {
    $html .= " " . $j . " = " . implode(' | ', $iteracao[$j]) . "<br>";
}
echo $html; 



//    $valor = $porcent[$i];
//
//
//    var_dump($valor);
//}