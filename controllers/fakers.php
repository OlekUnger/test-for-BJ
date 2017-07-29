<?php
namespace App;
class Fakers
{

    public function index()
    {
        $connect = new \Auth();
        if($connect->is_admin()){
            \View::render('fakers', $data = [

            ]);
        } else {
            \View::render('auth/login', $data = [

            ]);
        }
        \View::render('fakers', $data = [

        ]);
//        \Fakers::createFakers();
    }

}