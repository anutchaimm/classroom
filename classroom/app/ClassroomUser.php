<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomUser extends Model
{
    //
    protected $table = 'classroom_users';

    protected $primaryKey = 'usrc_id';

    protected $fillable = [
        'cls_id',
        'user_id',
    ];

    public function classroom()
    {
        return $this->belongsTo('App\User');
    }

}
