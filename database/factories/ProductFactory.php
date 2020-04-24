<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'sku' => $faker->lexify('???') . '-' . $faker->numberBetween(1, 100),
        'name' =>$faker->word,
        'price' => $faker->randomFloat(2, 1, 25),
        'clear' => $faker->numberBetween(0, 1),
        'clouds' => $faker->numberBetween(0, 1),
        'rain' => $faker->numberBetween(0, 1),
        'snow' => $faker->numberBetween(0, 1),
        'fog' => $faker->numberBetween(0, 1),
    ];
});
