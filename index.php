<?php
session_start();

spl_autoload_register(function ($at) 
    {
        if(file_exists('models/' . $at . '.php'))
        {
            require_once('models/' . $at . '.php');
        }
        elseif(file_exists('controllers/' . $at . '.php'))
        {
            require_once('controllers/' . $at . '.php');
        }
    });

    if($_GET['c'] && $_SESSION['id'] && $_GET['method']) 
    {
        $class = $_GET['c'];
        $method = $_GET['method'];
    }
    else
    {
        $class = 'auth';
        $method = 'get_body';
    }


    if(method_exists($class, $method))
    {
        $obj = new $class($class);
        $obj->$method();
    }
    else
    {
        $obj = new controller();
        $obj->error();
    }
?>
