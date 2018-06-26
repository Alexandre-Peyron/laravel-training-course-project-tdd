<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(4),
        'amount'      => $faker->numberBetween(5, 10),
        'category_id' => function() {
            return factory(App\Category::class)->create()->id;
        }
    ];
});
