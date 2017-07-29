1. composer update
2. В **/vendor/wixel/gump/gump.class.php** 
	1) 75 строка: $lang = 'ru'
	2) 579 строка: $message = str_replace('{param}', $param, str_replace('{field}', $field, $messages[$e['rule']]));