<?php

/**
 * Implementa o Design Pattern Registry + Singleton para encapsular e 
 * manipular dados que estarão disponíveis entre as páginas da aplicação.<br>
 * <br>
 * OBS: Caso não queira utilizar $_SESSION para manipular o registro, 
 * você pode alterar o escopo dos métodos desta classe para MySQL ou outro tipo.<br>
 * 
 * @author Jean Barcellos <jeanbarcellos@hotmail.com> 
 * 
 */
class SessionRegistry
{

    /**
     * Instância de SessionRegistry
     * @var Config 
     */
    private static $instance;

    /**
     * Construtor do tipo protegido previne que uma nova instância da
     * classe seja criada através do operador `new` de fora dessa classe.
     */
    private function __construct()
    {
        if (!isset($_SESSION)) {
            $this->iniciarSessao();
        }
    }

    /**
     * Método clone do tipo privado previne a clonagem dessa instância
     * da classe
     *
     * @return void
     */
    private function __clone()
    {
        
    }

    /**
     * Método unserialize do tipo privado para prevenir a desserialização
     * da instância dessa classe.
     *
     * @return void
     */
    private function __wakeup()
    {
        
    }

    /**
     * Retorna Instancia de Config
     * @return SessionRegistry
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Retorna um dado do array do SessionRegistry
     * 
     * @param string $key Chave
     * @return string Valor referente a chave informada
     */
    public function get($key)
    {
        return $_SESSION[$key];
    }

    /**
     * Define uma veriável no SessionRegistry
     * 
     * @param mixed $key Chave
     * @param mixed $value Valor
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Adiciona um registro
     * 
     * @param mixed $key Chave
     * @param mixed $value Valor
     */
    public function add($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Remove um dado
     * @param mixed $key Chave
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Retorna todos os dados do array
     * 
     * @return array
     */
    public function getAll()
    {
        return $_SESSION;
    }

    /**
     * Remove todos os dados do Array
     */
    public function removeAll()
    {
        session_unset();
    }

    /**
     * Retorna todos os índices do array de registros
     * 
     * @return array Array com os indices
     */
    public function keys()
    {
        return array_keys($_SESSION);
    }

    /**
     * Total de registros do array de registros
     * 
     * @return int Valor total de registros
     */
    public function count()
    {
        return count($_SESSION);
    }

    /**
     * Verifica se uma chave/índice existe no array de registros
     * 
     * @param mixed $key Chave/Índice
     * @return boolean
     */
    public function exists($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * Inicializa a $_SESSION
     */
    private function iniciarSessao()
    {
        session_start();
    }

    /**
     * Destroy a $_SESSION
     */
    private function destruirSessao()
    {
        session_destroy();
    }

}
