<?php

class View
{
    public static function render($filename, $data=null)
    {
        $loader = new Twig_Loader_Filesystem("views");
        $twig = new Twig_Environment($loader, ['cache' => false]);
        echo $twig->render($filename.'.twig', $data);
    }
    public static function renderDayside($filename, $data=null){
        require_once $filename;
    }
}
