<?php

namespace Barcellos\Core;

use Barcellos\Core\AutoloaderClass;
use Barcellos\Core\AutoloaderApp;

/**
 * Autoloader Jean Barcellos
 *
 * @author Jean Barcellos <jeanbarcellos@hotmail.com>
 */
class AutoLoaderJB
{

    private $loaderClass;
    private $loaderApp;
    private $basePath;

    public function __construct()
    {
        $this->basePath = $_SERVER['DOCUMENT_ROOT'] . "";
    }

    /**
     * Faz o carregamento das classes do Framework
     */
    private function registerClass()
    {
//        require_once $this->basePath . "/Vendor/Barcellos/Core/AutoLoaderClass.php";
        require_once $this->basePath . "/core/AutoLoaderClass.php";

        $this->loaderClass = new AutoloaderClass();
        $this->loaderClass->addNamespace('Barcellos', 'Vendor/Barcellos');
        $this->loaderClass->register();
    }

    /**
     * Faz o carregamento das classes da AplicaçÃO
     */
    private function registerApp()
    {
        require_once $this->basePath . "/classes/core/AutoloaderApp.php";

        $dirs = array(
            'classes/dados',
            'classes/heuristica',
            'classes/presentation',
            'classes/utils'
        );

        $this->loaderApp = new AutoloaderApp();

        foreach ($dirs as $value) {
//            $this->loaderApp->addDirectory($value);
            $this->loaderApp->addDirectory($this->basePath . "/" . $value);
        }

        $this->loaderApp->register();
    }

    /**
     * Faz o carregamento das Classes do Framework e da Aplcação
     */
    public function register()
    {
//        $this->registerClass();

        $this->registerApp();
    }

}
