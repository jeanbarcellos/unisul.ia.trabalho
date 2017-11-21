<?php

require_once "AutoLoaderJB.php";

//ini_set("default_charset", "utf8");
ini_set('default_charset', 'UTF-8');

//$al = new Barcellos\Core\AutoLoaderJB();
$al = new AutoLoaderJB();
$al->register();
