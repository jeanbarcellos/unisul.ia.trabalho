<?php

require_once 'autoload.php';

$inicial = array(1 => 0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);

$libVizinho = new Vizinho($inicial);
$vizinhos = $libVizinho->getVetorVizinhos();

//$html .= "" . 0 . " = " . implode(' | ', $inicial) . "<br>";
for ($j = 1; $j <= count($vizinhos); $j++) {
    $html .= " " . $j . " = " . implode(' | ', $vizinhos[$j]) . "<br>";
}
//echo "Total laços: $lacos <br>";
echo "$html <br> ";


