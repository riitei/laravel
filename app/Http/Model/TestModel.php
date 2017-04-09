<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    public $timestamps = false;// 預設寫入更新時間戳 關閉
    protected $table = 'user';
//    public $updated_at = false;
//    public $created_at = false;
    protected $primaryKey = 'user_id';

    public function test()
    {
        $user = TestModel::where('user_name', 'ting')
            ->update(['user_name' => 'weiting']);
        dd($user);
    }

}
