<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $table = 'classrooms';

    protected $primaryKey = 'cls_id';

    protected $fillable = [
        'user_id',
        'cls_code',
        'cls_name',
        'cls_img',
        'cls_subject',
        'cls_term',
        'cls_duration',
        'cls_level',
        'cls_type',
        'cls_status',
        'cls_setting',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function classroomtype()
    {
        return $this->belongsTo('App\ClassroomType', 'cls_type');
    }

    public function classroomuser()
    {
        return $this->hasMany('App\ClassroomUser', 'cls_id', 'cls_id');
    }

    public function classroomcontent()
    {
        return $this->hasMany('App\ClassroomContent', 'cls_id', 'cls_id');
    }

    public function classroomdivision()
    {
        return $this->hasMany('App\ClassroomDivision', 'cls_id', 'cls_id');
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile', 'user_id', 'user_id');
    }

}
