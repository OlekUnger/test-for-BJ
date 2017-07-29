<?php
//error_reporting(-1);
session_start();

require_once "config.php";
require_once "libs/views.php";
require_once "libs/gump.php";
require_once "libs/IntImage.php";


$routes = explode('/', $_SERVER['REQUEST_URI']);
//print_r($routes);
$controller_name = "Main";
$action_name = "index";

//имя класса
if (!empty($routes[1])) {
    $controller_name = $routes[1];
}

//имя метода в классе
if (!empty($routes[2])) {
    $action_name = $routes[2];
}

if(preg_match('#[?]*?[a-z]?[=]\w+#i',end($routes))){
    array_pop($routes);
    $action_name = end($routes);
}

//динамично получаем подключение
$filename = "controllers/" . strtolower($controller_name) . ".php";

try {
    if (file_exists($filename)) {
        require_once $filename;
    } else {
        throw new Exception('File not found: ' . $filename);
    }
    //получаем имя класса
    $class_name = "\App\\".ucfirst($controller_name);


    // если класс существует мы его создаем
    if (class_exists($class_name)) {
        $controller = new $class_name();
    } else {
        throw new Exception('File found, but class not found: ' . $class_name);
    }

    if (method_exists($controller, $action_name)) {
        $controller->$action_name();
    } else {
        throw new Exception('Class exists, but action not found: ' . $action_name);
    }
} catch (Exception $e) {
    if (file_exists('debug')) {
        echo $e->getMessage();
    } else {
        require_once "errors/404.php";
    }
}







