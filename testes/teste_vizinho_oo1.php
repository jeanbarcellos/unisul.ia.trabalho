<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';

$teste = array();

for ($i = 0; $i < 10; $i++) {
    
    
}

$invest = array(0.3, 0.20, 0.15, 0.0, 0.0, 0.0, 0.10, 0.25, 0.0, 0.0);

//shuffle($invest);

var_dump($invest);

$libVizinho = new Vizinho($invest);

$vizinhos = $libVizinho->getVetorVizinhos();

for ($j = 0; $j < count($vizinhos); $j++) {
    $html .= " " . $j . " = " . implode(' | ', $vizinhos[$j]) . "<br>";
}

echo "$html <br><br>";


