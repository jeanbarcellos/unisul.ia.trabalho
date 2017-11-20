<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/core/autoloader.php';

switch ($_GET['escolha']) {
    case 1 :
        $inicial = array(0.25, 0.3, 0.20, 0.0, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0);
        break;
    case 2 :
        $inicial = array(0.0, 0.25, 0.3, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0);
        break;
    case 3 :
        $inicial = array(0.0, 0.0, 0.0, 0.0, 0.0, 0.3, 0.25, 0.2, 0.15, 0.1);
        break;
    case 4 :
        $inicial = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        break;
    case 5 :
        $inicial = array(1, 2, 3, 4, 5, 0, 0, 0, 0, 0);
        break;
    case 6 :
        $inicial = array(0, 0, 0, 0, 0, 6, 7, 8, 9, 10);
        break;
    case 7 :
        $inicial = array(0, 0, 0, 0, 0, 6, 7, 8, 9, 10);
        break;
    default:
        $inicial = array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);
}

if (isset($_GET['aleatorio'])) {
    shuffle($inicial);
}

$libVizinho = new Vizinho($inicial);

$vizinhos = $libVizinho->getVetorVizinhos();
$iteracoes = $libVizinho->getIteracoesSize();

for ($j = 0; $j < count($vizinhos); $j++) {
    $html .= " " . $j . " = " . implode(' | ', $vizinhos[$j]) . "<br>";
}
echo "$html <br> ";
echo "IN = " . implode(' | ', $inicial) . "<br>";
echo "Iterações $iteracoes<br> ";


