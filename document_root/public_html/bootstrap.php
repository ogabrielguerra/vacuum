<?
    //A simple class loader
    spl_autoload_register("loadClasses");

    function loadClasses($class){
        $fullClassPath = '../app/resources/classes/'.$class.'.php';
        if(file_exists($fullClassPath)){
            require $fullClassPath;
        }else{
            die('Unable to load class '.$class.'. Crash!');
        }
    }

    require_once '../app/vendor/autoload.php';
?>