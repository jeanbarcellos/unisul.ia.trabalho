<?php

require_once "../classes/core/autoloader.php";

$vetorInicial = array(0.3, 0.25, 0.20, 0.15, 0.10, 0.0, 0.0, 0.0, 0.0, 0.0);

$carteira = new Carteira($vetorInicial);

$decorator = new CarteiraDecorator($carteira);
//$decorator->render();
$tabela = $decorator->renderLight();





$css = "
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
    <br>
";

$html = "
    $css
    $tabela
    <a href=\"?aleatorio=1\">Aleatório</a> | <a href=\"?\">Inicial</a>
";

echo $html;