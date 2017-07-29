<?php

class Auth extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    protected $table = 'users';

    // проверка существует ли такой логин в бд
    public function checkLoginExists()
    {
        $connect = self::where('login', '=', $_POST['login'])->first();
        if ($connect->login) {
            return true;
        } else {
            return false;
        }
    }

    // зарегистрирован ли входящий
    public function checkUserExists($login, $password)
    {
        $connect = self::where('login', '=', $login)->where('password', '=', $password)->first();
        if ($connect) {
            return $connect->login;
        } else {
            return false;
        }
    }

    // есть ли пользователь с таким именем в бд
    public static function checkNameExists($name)
    {
        $connect = self::where('name', '=', $name)->first();
        if ($connect) {
            return $connect->name;
        } else {
            return false;
        }
    }

    // регистрация
    public function userRegister($login, $password2, $name, $email)
    {
        // $password2 = SHA1($password2);
        $user = new self();
        $user->login = $login;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password2;
        $user->save();
    }

    // вход
    public function enter()
    {
        $connect = self::where('login', '=', $_POST['login'])->first();
        $_SESSION['login'] = $connect->login;
        return $_SESSION['login'];
    }

    // создание сессии
    public static function getSession()
    {
        return self::where('login', '=', $_SESSION['login'])->first();

    }

    // получение пользователя по имени
    public static function getUserByName($name)
    {
        if ($name) {
            return self::where('name', '=', $name)->first();
        }
    }

    // является ли юзер администратором
    public function is_admin()
    {
        $connect = self::where('login', '=', $_SESSION['login'])->value('is_admin');

        if ($connect == 1) {
            return true;
        } else {
            return false;
        }
    }
}