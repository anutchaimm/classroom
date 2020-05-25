<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomPretestUser extends Model
{
    protected $table = 'classroom_pretest_users';

    protected $primaryKey = 'cpu_id';

    protected $fillable = [
        'cls_id',
        'id',
        'pt_id',
        'cpu_score',
    ];

    public function profile(){
        return $this->hasOne('App\Profile', 'user_id', 'id');
    }
}

