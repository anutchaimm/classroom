<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomPretest extends Model
{
    protected $table = 'classroom_pretests';

    protected $primaryKey = 'pt_id';

    protected $fillable = [
        'cls_id',
        'pt_name',
        'pt_number_of_exam',
    ];

    public function exam()
    {
        return $this->hasMany('App\ClassroomPretestExam', 'pt_id', 'pt_id');
    }
}
