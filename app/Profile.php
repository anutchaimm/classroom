<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $primaryKey = 'prf_id';

    protected $fillable = [
        'prf_imgcover',
        'prf_img',
        'prf_title',
        'prf_firstname',
        'prf_lastname',
        'prf_birthday',
        'cty_code',
        'crr_id',
        'grd_id',
        'prf_workaddress',
        'prf_tel',
        'prf_status',
        'prf_contact',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
