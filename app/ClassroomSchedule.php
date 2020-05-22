<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomSchedule extends Model
{
    //

    protected $table = 'classroom_schedules';

    protected $primaryKey = 'scd_id';

    protected $fillable = [
        'div_id',
        'com_week',
        'com_date',
        'com_user1',
        'com_scoreuser1',
        'com_user2',
        'com_scoreuser2',
        'com_result',
        'com_status',
    ];
}


