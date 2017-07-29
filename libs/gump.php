<?php

class Validate
{
    private static function is_valid($data, $data_rules = null)
    {
        $gump = new GUMP();
        $data = $gump->sanitize($data);
        $gump->validation_rules($data_rules);
        $gump->filter_rules(array(
            'login' => 'trim|sanitize_string',
            'name' => 'trim|sanitize_string',
            'email' => 'trim|sanitize_email',
            'password' => 'trim',
            'password2' => 'trim',
        ));
        GUMP::set_field_name('name', 'Имя');
        GUMP::set_field_name('login', 'Логин');
        GUMP::set_field_name('email', 'Почта');
        GUMP::set_field_name('password', 'Пароль');
        GUMP::set_field_name('pic', 'Картинка');
        GUMP::set_field_name('password2', 'Повторный пароль');
        $validated_data = $gump->run($data);
        if ($validated_data === false) {
            $errors = $gump->get_readable_errors();
            return $errors;
        }
    }

    public static function is_validRegister()
    {
        $data = array(
            'name' => $_POST['name'],
            'login' => $_POST['login'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'password2' => $_POST['password2']
        );
        $data_rules = array(
            'name' => 'required|max_len,100|min_len,3',
            'login' => 'required|max_len,25|min_len,3',
            'email' => 'required|valid_email',
            'password' => 'required',
            'password2' => 'required|equalsfield,password',

        );
        $errors = self::is_valid($data, $data_rules);
        return $errors;
    }

    public static function is_validEnter()
    {
        $data = array('login' => $_POST['login'], 'password' => $_POST['password']);
        $data_rules = array(
            'login' => 'required',
            'password' => 'required',
        );
        $errors = self::is_valid($data, $data_rules);
        return $errors;
    }

    public static function is_validTask()
    {
        $data = array('name' => $_POST['name'],'text' => $_POST['text']);
        $data_rules = array(
            'name' => 'required|max_len,50|min_len,2',
            'text' => 'required|max_len,200|min_len,5',

        );
        $errors = Validate::is_valid($data, $data_rules);
        return $errors;
    }
}