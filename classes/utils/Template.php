<?php

/**
 * Template
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 */
class Template
{

    /**
     * Nome do template
     * @var string 
     */
    private $name;

    /**
     * Código fonte do template
     * @var string 
     */
    private $code;

    /**
     * Uma matriz de parâmetros para passar para o modelo
     * @var array 
     */
    private $params;

    /**
     * Construtor
     * @param string $name Nome do template
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->loadTemplate($this->name);
    }

    /**
     * Executado sempre que uma propriedade for atribuída.
     */
    public function __set($name, $value)
    {
        $this->params[$name] = $value;
    }

    /**
     * Define os parâmetros
     * @param array $params Array de Parâmetros
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * Retorna os parâmetros
     * @return array Array de parâmetros
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Adiciona parâmetro ao array de parâmetros
     * 
     * @param mixed $param Parâmetro
     */
    public function addParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    /**
     * Renderiza o modelo com o contexto dado e o retorna como seqüência de caracteres.
     * 
     * @param type $params
     * @return type
     */
    public function render($params)
    {
        $this->params = $params;
        $replace = $this->replace($this->code, $this->params);
        return $replace;
    }

    /**
     * Exibte o código-fonte renderizado
     */
    public function show()
    {
        echo $this->render($this->params);
    }

    /**
     * Nome do template
     * @param string $name 
     */
    private function loadTemplate($name)
    {
        $this->code = file_get_contents($name);
    }

    /**
     * Realiza o replace dos parâmetros no código-fonte.
     * 
     * @param string $content Conteúdo inicial
     * @param array $params Parâmetros a serem substituídos
     * @return string Código-fonte finalizado
     */
    private function replace($content, $params)
    {
        $output = $content;
        foreach ($params as $key => $val) {
            $output = str_replace("{{" . $key . "}}", $val, $output);
        }
        return $output;
    }

}
