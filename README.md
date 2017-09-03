Приложение для создания и редактирования задач с предварительным просмотром.
Регистрация , авторизация.

Простое MVC, для взаимодействия с БД- Eloquent ORM.
1. composer update
2. В **/vendor/wixel/gump/gump.class.php** 
	1) 75 строка: $lang = 'ru'
	2) 579 строка: $message = str_replace('{param}', $param, str_replace('{field}', $field, $messages[$e['rule']]));
