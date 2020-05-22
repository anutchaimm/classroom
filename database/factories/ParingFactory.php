<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ClassroomParing;
use Faker\Generator as Faker;

$factory->define(ClassroomParing::class, function (Faker $faker) {
    do {
        $from = rand(1, 1);
        $to = rand(1, 5);
    } while ($from === $to);


    return [
        'cls_id'=> $from,
        'user_id'=> $to,
        'usr_paring'=> $to,
        'par_status'=> 'Like',

    ];
});
