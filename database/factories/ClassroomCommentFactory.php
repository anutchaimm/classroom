<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ClassroomComment;
use Faker\Generator as Faker;

$factory->define(ClassroomComment::class, function (Faker $faker) {
    do {
        $from = rand(1, 72);
        $to = rand(1, 44);
    } while ($from === $to);




    return [
        'con_id'=> $from,
        'user_id'=> $to,
        'cmt_message'=> $faker->name,
    ];
});
