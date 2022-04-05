<?php
    require_once('./app/consts/global.php');
    require_once('./app/models/Database.class.php');
    require_once('./app/helpers/validators.class.php');
    require_once('./app/controllers/Controller.php');
    require_once('./app/middleware/Auth.php');
    require_once('./app/route/routing.php');

    session_start();

    if( !isset($_GET['url']))
    {
        header('Location: Usuario/');
    }

    $router = new Routing($_GET['url']);
    // echo "<br />";
    //echo "Controlador: ".$router->controller;
    // echo "<br />";
    // echo "Metodo: ".$router->method;
    // echo "<br />";
    // echo "Param: ".$router->param;
    // echo "<br />";

    $controller = $router->controller;
    $method = $router->method;
    $param = $router->param; 

    spl_autoload_register(function($class){
        $file = './app/controllers/'.$class.'.class.php';
        if(file_exists($file))
        {
            require_once($file);
        }
    });

    $controlador = new $controller;
    $controlador->$method($param);
    
?>