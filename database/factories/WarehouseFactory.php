<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Warehouse;
use Faker\Generator as Faker;

$factory->define(Warehouse::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'debt' => $faker->randomFloat(2, 0, 10000)
    ];
});
