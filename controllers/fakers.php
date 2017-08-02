<?php
namespace App;
class Fakers
{
    public function index()
    {
        $connect = new \Auth();
        if($connect->is_admin()){
            \View::render('fakers');
        } else {
            \View::render('auth/login');
        }
        \View::render('fakers');
//        \Fakers::createFakers();
    }
}