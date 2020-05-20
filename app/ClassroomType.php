<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomType extends Model
{
    //
    protected $table = 'classroom_types';

    protected $primaryKey = 'cls_type';

    public function classroom()
    {
        return $this->belongsTo(User::class);
    }
}
