<?php
require_once 'vendor/autoload.php';
require_once 'models/auth.php';
require_once 'models/task.php';
require_once 'models/user.php';
require_once 'models/fakers.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'test',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

class Db extends \Illuminate\Database\Eloquent\Model{
    protected $table = 'users';
    public $timestamps=false;
}

