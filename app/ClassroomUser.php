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

    public function classroomname(){
      //  return $this->hasOne(Classroom::class,'cls_id');

        return $this->hasOne('App\Classroom', 'cls_id', 'cls_id');
    }

    public function score(){
        return $this->hasMany('App\ClassroomPretestUser', 'id', 'user_id');
    }
}
