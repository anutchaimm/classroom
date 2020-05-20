<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use App\ClassroomUser;
use Faker\Generator as Faker;

$factory->define(ClassroomUser::class, function (Faker $faker) {


    do {
        $from = rand(1, 9);
        $to = rand(1, 44);
    } while ($from === $to);



    return [
        'cls_id' =>  $from,
        'user_id' => $to,
    ];
});
