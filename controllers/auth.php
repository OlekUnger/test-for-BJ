<?php
namespace App;

class Auth
{
    public function register()
    {
        $connect = new \Auth();
        unset($_SESSION['error']);
        unset($_SESSION['success']);
        $errors = \Validate::is_ValidRegister();
        if (isset($_POST['reg'])) {

            if ($connect->checkLoginExists()) {
                $errors[] = 'Такой логин существует';
            }
            if (empty($errors)) {
                $connect->userRegister($_POST['login'], $_POST['password2'], $_POST['name'], $_POST['email']);
                $connect->enter();
                $_SESSION['auth'] = $connect->getSession();
                $_SESSION['success'] = 'Вы зарегистрированы';
                header('Refresh:.5; url= /');
            } else {
                $_SESSION['error'] = array_shift($errors);
            }
        }

        \View::render('auth/register', $data = [
            'title' => 'Регистрация',
            'uri' => 'register',
            'POST'=>$_POST,
            'session' => $_SESSION['auth'],
            'error' => $_SESSION['error'],
            'success' => $_SESSION['success']
        ]);
    }

    public function login()
    {
        unset($_SESSION['error']);
        unset($_SESSION['success']);
        $connect = new \Auth();
        $errors = \Validate::is_ValidEnter();
        if (isset($_POST['enter'])) {
            if (empty($errors)) {
                $userLogin = $connect->checkUserExists($_POST['login'], $_POST['password']);
                if ($userLogin) {
                    $connect->enter();
                    $_SESSION['auth'] = $connect->getSession();
                    $_SESSION['success'] = 'Вход выполнен';
                    header('Refresh:.5; url= /');
                } else {
                    $_SESSION['error'] = 'Неверный логин или пароль';
                }
            } else {
                $_SESSION['error'] = array_shift($errors);
            }
        }

        \View::render('auth/login', $data = [
            'title' => 'Вход',
            'uri' => 'enter',
            'POST' => $_POST,
            'session' => $_SESSION['auth'],
            'error' => $_SESSION['error'],
            'success' => $_SESSION['success']
        ]);
    }

    public function logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
}