<?php
class User extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    protected $table= 'users';

    public function task(){
        return $this->hasMany('Task','user_id','id');
    }

    public static function getUser($param){
        if($param){
            $user=self::where('login','=',$param)->get()->toArray();
            return $user;
        }
    }

}