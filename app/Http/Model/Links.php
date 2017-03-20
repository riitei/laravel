<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    const CREATED_AT = 'link_create_date';
    const UPDATED_AT = 'link_update_date';
    // protected $guarded = []; // 黑名單
    protected $table = 'links';
    protected $primaryKey = 'link_id';

}
