<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence($faker->numberBetween(6,10)),
        'date' => $faker->date('Y-m-d'),
        'stat_id' => $faker->numberBetween(1,4),
        'priority_id' => $faker->numberBetween(1,2),
        'user_id' => $faker->numberBetween(1,30),
    ];
});
