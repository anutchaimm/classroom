<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomContent extends Model
{
    //
    protected $table = 'classroom_contents';

    protected $primaryKey = 'con_id';

    protected $fillable = [
        'cls_id',
        'user_id',
        'con_content',
        'con_file',
        'con_originalname',
    ];

    public function profile()
    {
        return $this->belongsTo('App\Profile', 'user_id', 'user_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom', 'cls_id', 'cls_id');
    }

    public function classroomcomment()
    {
        return $this->hasMany('App\ClassroomComment', 'con_id', 'con_id');
    }
}
