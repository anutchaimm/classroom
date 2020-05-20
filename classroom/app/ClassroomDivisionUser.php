<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomDivisionUser extends Model
{
    protected $table = 'classroom_division_users';

    protected $primaryKey = 'divu_id';

    protected $fillable = [
        'div_id',
        'cls_id',
        'user_id',
        'div_usr_total_match',
        'div_usr_total_win',
        'div_usr_total_draw',
        'div_usr_total_lose',
        'div_usr_total_point',
        'div_usr_rank',
    ];
}
