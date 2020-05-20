<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ClassroomContent;
use Faker\Generator as Faker;

$factory->define(ClassroomContent::class, function (Faker $faker) {

    do {
        $from = rand(1, 9);
        $to = rand(1, 44);
    } while ($from === $to);




    return [
        'cls_id'=> $from,
        'user_id'=> $to,
        'con_content'=> $faker->sentence,
    ];
});
