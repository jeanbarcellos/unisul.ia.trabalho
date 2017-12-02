<?php

// Rótulos
$acoes = array(1 => "A", "B", "C", "D", "E", "F", "G", "H", "I", "J");
$meses = array(1 => "Mês 1", "Mês 2", "Mês 3", "Mês 4", "Mês 5", "Mês 6", "Mês 7", "Mês 8", "Mês 9", "Mês 10", "Mês 11", "Mês 12");

// Carteira Inicial
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

//$investimento = array(1 => 0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);
$investimento = [1 => 0.25, 0.3, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0];

// Mistura array;
if (isset($_GET['aleatorio'])) {
    shuffle($investimento);
}


// Calcula retorno mensal da ação --------
$retornos = array();
$totalAnual = 0;
for ($m = 1; $m <= 12; $m++) {
    $retornos[$m] = 0;
    for ($a = 1; $a <= 10; $a++) {
        $valor = $valores[$a][$m];
        $valorRetornoAcao = $valor * $investimento[$a];
        $valorRetornoMes = $retornos[$m] + $valorRetornoAcao;
        $retornos[$m] = $valorRetornoMes;
    }
    $totalAnual = $totalAnual + $retornos[$m];
}


// Calcula o total anual de cada ação ----------------
$totalAnualAcao = array();
for ($a = 1; $a <= 10; $a++) {
    $totalAnualAcao[$a] = 0;
    for ($m = 1; $m <= 12; $m++) {
        $valor = $valores[$a][$m];
        $totalAnualAcao[$a] = $totalAnualAcao[$a] + $valor;
    }
}


// Monta os dados ----------
$htmlBody = "";
for ($m = 1; $m <= 12; $m++) {
    $htmlBody .= "<tr>";
    $htmlBody .= "<td>" . $m . "</td>";

    for ($a = 1; $a <= 10; $a++) {
        $valor = $valores[$a][$m];
        $valorFormat = formatarDouble($valores[$a][$m]);

        // Saída
        $htmlBody .= "<td>" . $valorFormat . "</td>";
    }

    $htmlBody .= "<td><b>" . formatarDouble($retornos[$m]) . "</b></td>";

    $htmlBody .= "</tr>";
}


// Imprime a escolha ---------
$htmlFoot .= "<tr>";
$htmlFoot .= "<td>Escolha</td>";
for ($a = 1; $a <= 10; $a++) {
    $htmlFoot .= "<td><b>" . formatarPorcenagem($investimento[$a]) . "%</b></td>";
}
$htmlFoot .= "<td style=\"background: #CCC; font-weight:bold; color: blue\">" . formatarDouble($totalAnual) . "</td>";
$htmlFoot .= "</tr>";

// Imprime o total mes ---------
$htmlFoot .= "<tr>";
$htmlFoot .= "<td>TotalMês</td>";
for ($a = 1; $a <= 10; $a++) {
    $htmlFoot .= "<td>" . $totalAnualAcao[$a] . " </td>";
}
$htmlFoot .= "<td></td>";
$htmlFoot .= "</tr>";

// Imprime a retorno de cada ação ---------
$htmlFoot .= "<tr>";
$htmlFoot .= "<td>Retorno Ação</td>";
$total = 0;
for ($a = 1; $a <= 10; $a++) {
    $mesAp = $totalAnualAcao[$a] * $investimento[$a];
    $total = $total + $mesAp;
    $htmlFoot .= "<td>" . formatarDouble($mesAp) . " </td>";
}
$htmlFoot .= "<td style=\"background: #CCC; font-weight:bold; color: blue\">" . formatarDouble($total) . "</td>";
$htmlFoot .= "</tr>";



// Monta o cabeççalho
$htmlHead = "<tr>";
$htmlHead .= "<th>Mês</th>";
for ($a = 1; $a <= 10; $a++) {
    $htmlHead .= "<th>Ação " . $acoes[$a] . "</th>";
}
$htmlHead .= "<th>Retorno mes</th>";
$htmlHead .= "</tr>";



$table = "
    <style>
    body, td ,th, input, select, option, textarea {
    font-family: courier, Arial, Helvetica, sans-serif;
    font-size: 14px;
    line-height: 1.25em;
    }
    table {border-collapse:collapse; border-spacing:0}
    th, td, caption {font-weight:normal; vertical-align:top; text-align:left}
    td, th { border: 1px solid #111; padding: 2px 5px}
    th {text-align:center; background:#adc8ff; font-weight:bold;}
    td {text-align:right}
    </style>
    <table>
      " . $htmlHead . " 
      " . $htmlBody . " 
      " . $htmlFoot . " 
    </table>
    <br>
    <a href=\"?aleatorio=1\">Aleatório</a> | <a href=\"?\">Inicial</a>
";

echo $table;

function formatarDouble($valor) {
    if ($valor != 0) {
        return number_format($valor, 5, ',', '');
    } else {
        return 0;
    }
}

function formatarPorcenagem($double) {
    return $double * 100;
}
