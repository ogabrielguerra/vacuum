<?php /** @noinspection PhpIncludeInspection */
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

//A simple class loader
    spl_autoload_register("loadClasses");

    function loadClasses($class){
        $fullClassPath = '../appVacuum/resources/classes/'.$class.'.php';
        if(file_exists($fullClassPath)){
            require $fullClassPath;
        }else{
            die('Unable to load class '.$class.'. Crash!');
        }
    }

    require_once '../appVacuum/vendor/autoload.php';