<?php

//namespace Barcellos\Core;
//
//use RecursiveIteratorIterator;
//use RecursiveDirectoryIterator;
//use Exception;

/**
 * Carrega a classe da aplicação
 * @author Pablo Dall'Oglio
 */
class AutoloaderApp
{

    /**
     * Diretórois a vasculhar
     * @var array 
     */
    protected $directories;

    /**
     * Adiciona um diretório a ser vasculhado
     */
    public function addDirectory($directory)
    {
        $this->directories[] = $directory;
    }

    /**
     * Registra o AutoloaderApp
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Carrega uma classe
     */
    public function loadClass($class)
    {
        $folders = $this->directories;

        foreach ($folders as $folder) {

            if (file_exists("{$folder}/{$class}.php")) {
                require_once "{$folder}/{$class}.php";
                return TRUE;
            } else {
                if (file_exists($folder)) {
                    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder), RecursiveIteratorIterator::SELF_FIRST) as $entry) {
                        if (is_dir($entry)) {
                            // Classes comuns
                            if (file_exists("{$entry}/{$class}.php")) {
                                require_once "{$entry}/{$class}.php";
                                return TRUE;
                            }
                            // Classes com namespaces
                            if (file_exists("{$class}.php")) {
                                require_once "{$class}.php";
                                return TRUE;
                            }
                        }
                    }
                }
            }
        }
    }

}
