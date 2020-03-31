<?php /** @noinspection PhpIncludeInspection */

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
