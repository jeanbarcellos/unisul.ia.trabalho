<?php

/**
 * Classe Javascript
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 * @date 23/11/2017
 *
 * @package 
 */
class Javascript
{

    public static function Alerta($texto, $url = '')
    {

        if ($url == '') {
            echo "<script> alert(\"$texto\"); </script>";
        } else {
            echo "
          <script> alert(\"$texto\");
            parent.window.location = '$url'; </script>";
        }
    }

    public static function Ir($url, $iframe = 'normal')
    {

        if ($iframe != 'iframe') {
            echo "<script> parent.window.location = '$url'; </script>";
        } else {
            echo "<script> window.location = '$url'; </script>";
        }
    }

    public static function Atualizar($texto = '')
    {

        if ($texto != '') {
            echo "<script> alert(\"$texto\");
                parent.window.location = parent.window.location;</script>";
        } else {
            echo "<script> parent.window.location = parent.window.location;</script>";
        }
    }

    public static function Confirmar($texto, $urlSim, $urlNao = '')
    {

        $args_num = func_num_args();

        if ($args_num == 2) {
            echo "
        <script>
          if(confirm(\"$texto\")){
            parent.window.location = '$urlSim';
          }
        </script>
        ";
        } elseif ($args_num == 3) {
            echo "
        <script>
          if(confirm(\"$texto\")){
            parent.window.location = '$urlSim';
          }else{
            parent.window.location = '$urlNao';
          }
        </script>
        ";
        }
    }

    public static function JanelaVoltar($paginas = 1)
    { #JBNTP#
        echo "
      <script> window.history.go(-" . $paginas . "); </script>
    ";
    }

    public static function JanelaAvancar($paginas = 1)
    { #JBNTP#
        echo "
      <script> window.history.go(" . $paginas . "); </script>
    ";
    }

}
