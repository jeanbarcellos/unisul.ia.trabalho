<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';

$libVizinho = new Vizinho(array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0));

$vizinhos = $libVizinho->getVetorVizinhos();
for ($j = 0; $j < count($vizinhos); $j++) {
    $html .= " " . $j . " = " . implode(' | ', $vizinhos[$j]) . "<br>";
}

echo "$html <br> ";


