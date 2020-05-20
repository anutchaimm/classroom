<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomParing extends Model
{

    protected $table = 'classroom_parings';

    protected $primaryKey = 'par_id';

    protected $fillable = [
        'cls_id',
        'user_id',
        'usr_paring',
        'par_status',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile', 'user_id', 'usr_paring');
    }
}
