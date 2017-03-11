<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';// 省略前綴 blog_ 但要在config database 設定前綴 blog_
    protected $primaryKey = 'user_id';
}
