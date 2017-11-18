<?php

namespace Barcellos\Core;

/**
 * Psr4AutoloaderClass
 * 
 * @link: http://www.php-fig.org/psr/psr-4/
 * @link: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 * 
 */
class AutoloaderClass
{

    /**
     * Uma matriz associativa onde a chave é um prefixo de espaço para nome 
     * e o valor é uma matriz de diretórios base para classes nesse namespace.
     *
     * @var array
     */
    protected $prefixes = array();

    /**
     * Registre o carregador com a pilha do carregador automático SPL.
     *
     * @return void
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Adiciona um diretório base para um prefixo de namespace.
     *
     * @param string $prefix O prefixo do namespace.
     * @param string $base_dir Um diretório base para arquivos de classe 
     * no namespace.
     * @param bool $prepend Se for verdadeiiro, prefixo o diretório 
     * base para a pilha em vez de anexá-lo; 
     * Isso faz com que ele seja pesquisado primeiro em vez de último.
     * 
     * @return void
     */
    public function addNamespace($prefix, $base_dir, $prepend = false)
    {
        // normalize namespace prefix
        $prefix = trim($prefix, '\\') . '\\';

        // normalize the base directory with a trailing separator
        $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

        // initialize the namespace prefix array
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = array();
        }

        // retain the base directory for the namespace prefix
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $base_dir);
        } else {
            array_push($this->prefixes[$prefix], $base_dir);
        }
    }

    /**
     * Carrega o arquivo de classe para um determinado nome de classe.
     *
     * @param string $class O nome da classe totalmente qualificado.
     * @return mixed O nome do arquivo mapeado no sucesso, 
     * ou falso booleano na falha.
     */
    public function loadClass($class)
    {
        // the current namespace prefix
        $prefix = $class;

        // work backwards through the namespace names of the fully-qualified
        // class name to find a mapped file name
        while (false !== $pos = strrpos($prefix, '\\')) {

            // retain the trailing namespace separator in the prefix
            $prefix = substr($class, 0, $pos + 1);

            // the rest is the relative class name
            $relative_class = substr($class, $pos + 1);

            // try to load a mapped file for the prefix and relative class
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }

            // remove the trailing namespace separator for the next iteration
            // of strrpos()
            $prefix = rtrim($prefix, '\\');
        }

        // never found a mapped file
        return false;
    }

    /**
     * Carregar o arquivo mapeado para um prefixo de namespace e classe relativa.
     *
     * @param string $prefix O prefixo do namespace.
     * @param string $relative_class O nome da classe relativa.
     * @return mixed Boolean Falso se nenhum arquivo mapeado pode ser carregado, 
     * ou o nome do arquivo mapeado que foi carregado
     */
    protected function loadMappedFile($prefix, $relative_class)
    {
        // Há algum diretório base para este prefixo de namespace?
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        // Olhar através de diretórios de base para este prefixo de namespace
        foreach ($this->prefixes[$prefix] as $base_dir) {

            // Substitua o prefixo de namespace pelo diretório base,
            // Substituir separadores de namespace com separadores de 
            // diretório no nome da classe relativa, anexa com .php
            $file = $base_dir
                    . str_replace('\\', '/', $relative_class)
                    . '.php';

            // Se o arquivo mapeado existir, faz a requisição
            if ($this->requireFile($file)) {
                // yes, we're done
                return $file;
            }
        }

        // never found it
        return false;
    }

    /**
     * Se existir um arquivo, exija-o do sistema de arquivos.
     *
     * @param string $file The file to require.
     * @return bool True if the file exists, false if not.
     */
    protected function requireFile($file)
    {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }

}
