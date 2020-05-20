<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomComment extends Model
{
    protected $table = 'classroom_comments';

    protected $primaryKey = 'cmt_id';

    protected $fillable = [
        'con_id',
        'user_id',
        'cmt_message',
    ];

    public function classroomcontent()
    {
        return $this->belongsTo('App\ClassroomContent', 'con_id', 'con_id');
    }

}
