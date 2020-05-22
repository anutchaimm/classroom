<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomDivision extends Model
{
    protected $table = 'classroom_divisions';

    protected $primaryKey = 'div_id';

    protected $fillable = [
        'cls_id',
        'div_name',
        'div_role',
        'div_win',
        'div_draw',
        'div_lose',
    ];


    public function classroomdivisionuser()
    {
        return $this->belongsTo('App\ClassroomDivisionUser', 'div_id');
    }



}

