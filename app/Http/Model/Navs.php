<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
    const CREATED_AT = 'nav_create_date';
    const UPDATED_AT = 'nav_update_date';
    protected $guarded = []; // 黑名單
    protected $table = 'navs';
    protected $primaryKey = 'nav_id';

}
