<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;


$factory->define(App\Models\Category::class, function (Faker $faker) {
    $category = $faker->name;
    return [
        'name' => $category,
        'slug' => $category,
    ];
});
