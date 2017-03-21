<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    const CREATED_AT = 'conf_create_date';
    const UPDATED_AT = 'conf_update_date';
    protected $guarded = []; // 黑名單
    protected $table = 'config';
    protected $primaryKey = 'conf_id';

}
