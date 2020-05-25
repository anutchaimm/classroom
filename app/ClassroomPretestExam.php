<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomPretestExam extends Model
{
    protected $table = 'classroom_pretest_exams';

    protected $primaryKey = 'exm_id';

    protected $fillable = [
        'pt_id',
        'cls_id',
        'exm_question',
        'exm_choice_1',
        'exm_choice_2',
        'exm_choice_3',
        'exm_choice_4',
        'exm_answer',
    ];


}
