<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;// 省略前綴 blog_ 但要在config database 設定前綴 blog_
    protected $table = 'user';
    protected $primaryKey = 'user_id';
}
