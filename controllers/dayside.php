<?php
namespace App;

class Dayside
{
    public function index()
    {
        \View::renderDayside("dayside/index.php");
    }
}